<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
	{
		parent::__construct();
		$params = array('server_key' => 'SB-Mid-server-AtdPG-speiRLDAStt8-GGwaT', 'production' => false);
		$this->load->library('veritrans');
		$this->veritrans->config($params);
		$this->load->helper('url');
		
	}

	public function index()
	{
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result, TRUE);

		$order_id = $result['order_id'];
		if ($result['status_code'] == 200) {
			$transaksi = $this->db->get_where('transaksi', ['id_order' => $order_id])->row_array();
			$data = [
				'id_order' => $order_id,
				'id_produk' => $transaksi['id_produk'],
				'username' => $transaksi['username'],
				'nama' => $transaksi['nama'],
				'no_hp' => $transaksi['no_hp'],
				'alamat' => $transaksi['alamat'],
				'jumlah' => $transaksi['jumlah'],
				'total_harga' => $transaksi['total_harga'],
				'tgl_order' => $transaksi['transaction_time'],
				'status' => 'Dalam Pesanan'
			];
			$this->db->insert('penjualan', $data);

			$query = $this->db->get_where('menu', ['id_produk' => $transaksi['id_produk']])->row_array();
			$stok = $query['stok'] - $transaksi['jumlah'];
			$this->db->set('stok', $stok);
			$this->db->where('id_produk', $transaksi['id_produk']);
			$this->db->update('menu');

			$this->db->where('id_order', $order_id);
			$this->db->delete('transaksi');

		} elseif ($result['status_code'] == 202) {
			$this->db->where('id_order', $order_id);
			$this->db->delete('transaksi');
		}

		//notification handler sample

		/*
		$transaction = $notif->transaction_status;
		$type = $notif->payment_type;
		$order_id = $notif->order_id;
		$fraud = $notif->fraud_status;

		if ($transaction == 'capture') {
		  // For credit card transaction, we need to check whether transaction is challenge by FDS or not
		  if ($type == 'credit_card'){
		    if($fraud == 'challenge'){
		      // TODO set payment status in merchant's database to 'Challenge by FDS'
		      // TODO merchant should decide whether this transaction is authorized or not in MAP
		      echo "Transaction order_id: " . $order_id ." is challenged by FDS";
		      } 
		      else {
		      // TODO set payment status in merchant's database to 'Success'
		      echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
		      }
		    }
		  }
		else if ($transaction == 'settlement'){
		  // TODO set payment status in merchant's database to 'Settlement'
		  echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
		  } 
		  else if($transaction == 'pending'){
		  // TODO set payment status in merchant's database to 'Pending'
		  echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
		  } 
		  else if ($transaction == 'deny') {
		  // TODO set payment status in merchant's database to 'Denied'
		  echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
		}*/

	}
}

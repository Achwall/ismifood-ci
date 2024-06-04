<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends CI_Controller {

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
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');	
	}

	public function index()
	{
		$this->load->view('checkout_snap');
	}

	public function token()
	{
		$bytes = random_bytes(4);
		$uniqidReal = substr(bin2hex($bytes), 0, 8);

		$transaction_details = array(
			'order_id' => date('ymd').strtoupper($uniqidReal),
			'gross_amount' => $this->input->post('total'), // no decimal allowed for creditcard
		);

		// Populate items
		$item_details = array(
			'id' => $this->input->post('id_produk'),
			'price' => $this->input->post('harga'),
			'quantity' => $this->input->post('jumlah'),
			'name' => $this->input->post('name')
		);

		$user = $this->db->get_where('user', ['username' => $this->input->post('username')])->row_array();

		// Populate customer's billing address
		$billing_address = array(
			'first_name'    => $user['nama'],
			'address'       => $user['alamat'],
			'phone'         => $user['no_hp'],
			'country_code'  => 'IDN'
		);

		// Populate customer's shipping address
		$shipping_address = array(
			'first_name'    => $this->input->post('nama'),
			'address'       => $this->input->post('alamat'),
			'phone'         => $this->input->post('no_hp'),
			'country_code'  => 'IDN'
		);

		// Populate customer's Info
		$customer_details = array(
			'first_name'    => $user['nama'],
			'email'         => $user['email'],
			'phone'         => $user['no_hp'],
			'billing_address'  => $billing_address,
			'shipping_address' => $shipping_address
		);

		// Data yang akan dikirim untuk request redirect_url.
		$credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

		$time = time();
		$custom_expiry = array(
			'start_time' => date("Y-m-d H:i:s O",$time),
			'unit' => 'hour', 
			'duration'  => 2
		);

		$transaction_data = array(
			'transaction_details'=> $transaction_details,
			'item_details'       => $item_details,
			'customer_details'   => $customer_details,
			'credit_card'        => $credit_card,
			'expiry'             => $custom_expiry
		);

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
	}

	public function finish($keranjang = FALSE)
	{
		if($this->session->userdata('pelanggan') == '1') {
			$username = $this->session->userdata('username');
			if ($this->input->post('cod', TRUE)) {
				if ($keranjang) {
					$this->model->deleteKeranjang($keranjang);
				}
				
				$this->model->beli();
				redirect('order/pesanan');
			} else {
				$result = json_decode($this->input->post('result_data'), TRUE);
				$data = $this->model->transaksi();
				if ($result['status_code'] == 200) {
					redirect('order/pesanan');
				} elseif ($result['status_code'] == 201) {
					redirect('order/belumBayar');
				} else {
					redirect();
				}

				if ($keranjang) {
					$this->model->deleteKeranjang($keranjang);
				}
			}
		} else {
			redirect('welcome/login');
		}
	}
}

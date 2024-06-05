<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }

  // method konfirmasi pesanan dengan menjumlahkan total harga
  public function index($id_produk, $id_keranjang = FALSE)
  {
    if($this->session->userdata('pelanggan') == '1') {
      $jumlah = $this->input->post('jumlah');
      $username = $this->session->userdata('username');
      $data['user'] = $this->db->get_where('user', ['username' => $username])->row_array();
      $produk = $this->db->get_where('menu', ['id_produk' => $id_produk])->row_array();
      $data['produk'] = $produk;
      $data['jumlah'] = $jumlah;
      $data['total'] = $jumlah * $produk['harga'];
      $data['keranjang'] = $id_keranjang;

      $this->load->view('pelanggan/order', $data);
      $this->load->view('footer');
    } else {
      redirect('welcome/login');
    }
  }
  
  // method tambah produk ke keranjang
  public function tambah($id)
  {
    if($this->session->userdata('pelanggan') == '1') {
      if (isset($_POST['keranjang'])) {
        $this->model->keranjang($id);
        redirect('welcome/index/'.$id);
      }
    } else {
      redirect('welcome/login');
    }
  }

  // menampilkan pesanan dalam keranjang
  public function keranjang()
  {
    if($this->session->userdata('pelanggan') == '1') {
      $username = $this->session->userdata('username');
      $data['username'] = $username;

      $this->db->from('keranjang');
      $this->db->where('username', $username);
      $data['keranjang'] = $this->db->get()->result();

      $this->load->view('pelanggan/header', $data);
      $this->load->view('pelanggan/keranjang', $data);
      $this->load->view('footer');
    } else {
      redirect('welcome/login');
    }
  }

  // method hapus produk dari keranjang
  public function hapus($id)
  {
    if($this->session->userdata('pelanggan') == '1') {
      $this->model->deleteKeranjang($id);
      redirect('order/keranjang');
    } else {
      redirect('welcome/login');
    }
  }
  
  // menampilkan pesanan yang belum dibayar
  public function belumBayar() {
    if($this->session->userdata('pelanggan') == '1') {
      $username = $this->session->userdata('username');
      $data['username'] = $username;

      $this->db->from('transaksi');
      $this->db->where('username', $username);
      $this->db->where('status_code', '201');
      $this->db->order_by('transaction_time', 'ASC');
      $data['transaksi'] = $this->db->get()->result();

      $this->load->view('pelanggan/header', $data);
      $this->load->view('pelanggan/belum_bayar', $data);
      $this->load->view('footer');
    } else {
      redirect('welcome/login');
    }
  }

  // menampilkan data pesanan
  public function pesanan()
  {
    if($this->session->userdata('pelanggan') == '1') {
      $username = $this->session->userdata('username');
      $data['username'] = $username;

      $this->db->from('penjualan');
      $this->db->where('username', $username);
      $this->db->order_by('tgl_order', 'DESC');
      $data['pesanan'] = $this->db->get()->result();

      $this->load->view('pelanggan/header', $data);
      $this->load->view('pelanggan/pesanan', $data);
      $this->load->view('footer');
    } else {
      redirect('welcome/login');
    }
  }

  // method apabila pesanan telah sampai
  public function sampai($id)
  {
    if($this->session->userdata('pelanggan') == '1') {
      $this->model->sampai($id);
      redirect('order/pesanan');
    } else {
      redirect('welcome/login');
    }
  }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_welcome extends CI_Model
{
  // Pendaftaran
  public function daftar()
  {
    $data = [
      'username' => $this->input->post('username', TRUE),
      'password' => password_hash($this->input->post('password', TRUE), PASSWORD_BCRYPT),
      'nama' => $this->input->post('nama', TRUE),
      'no_hp' => $this->input->post('no_hp', TRUE),
      'alamat' => $this->input->post('alamat', TRUE),
      'email' => $this->input->post('email', TRUE)
    ];
    $this->db->insert('user', $data);
  }


  // Halaman Utama
  public function read($id)
  {
    $query = $this->db->get_where('menu', array('id_produk' => $id));
    return $query->row();
  }

  public function readRingan()
  {
    return $this->db->get_where('menu', array('kategori' => 'Ringan'))->result_array();
  }

  public function readUtama()
  {
    return $this->db->get_where('menu', array('kategori' => 'Utama'))->result_array();
  }


  // Tambah Menu
  public function create($id, $filename)
  {
    $data = [
      'id_produk' => $id,
      'nama_produk' => $this->input->post('name', TRUE),
      'deskripsi' => $this->input->post('desc', TRUE),
      'harga' => $this->input->post('harga', TRUE),
      'stok' => $this->input->post('stok', TRUE),
      'kategori' => $this->input->post('kategori', TRUE),
      'filename' => $filename
    ];
    $this->db->insert('menu', $data);
  }

  // Ubah Menu
  public function updateMenu($id, $filename)
  {
    $data = [
      'nama_produk' => $this->input->post('name', TRUE),
      'deskripsi' => $this->input->post('desc', TRUE),
      'harga' => $this->input->post('harga', TRUE),
      'stok' => $this->input->post('stok', TRUE),
      'filename' => $filename
    ];
    $this->db->where('id_produk', $id);
    $this->db->update('menu', $data);
  }

  // Hapus Menu
  public function deleteMenu($id)
  {
    $this->db->where('id_produk', $id);
    $this->db->delete('menu');
  }


  // Ubah Akun
  public function updateAkun($username)
  {
    $data = [
      'nama' => $this->input->post('nama', TRUE),
      'no_hp' => $this->input->post('no_hp', TRUE),
      'alamat' => $this->input->post('alamat', TRUE),
      'email' => $this->input->post('email', TRUE)
    ];
    $this->db->where('username', $username);
    $this->db->update('user', $data);
  }


  // Halaman Keranjang
  public function keranjang($id)
  {
    $username = $this->session->userdata('username');
    $produk = $this->db->get_where('menu', ['id_produk' => $id])->row_array();
    $jumlah = $this->input->post('jumlah', TRUE);
    $total = $produk['harga'] * $jumlah;

    $dobel = $this->db->get_where('keranjang', ['id_produk' => $id, 'username' => $username])->row_array();
    
    if ($dobel) {
      $jumlah = $dobel['jumlah'] + $jumlah;
      if ($jumlah <= $produk['stok']) {
        $data = ['jumlah' => $jumlah];
        $this->db->where('id_produk', $id);
        $this->db->where('username', $username);
        $this->db->update('keranjang', $data);
      } else {
        $data = ['jumlah' => $produk['stok']];
        $this->db->where('id_produk', $id);
        $this->db->where('username', $username);
        $this->db->update('keranjang', $data);
      }
    } else {
      $data = [
        'id_produk' => $id,
        'username' => $username,
        'jumlah' => $jumlah,
      ];
      $this->db->insert('keranjang', $data);
    }
  }

  public function deleteKeranjang($id)
  {
    $this->db->where('id_keranjang', $id);
    $this->db->delete('keranjang');
  }


  // Pembelian
  public function beli()
  {
    $id = $this->input->post('id_produk', TRUE);
    $jumlah = $this->input->post('jumlah', TRUE);

    $bytes = random_bytes(4);
    $uniqidReal = substr(bin2hex($bytes), 0, 8);

    $data = [
      'id_order' => date('ymd').strtoupper($uniqidReal),
      'id_produk' => $id,
      'username' => $this->input->post('username', TRUE),
      'nama' => $this->input->post('nama', TRUE),
      'no_hp' => $this->input->post('no_hp', TRUE),
      'alamat' => $this->input->post('alamat', TRUE),
      'jumlah' => $jumlah,
      'total_harga' => $this->input->post('total', TRUE),
      'tgl_order' => date('Y-m-d H:i:s'),
      'status' => 'Dalam Pesanan'
    ];
    $this->db->insert('penjualan', $data);

    $query = $this->db->get_where('menu', ['id_produk' => $id])->row_array();
    $stok = $query['stok'] - $jumlah;
    $this->db->set('stok', $stok);
    $this->db->where('id_produk', $id);
    $this->db->update('menu');
  }


  // Proses Transaksi
  public function transaksi()
  {
    $result = json_decode($this->input->post('result_data'), TRUE);
    if (isset($result['biller_code'])) {
      $bank = 'mandiri';
    } elseif (isset($result['permata_va_number'])) {
      $bank = 'permata';
    } elseif (isset($result['va_numbers']['0']['bank'])) {
      $bank = $result['va_numbers']['0']['bank'];
    } else {
      $bank = null;
    }

    if (!isset($result['pdf_url'])) {
      $result['pdf_url'] = null;
    }

    if ($result['status_code'] == 200) {
      $data = [
        'id_order' => $result['order_id'],
        'id_produk' => $this->input->post('id_produk', TRUE),
        'username' => $this->input->post('username', TRUE),
        'nama' => $this->input->post('nama', TRUE),
        'no_hp' => $this->input->post('no_hp', TRUE),
        'alamat' => $this->input->post('alamat', TRUE),
        'jumlah' => $this->input->post('jumlah', TRUE),
        'total_harga' => $result['gross_amount'],
        'tgl_order' => $result['transaction_time'],
        'status' => 'Dalam Pesanan'
      ];
      $this->db->insert('penjualan', $data);

      $query = $this->db->get_where('menu', ['id_produk' => $id])->row_array();
      $stok = $query['stok'] - $jumlah;
      $this->db->set('stok', $stok);
      $this->db->where('id_produk', $id);
      $this->db->update('menu');
    } elseif ($result['status_code'] == 201) {
      $data = [
        'id_order' => $result['order_id'],
        'username' => $this->input->post('username', TRUE),
        'nama' => $this->input->post('nama', TRUE),
        'no_hp' => $this->input->post('no_hp', TRUE),
        'alamat' => $this->input->post('alamat', TRUE),
        'id_produk' => $this->input->post('id_produk', TRUE),
        'jumlah' => $this->input->post('jumlah', TRUE),
        'total_harga' => $result['gross_amount'],
        'payment_type' => $result['payment_type'],
        'transaction_time' => $result['transaction_time'],
        'status_code' => $result['status_code'],
        'bank' => $bank,
        'pdf_url' => $result['pdf_url']
      ];
      $this->db->insert('transaksi', $data);
    }
  }


  // Halaman Data Pelanggan
  public function readPelanggan()
  {
    $query = $this->db->get_where('user', array('role' => 'pelanggan'));
    return $query->result_array();
  }


  // Halaman Data Penjualan
  public function readPenjualan($id = FALSE)
  {
    if ($id == FALSE) {
      $this->db->from('penjualan');
      $this->db->order_by('tgl_order', 'DESC');
      return $this->db->get()->result_array();
    } else {
      $query = $this->db->get_where('penjualan', array('id_order' => $id));
      return $query->row_array();
    }
  }

  public function terima($id)
  {
    $this->db->set('status', 'Dikirim');
    $this->db->where('id_order', $id);
    $this->db->update('penjualan');
  }

  public function batalkan($id)
  {
    $data = ['status' => 'Dibatalkan', 'tgl_selesai' => date('Y-m-d H:i:s')];
    $this->db->set('status', 'Dibatalkan');
    $this->db->where('id_order', $id);
    $this->db->update('penjualan', $data);

    $query = $this->db->get_where('penjualan', ['id_order' => $id])->row_array();
    $id_produk = $query['id_produk'];
    $menu = $this->db->get_where('menu', ['id_produk' => $id_produk])->row_array();
    $stok = $menu['stok'] + $query['jumlah'];

    $this->db->set('stok', $stok);
    $this->db->where('id_produk', $id_produk);
    $this->db->update('menu');
  }


  // Barang Sampai
  public function sampai($id)
  {
    $data = ['status' => 'Selesai', 'tgl_selesai' => date('Y-m-d H:i:s')];
    $this->db->where('id_order', $id);
    $this->db->update('penjualan', $data);
  }
}

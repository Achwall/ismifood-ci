<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }

  // method tambah data menu atau produk
  public function create()
  {
    if($this->session->userdata('admin') == '1') {
      $data['username'] = $this->session->userdata('username');
      $this->load->view('admin/header', $data);
      $this->load->view('admin/create');
      $this->load->view('footer');

      if(isset($_POST['create'])) {
        $id = uniqid('item', TRUE);
        
        $config['upload_path'] = './asset/uploads/post';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = '50000'; //dalam KB
        $config['file_ext_tolower'] = TRUE;
        $config['file_name'] = str_replace('.', '_', $id);

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {
          $this->session->set_flashdata('error', $this->upload->display_errors());
          redirect('admin/create');
        } else {
          $filename = $this->upload->data('file_name');
          $this->model->create($id, $filename);
          redirect();
        }
      }
    } else {
      redirect('welcome/login');
    }
  }

  // method update data menu atau produk
  public function update($id)
  {
    if($this->session->userdata('admin') == '1') {
      $data['username'] = $this->session->userdata('username');
      $data['post'] = $this->model->read($id);
      $this->load->view('admin/header', $data);
      $this->load->view('admin/update', $data);
      $this->load->view('footer');

      if(isset($_POST['update'])) {
        $post = $this->model->read($id);
        
        if($this->input->post('file')) {
          $config['upload_path'] = './asset/uploads/post';
          $config['allowed_types'] = 'jpg|jpeg|png';
          $config['max_size'] = '50000'; //dalam KB
          $config['file_ext_tolower'] = TRUE;
          $config['file_name'] = $post->filename;

          $this->load->library('upload', $config);

          if (!$this->upload->do_upload('image')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('admin/update/' . $id);
          } else {
            $filename = $this->upload->data('file_name');
            $this->model->updateMenu($id, $filename);
            redirect();
          }
        } else {
          $filename = $post->filename;
          $this->model->updateMenu($id, $filename);
          redirect();
        }
      }
    } else {
      redirect('welcome/login');
    }
  }

  // method hapus data menu atau produk
  public function delete($id = FALSE)
  {
    if($this->session->userdata('admin') == '1') {
      $this->model->deleteMenu($id);

      $files = glob('./asset/uploads/post/'.str_replace('.', '_', $id).'*');
      foreach ($files as $file) {
        unlink($file);
      }
      redirect();
    } else {
      redirect('welcome/login');
    }
  }

  // menampilkan data penjualan
  public function penjualan($id = FALSE)
  {
    if($this->session->userdata('admin') == '1') {
      $username = $this->session->userdata('username');
      $data['username'] = $username;
      
      $this->load->view('admin/header', $data);
      if ($id == FALSE) {
        $data['penjualan'] = $this->model->readPenjualan();
        $this->load->view('admin/penjualan', $data);
      } else {
        $data['detail'] = $this->model->readPenjualan($id);
        $this->load->view('admin/detail_penjualan', $data);
      }
      $this->load->view('footer');
    } else {
      redirect('welcome/login');
    }
  }

  // method menerima pesanan
  public function terima($id)
  {
    if($this->session->userdata('admin') == '1') {
      $this->model->terima($id);
      redirect('admin/penjualan');
    } else {
      redirect('welcome/login');
    }
  }

  // method membatalkan pesanan
  public function batalkan($id)
  {
    if($this->session->userdata('admin') == '1') {
      $this->model->batalkan($id);
      redirect('admin/penjualan');
    } else {
      redirect('welcome/login');
    }
  }

  // menampilkan data pelanggan
  public function pelanggan()
  {
    if($this->session->userdata('admin') == '1') {
      $data['username'] = $this->session->userdata('username');
      $data['pelanggan'] = $this->model->readPelanggan();
      $this->load->view('admin/header', $data);
      $this->load->view('admin/data_pelanggan', $data);
      $this->load->view('footer');
    } else {
      redirect('welcome/login');
    }
  }
}

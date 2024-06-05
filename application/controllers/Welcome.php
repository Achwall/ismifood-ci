<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }

  public function index($id = FALSE)
  {
    if($this->session->userdata('admin') == '1') {
      $data['username'] = $this->session->userdata('username');
      $this->load->view('admin/header', $data);
      if ($id == FALSE) {
        $data['ringan'] = $this->model->readRingan();
        $data['utama'] = $this->model->readUtama();
        $this->load->view('admin/home', $data);
      } else {
        $data['detail'] = $this->model->read($id);
        $this->load->view('admin/post', $data);
      }
      $this->load->view('footer');

    } elseif($this->session->userdata('pelanggan') == '1') {
      $data['username'] = $this->session->userdata('username');
      $this->load->view('pelanggan/header', $data);
      if ($id == FALSE) {
        $data['ringan'] = $this->model->readRingan();
        $data['utama'] = $this->model->readUtama();
        $this->load->view('pelanggan/home', $data);
      } else {
        $data['detail'] = $this->model->read($id);
        $this->load->view('pelanggan/menu', $data);
      }
      $this->load->view('footer');

    } else {
      session_destroy();
      redirect('welcome/login');
    }
  }

  public function login()
  {
    if (!($this->session->userdata('username'))) {
      $this->load->view('login');
      $this->load->view('footer');
      if(isset($_POST['login'])) {
        $this->_login();
      }
    } else {
      redirect();
    }
  }

  private function _login()
  {
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $this->db->from('user');
    $this->db->where('no_hp', $username);
    $this->db->or_where('username like binary', $username);
    $this->db->or_where('email like binary', $username);
    $data = $this->db->get()->row_array();

    if($data) {
      if(password_verify($password, $data['password'])){
        if ($data['role'] == 'admin') {
          $this->session->set_userdata('admin', '1');
        } else {
          $this->session->set_userdata('pelanggan', '1');
        }

        $this->session->set_userdata('username', $data['username']);
        redirect();
      } else {
        $this->session->set_flashdata('salah_login', '1');
        redirect('welcome/login');
      }
    } else {
      $this->session->set_flashdata('salah_login', '1');
      redirect('welcome/login');
    }
  }

  public function daftar()
  {
    if (!($this->session->userdata('username'))) {
      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->form_validation->set_rules('no_hp', 'Nomor HP', 'is_unique[user.no_hp]|numeric',
        array('is_unique' => 'Nomor HP sudah terdaftar. Silahkan login atau gunakan nomor lain.')
      );
      $this->form_validation->set_rules('username', 'Username', 'is_unique[user.username]',
        array('is_unique' => 'Username sudah terdaftar. Silahkan login atau gunakan username lain.')
      );
      $this->form_validation->set_rules('email', 'Email', 'is_unique[user.email]',
        array('is_unique' => 'Email sudah terdaftar. Silahkan login atau gunakan email lain.')
      );

      if ($this->form_validation->run() == FALSE) {
        $this->load->view('daftar');
        $this->load->view('footer');
      } else {
        $this->model->daftar();
        $this->session->set_flashdata('berhasil_daftar', '1');
        redirect('welcome/login');
      }
    } else {
      redirect();
    }
  }

  public function logout() {
    session_destroy();
    redirect();
  }
}

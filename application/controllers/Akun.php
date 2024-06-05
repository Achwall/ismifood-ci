<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }

  // method ubah profil akun
  public function edit($username = FALSE) {
    if ($username == $this->session->userdata('username')) {
      $data['username'] = $this->session->userdata('username');
      $data['user'] = $this->db->get_where('user', ['username' => $username])->row_array();

      if($this->session->userdata('admin') == '1') {
        $this->load->view('admin/header', $data);
      } else {
        $this->load->view('pelanggan/header', $data);
      }
      $this->load->view('akun', $data);
      $this->load->view('footer');

      if(isset($_POST['akun'])) {
        $this->model->updateAkun($username);
        echo ("<script>
          window.alert('Berhasil ubah profil');
          window.location.href='';
          </script>");
      }
    } else {
      redirect();
    }
  }
}

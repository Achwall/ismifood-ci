<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <title>IsmiFood</title>
  <link rel="icon" type="image/x-icon" href="<?= site_url('./asset/images/halal_icon.png'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
  <div class="navbar-fixed">
    <nav>
      <div class="nav-wrapper green darken-1">
        <div class="container">
          <a href="<?= site_url(); ?>" class="brand-logo">
            <img src="<?= site_url('./asset/images/halal_icon.png'); ?>" width="32px"> IsmiFood
          </a>
          <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
          <ul class="right hide-on-med-and-down">
            <li><a href="<?= site_url('admin/pelanggan'); ?>">Data Pelanggan</a></li>
            <li><a href="<?= site_url('admin/penjualan'); ?>">Data Penjualan</a></li>
            <li><a href="<?= site_url('admin/create'); ?>">Tambah Menu</a></li>
            <li><a href="#!" class="dropdown-trigger" data-target="dropdown1">
              <i class="material-icons left" style="margin-right: 1vh;">account_circle</i><?= $username ?>
            </a></li>
          </ul>
        </div>
      </div>
    </nav>
  </div>

  <!-- Dropdown Structure -->
  <ul id="dropdown1" class="dropdown-content">
    <li><a href="<?= site_url('akun/edit/'.$username); ?>">Akun Saya</a></li>
    <li class="divider"></li>
    <li><a href="<?= site_url('welcome/logout'); ?>">Logout</a></li>
  </ul>

  <!-- Sidenav untuk tampilan device yang lebih kecil -->
  <ul class="sidenav" id="mobile-demo">
    <li><div class="user-view">
      <div class="background">
        <img src="<?= site_url('./asset/images/bg-green-abstract.jpg'); ?>" width="100%">
      </div>
      <img class="circle" src="<?= site_url('./asset/images/user.png'); ?>">
      <span class="white-text name"><?= $username ?></span>
      <span class="white-text email"></span>
    </div></li>
    <li><a href="<?= site_url('akun/edit/'.$username); ?>">Akun Saya</a></li>
    <li><a href="<?= site_url('admin/create'); ?>">Tambah Menu</a></li>
    <li><a href="<?= site_url('admin/penjualan'); ?>">Data Penjualan</a></li>
    <li><a href="<?= site_url('admin/pelanggan'); ?>">Data Pelanggan</a></li>
    <li class="divider"></li>
    <li><a href="<?= site_url('welcome/logout'); ?>" class="btn red">Logout</a></li>
  </ul>

  <main class="container">
    
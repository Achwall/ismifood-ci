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
        <a href="<?= site_url(); ?>" class="brand-logo center">
          <img src="<?= site_url('./asset/images/halal_icon.png'); ?>" width="32px"> IsmiFood
        </a>
      </div>
    </nav>
  </div>
  
  <main>
    <div class="row">
      <div class="col s12 m4 offset-m4">
        <?php if(validation_errors()): ?>
          <div class="card-panel red lighten-4 errorflash"><?= validation_errors(); ?></div>
        <?php endif ?>

        <div class="card-panel form-wrapper z-depth-1">
          <h5 class="center">Daftar</h5><br>
          <form action="<?= site_url('welcome/daftar'); ?>" method="post">
            <div class="row">
              <div class="input-field col s12">
                <input name="no_hp" id="no_hp" type="tel" class="validate" pattern="[0-9]{7,13}" maxlength="13" required>
                <label for="no_hp">Nomor HP</label>
                <span class="helper-text" data-error="Hanya gunakan angka dan minimal 7-13 digit." data-success="">
                  Contoh: 081234567890
                </span>
              </div>
              <div class="input-field col s12">
                <input name="username" id="username" type="text" class="validate" maxlength="20" required>
                <label for="username">Username</label>
              </div>
              <div class="input-field col s12">
                <input name="password" id="password" type="password" class="validate" minlength="8" required>
                <label for="password">Password</label>
                <span class="helper-text" data-error="Password harus diisi minimal 8 karakter." data-success="">
                  Masukkan password minimal 8 karakter
                </span>
              </div>
              <div class="input-field col s12">
                <input name="email" id="email" type="email" class="validate" maxlength="60" required>
                <label for="email">Email</label>
                <span class="helper-text">Contoh: email@ismifood.com</span>
              </div>
              <div class="input-field col s12">
                <input name="nama" id="nama" type="text" class="validate" maxlength="30" required>
                <label for="nama">Nama Lengkap</label>
              </div>
              <div class="input-field col s12">
                <textarea name="alamat" id="alamat" class="materialize-textarea" required></textarea>
                <label for="alamat">Alamat</label>
              </div>
            </div>
            <button class="btn btn-login waves-effect waves-light green" type="submit" name="daftar">Daftar</button>
          </form>
          <div class="center">
            <hr class="atau">
            <span class="grey-text">Sudah punya akun? </span>
            <a class="green-text" href="<?= site_url('welcome/login'); ?>">Login</a>
          </div>
        </div>
      </div>
    </div>

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

	<main class="container">
		<div class="row">
			<div class="col s12 m4 offset-m4">
				<?php if($this->session->flashdata('salah_login')): ?>
					<div class="card-panel red lighten-4">Username atau Password Anda Salah!</div>
				<?php endif ?>

				<?php if($this->session->flashdata('berhasil_daftar')): ?>
					<div class="card-panel green lighten-4">Akun Anda berhasil terdaftar. Silahkan masuk.</div>
				<?php endif ?>

				<div class="card-panel form-wrapper z-depth-1">
					<h4 class="center">Masuk</h4><br>
					<form action="<?= site_url('welcome/login'); ?>" method="post">
						<div class="row">
							<div class="input-field col s12">
								<input name="username" id="username" type="text" required>
								<label for="username">Nomor HP/Username/Email</label>
							</div>
							<div class="input-field col s12">
								<input name="password" id="password" type="password" required>
								<label for="password">Kata Sandi</label>
							</div>
						</div>
						<button class="btn btn-login waves-effect waves-light green" type="submit" name="login">Masuk</button>
					</form>
					<div class="center">
						<hr class="atau">
						<span class="grey-text">Belum punya akun? </span>
						<a class="green-text" href="<?= site_url('welcome/daftar'); ?>">Daftar</a>
					</div>
				</div>
			</div>
		</div>

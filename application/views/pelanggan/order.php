<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript"
  src="https://app.sandbox.midtrans.com/snap/snap.js"
  data-client-key="SB-Mid-client-sLzslhHppuntgSwH"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

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
      <div class="col s12 m6 offset-m3">
        <div class="card-panel form-wrapper z-depth-1">
          <h5 class="center">Konfirmasi Pembelian</h5><br>

          <!-- Form Beli Langsung -->
          <?php if ($keranjang == FALSE) { ?>
            <form id="payment-form" action="<?= site_url('snap/finish'); ?>" method="post">
              <input type="hidden" name="result_type" id="result-type" value="">
              <input type="hidden" name="result_data" id="result-data" value="">
              <input type="hidden" name="username" id="username" value="<?= $user['username']; ?>">
              <input type="hidden" name="id_produk" id="id_produk" value="<?= $produk['id_produk']; ?>">
              <div class="row">
                <div class="input-field col s12">
                  <textarea name="alamat" id="alamat" class="materialize-textarea" required><?= $user['alamat']; ?></textarea>
                  <label for="alamat">Alamat Pengiriman</label>
                </div>
                <div class="input-field col s12">
                  <input name="nama" id="nama" type="text" class="validate" value="<?= $user['nama']; ?>" maxlength="30" required>
                  <label for="nama">Nama Penerima</label>
                </div>
                <div class="input-field col s12">
                  <input name="no_hp" id="no_hp" type="tel" class="validate" value="<?= $user['no_hp']; ?>" pattern="[0-9]{7,13}" maxlength="13" required>
                  <label for="no_hp">Nomor HP</label>
                </div>
                <div class="center col s12">
                  <img class="responsive-img" style="max-height:30vh;" src="<?= site_url('./asset/uploads/post/'.$produk['filename']); ?>">
                </div>
                <div class="input-field col s12">
                  <input name="name" id="name" type="text" value="<?= $produk['nama_produk']; ?>" readonly>
                  <label for="name">Nama Produk</label>
                </div>
                <div class="input-field col s12">
                  <input name="harga" id="harga" type="text" value="<?= $produk['harga']; ?>" readonly>
                  <label for="harga">Harga Satuan</label>
                </div>
                <div class="input-field col s12">
                  <input name="jumlah" id="jumlah" type="text" value="<?= $jumlah; ?>" readonly>
                  <label for="jumlah">Jumlah</label>
                </div>
                <div class="input-field col s12">
                  <input name="total" id="total" type="text" value="<?= $total ?>" readonly>
                  <label for="total">Total Harga</label>
                </div>
                <div class="col s12">
                  <label>
                    <input type="checkbox" class="filled-in" name="cod" id="cod">
                    <span>Pembayaran COD</span>
                  </label>
                </div>
                <div class="col s12"><br><br></div>
                <div class="col s12">
                  <a href="<?= site_url('welcome/index/'.$produk['id_produk']); ?>" class="btn white green-text">
                    <i class="material-icons left">arrow_back</i>Kembali
                  </a>
                  <button class="btn green right" type="submit" id="beli" name="beli">Buat Pesanan<i class="material-icons right">send</i></button>
                </div>
              </div>
            </form>

            <!-- Form Checkout Keranjang -->
          <?php } else { ?>
            <form id="payment-form" action="<?= site_url('snap/finish/'.$keranjang); ?>" method="post">
              <input type="hidden" name="result_type" id="result-type" value="">
              <input type="hidden" name="result_data" id="result-data" value="">
              <input type="hidden" name="username" id="username" value="<?= $user['username']; ?>">
              <input type="hidden" name="id_produk" id="id_produk" value="<?= $produk['id_produk']; ?>">
              <div class="row">
                <div class="input-field col s12">
                  <textarea name="alamat" id="alamat" class="materialize-textarea" required><?= $user['alamat']; ?></textarea>
                  <label for="alamat">Alamat Pengiriman</label>
                </div>
                <div class="input-field col s12">
                  <input name="nama" id="nama" type="text" class="validate" value="<?= $user['nama']; ?>" maxlength="30" required>
                  <label for="nama">Nama Penerima</label>
                </div>
                <div class="input-field col s12">
                  <input name="no_hp" id="no_hp" type="tel" class="validate" value="<?= $user['no_hp']; ?>" pattern="[0-9]{7,13}" maxlength="13" required>
                  <label for="no_hp">Nomor HP</label>
                </div>
                <div class="center col s12">
                  <img class="responsive-img" style="max-height:30vh;" src="<?= site_url('./asset/uploads/post/'.$produk['filename']); ?>">
                </div>
                <div class="input-field col s12">
                  <input name="name" id="name" type="text" value="<?= $produk['nama_produk']; ?>" readonly>
                  <label for="name">Nama Produk</label>
                </div>
                <div class="input-field col s12">
                  <input name="harga" id="harga" type="text" value="<?= $produk['harga']; ?>" readonly>
                  <label for="harga">Harga Satuan</label>
                </div>
                <div class="input-field col s12">
                  <input name="jumlah" id="jumlah" type="text" value="<?= $jumlah; ?>" readonly>
                  <label for="jumlah">Jumlah</label>
                </div>
                <div class="input-field col s12">
                  <input name="total" id="total" type="text" value="<?= $total ?>" readonly>
                  <label for="total">Total Harga</label>
                </div>
                <div class="col s12">
                  <label>
                    <input type="checkbox" class="filled-in" name="cod" id="cod">
                    <span>Pembayaran COD</span>
                  </label>
                </div>
                <div class="col s12"><br><br></div>
                <div class="col s12">
                  <a href="<?= site_url('order/keranjang'); ?>" class="btn white green-text">
                    <i class="material-icons left">arrow_back</i>Kembali
                  </a>
                  <button class="btn green right" type="submit" id="beli" name="beli">Buat Pesanan<i class="material-icons right">send</i></button>
                </div>
              </div>
            </form>
          <?php } ?>
        </div>
      </div>
    </div>

<main class="container">
  <div class="row">
    <div class="col s12">
      <h4 class="header"><?= $detail->nama_produk; ?></h4>
      <div class="card horizontal">
        <div class="card-image">
          <img class="materialboxed" src="<?= site_url('./asset/uploads/post/'.$detail->filename); ?>" style="max-height: 420px;">
        </div>
        <div class="card-stacked">
          <div class="card-content">
            <span class="card-title"><b>Rp<?= number_format($detail->harga,0,",","."); ?></b></span>
            <p>Stok: <?= $detail->stok; ?></p>
            <p style="margin-top: 4px;"><b>Deskripsi:</b></p>
            <pre><?= $detail->deskripsi; ?></pre>
            <?php if ($detail->stok == 0) { ?>
              <p style="color: red;">*Stok kosong. Hubungi WA jika ingin lanjut pemesanan.</p>
            <?php } ?>
          </div>
          <div class="card-action">
            <a href="#modal1" class="waves-effect waves-light btn modal-trigger white green-text" style="margin-right:8px;"
            <?php if ($detail->stok == 0): ?> disabled <?php endif ?>>Keranjang<i class="material-icons left">add_shopping_cart</i></a>

            <a href="#modal2" class="waves-effect waves-light btn modal-trigger green"
            <?php if ($detail->stok == 0): ?> disabled <?php endif ?>>Beli Sekarang</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h5>Mau pesan berapa?</h5>
      <form action="<?= site_url('order/tambah/'.$detail->id_produk); ?>" method="post">
        <div class="row">
          <div class="input-field col s3">
            <input name="jumlah" id="jumlah" type="number" class="validate center" value="1" required min="1" max="<?= $detail->stok; ?>">
            <label class="active" for="jumlah">Jumlah</label>
          </div>
        </div>
        <button class="modal-close btn green" type="submit" name="keranjang" style="width: 100%;">Masukkan Keranjang</button>
      </form>
    </div>
  </div>
  <div id="modal2" class="modal">
    <div class="modal-content">
      <h5>Mau beli berapa?</h5>
      <form action="<?= site_url('order/index/'.$detail->id_produk); ?>" method="post">
        <div class="row">
          <div class="input-field col s3">
            <input name="jumlah" id="jumlah" type="number" class="validate center" value="1" required min="1" max="<?= $detail->stok; ?>">
            <label class="active" for="jumlah">Jumlah</label>
          </div>
        </div>
        <button class="modal-close btn green" type="submit" name="order" style="width: 100%;">Beli Sekarang</button>
      </form>
    </div>
  </div>

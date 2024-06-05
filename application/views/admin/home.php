<h4 class="center-align">Pilihan Menu</h4>
<div class="row">
  <h5>Makanan Ringan</h5>
  <?php foreach($ringan as $data): ?>
    <div class="col s6 m3">
      <a href="<?= site_url('welcome/index/'.$data['id_produk']); ?>" style="color:black;">
        <div class="card small hoverable">
          <div class="card-image waves-effect waves-block waves-light">
            <img src="<?= site_url('./asset/uploads/post/'.$data['filename']); ?>">
          </div>
          <div class="card-content" style="padding: 2vh;">
            <h6 style="margin-top: 0;"><?= $data['nama_produk']; ?></h6>
            <h6 style="color: red;">Rp<?= number_format($data['harga'],0,",","."); ?></h6>
          </div>
        </div>
      </a>
    </div>
  <?php endforeach; ?>
</div>
<div class="row" style="margin-top: 32px;">
  <h5>Makanan Utama</h5>
  <?php foreach($utama as $data): ?>
    <div class="col s6 m3">
      <a href="<?= site_url('welcome/index/'.$data['id_produk']); ?>" style="color:black;">
        <div class="card small hoverable">
          <div class="card-image waves-effect waves-block waves-light">
            <img src="<?= site_url('./asset/uploads/post/'.$data['filename']); ?>">
          </div>
          <div class="card-content" style="padding: 2vh;">
            <h6 style="margin-top: 0;"><?= $data['nama_produk']; ?></h6>
            <h6 style="color: red;">Rp<?= number_format($data['harga'],0,",","."); ?></h6>
          </div>
        </div>
      </a>
    </div>
  <?php endforeach; ?>
</div>

<div class="fixed-action-btn" style="margin-bottom: 2vh;">
  <a href="<?= site_url("admin/create"); ?>" class="btn-floating btn-large green">
    <i class="large material-icons">add</i>
  </a>
</div>

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
        </div>
        <div class="card-action">
          <a href="<?= site_url('admin/update/'.$detail->id_produk); ?>" class="waves-effect waves-light btn blue">Ubah<i class="material-icons left">edit</i></a>
          <a href="<?= site_url('admin/delete/'.$detail->id_produk); ?>" class="waves-effect waves-light btn red right" onClick="return confirm('Anda yakin ingin dihapus?')">Hapus<i class="material-icons left">delete</i></a>
        </div>
      </div>
    </div>
  </div>
</div>

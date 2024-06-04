<div class="row">
  <div class="col s12 m6 offset-m3">
    <?php if($this->session->flashdata('error')): ?>
      <div class="card-panel red lighten-4 errorflash"><?= $this->session->flashdata('error'); ?></div>
    <?php endif ?>

    <div class="card-panel form-wrapper z-depth-1">
      <h5 class="center">Ubah Menu</h5><br>
      <form action="<?= site_url('admin/update/'.$post->id_produk); ?>" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="center col s12">
            <img class="responsive-img" id="image" style="max-height:30vh;" src="<?= site_url('./asset/uploads/post/'.$post->filename); ?>">
          </div>
          <div class="file-field input-field col s12">
            <div class="btn-small">
              <span>Ubah Gambar</span>
              <input type="file" name="image" id="file" accept=".jpg,.jpeg,.png,.gif">
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text" onchange="thumbnail();" name="file">
            </div>
          </div>
          <div class="input-field col s12">
            <input name="name" id="name" type="text" class="validate" value="<?= $post->nama_produk; ?>" maxlength="64" required>
            <label for="name">Nama Produk</label>
          </div>
          <div class="input-field col s12">
            <textarea name="desc" id="desc" class="materialize-textarea" required><?= $post->deskripsi; ?></textarea>
            <label for="desc">Deskripsi</label>
          </div>
          <div class="input-field col s12">
            <input name="harga" id="harga" type="number" class="validate" value="<?= $post->harga; ?>" required>
            <label for="harga">Harga Produk</label>
          </div>
          <div class="input-field col s12">
            <input name="stok" id="stok" type="number" class="validate" value="<?= $post->stok; ?>" required>
            <label for="stok">Stok</label>
          </div>
        </div>
        <div class="row">
          <div class="col s12">
            <a href="<?= site_url('welcome/index/'.$post->id_produk); ?>" class="btn grey lighten-4 green-text">
              <i class="material-icons left">arrow_back</i>Kembali
            </a>
            <button class="btn green right" type="submit" name="update">Simpan<i class="material-icons right">send</i></button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

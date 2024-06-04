<div class="row">
  <div class="col s12 m6 offset-m3">
    <?php if($this->session->flashdata('error')): ?>
      <div class="card-panel red lighten-4 errorflash"><?= $this->session->flashdata('error'); ?></div>
    <?php endif ?>

    <div class="card-panel form-wrapper z-depth-1">
      <h5 class="center">Tambah Menu Baru</h5><br>
      <form action="<?= site_url('admin/create'); ?>" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="center col s12">
            <img class="responsive-img" id="image" style="max-height:30vh;">
          </div>
          <div class="file-field input-field col s12">
            <div class="btn-small">
              <span>Pilih Gambar</span>
              <input type="file" name="image" id="file" accept=".jpg,.jpeg,.png,.gif" required>
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text" onchange="thumbnail();" name="file">
            </div>
          </div>
          <div class="input-field col s12">
            <input name="name" id="name" type="text" class="validate" maxlength="64" required>
            <label for="name">Nama Produk</label>
          </div>
          <div class="input-field col s12">
            <textarea name="desc" id="desc" class="materialize-textarea" required></textarea>
            <label for="desc">Deskripsi</label>
          </div>
          <div class="input-field col s12">
            <select name="kategori" id="kategori" required>
              <option value="" disabled selected>Choose your option</option>
              <option value="Ringan">Makanan Ringan</option>
              <option value="Utama">Makanan Utama</option>
            </select>
            <label for="kategori">Kategori</label>
          </div>
          <div class="input-field col s12">
            <input name="harga" id="harga" type="number" class="validate" required>
            <label for="harga">Harga Produk</label>
          </div>
          <div class="input-field col s12">
            <input name="stok" id="stok" type="number" class="validate" required>
            <label for="stok">Stok</label>
          </div>
        </div>
        <div class="row">
          <div class="col s12">
            <a href="<?= site_url(); ?>" class="btn white green-text"><i class="material-icons left">arrow_back</i>Kembali</a>
            <button class="btn green right" type="submit" name="create">Simpan<i class="material-icons right">send</i></button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

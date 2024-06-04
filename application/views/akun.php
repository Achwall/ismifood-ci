<div class="row">
  <div class="col s12 m6 offset-m3">
    <div class="card-panel form-wrapper z-depth-1">
      <h5 class="center">Ubah Profil</h5><br>
      <form action="<?= site_url('akun/edit/'.$user['username']); ?>" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="input-field col s12">
            <input name="username" id="username" type="text" value="<?= $user['username']; ?>" readonly>
            <label for="username">Username</label>
          </div>
          <div class="input-field col s12">
            <input name="nama" id="nama" type="text" class="validate" maxlength="30" value="<?= $user['nama']; ?>" required>
            <label for="nama">Nama</label>
          </div>
          <div class="input-field col s12">
            <input name="no_hp" id="no_hp" type="tel" class="validate" pattern="[0-9]{7,13}" maxlength="13" value="<?= $user['no_hp']; ?>" required>
            <label for="no_hp">Nomor HP</label>
            <span class="helper-text" data-error="Hanya gunakan angka dan minimal 7-13 digit." data-success="">
              Format: 081234567890
            </span>
          </div>
          <div class="input-field col s12">
            <input name="email" id="email" type="email" class="validate" maxlength="60"> value="<?= $user['email']; ?>" required>
            <label for="email">Email</label>
          </div>
          <div class="input-field col s12">
            <textarea name="alamat" id="alamat" class="materialize-textarea" required><?= $user['alamat']; ?></textarea>
            <label for="alamat">Alamat</label>
          </div>
        </div>
        <div class="row">
          <div class="col s12">
            <a href="<?= site_url(); ?>" class="btn white green-text"><i class="material-icons left">arrow_back</i>Kembali</a>
            <button class="btn green right" type="submit" name="akun">Simpan<i class="material-icons right">send</i></button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

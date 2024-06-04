<div class="card-panel form-wrapper z-depth-1">
  <h5 class="center-align">Data Pelanggan</h5><br>
  <?php if ($pelanggan == NULL) { ?>
    <div class="card-panel red lighten-4 errorflash center"><h6>Belum ada pelanggan.</h6></div>
  <?php } else {
    $no = 1; ?>
    <table class="responsive-table striped">
      <thead>
        <tr>
          <th>No.</th>
          <th>Username</th>
          <th>Nama Lengkap</th>
          <th>Nomor HP</th>
          <th>Email</th>
          <th>Alamat</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach($pelanggan as $data): ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['username']; ?></td>
            <td><?= $data['nama']; ?></td>
            <td><?= $data['no_hp']; ?></td>
            <td><?= $data['email']; ?></td>
            <td><?= $data['alamat']; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php } ?>
</div>

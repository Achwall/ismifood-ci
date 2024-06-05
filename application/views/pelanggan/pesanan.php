<main class="container">
  <div class="card-panel form-wrapper z-depth-1">
    <h5 class="center-align">Riwayat Pesanan</h5><br>
    <?php if ($pesanan == NULL) { ?>
      <div class="card-panel red lighten-4 errorflash center"><h6>Belum ada pesanan</h6></div>
    <?php } else { ?>
      <table class="responsive-table striped">
        <thead>
          <tr>
            <th>Gambar</th>
            <th>Nama Produk</th>
            <th>Harga Satuan</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
            <th>No. Pesanan</th>
            <th>Alamat Pengiriman</th>
            <th>Tanggal Order</th>
            <th>Tanggal Selesai</th>
            <th>Status</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach($pesanan as $data):
            if ($data->status != 'Dikeranjang') {
              $produk = $this->db->get_where('menu', ['id_produk' => $data->id_produk])->row_array(); ?>
              <tr>
                <td><a href="<?= site_url('welcome/index/'.$data->id_produk); ?>">
                  <img src="<?= site_url('./asset/uploads/post/'.$produk['filename']); ?>" style="width: 12vh;">
                </a></td>
                <td><?= $produk['nama_produk']; ?></td>
                <td>Rp<?= number_format($data->total_harga/$data->jumlah,0,",","."); ?></td>
                <td><?= $data->jumlah; ?></td>
                <td>Rp<?= number_format($data->total_harga,0,",","."); ?></td>
                <td><?= $data->id_order; ?></td>
                <td><?= $data->alamat; ?></td>
                <td><?php if ($data->tgl_order) { echo date("d-m-Y H:i", strtotime($data->tgl_order)); } ?></td>
                <td><?php if ($data->tgl_selesai) { echo date("d-m-Y H:i", strtotime($data->tgl_selesai)); } ?></td>
                <?php if ($data->status == "Dikirim") { ?>
                  <td><b>Sedang <?= $data->status; ?></b>
                    <a href="<?= site_url('order/sampai/'.$data->id_order); ?>" class="btn-small" onClick="return confirm('Anda yakin produk sudah sampai?')">Sudah Sampai</a>
                  </td>
                <?php } else { ?>
                  <td><b><?= $data->status; ?></b></td>
                <?php } ?>
              </tr>
            <?php } 
          endforeach; ?>
        </tbody>
      </table>
    <?php } ?>
  </div>

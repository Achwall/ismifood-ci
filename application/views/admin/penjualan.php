<div class="card-panel form-wrapper z-depth-1">
  <h5 class="center-align">Data Penjualan</h5><br>
  <?php if ($penjualan == NULL) { ?>
    <div class="card-panel red lighten-4 errorflash center"><h6>Pesanan kosong. Silahkan promosikan menu makanan agar dapat pembeli.</h6></div>
  <?php } else { ?>
    <table class="responsive-table striped">
      <thead>
        <tr>
          <th>Gambar</th>
          <th>Nama Produk</th>
          <th>Jumlah</th>
          <th>Total Harga</th>
          <th>No. Pesanan</th>
          <th>Nama Penerima</th>
          <th>Alamat Pengiriman</th>
          <th>Status</th>
          <th>Detail</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach($penjualan as $data):
          if ($data['status'] != 'Dikeranjang') {
            $produk = $this->db->get_where('menu', ['id_produk' => $data['id_produk']])->row_array();
            $pembeli = $this->db->get_where('user', ['username' => $data['username']])->row_array(); ?>
            <tr>
              <td><img src="<?= site_url('./asset/uploads/post/'.$produk['filename']); ?>" style="width: 16vh;"></td>
              <td><?= $produk['nama_produk']; ?></td>
              <td><?= $data['jumlah']; ?></td>
              <td>Rp<?= number_format($data['total_harga'],0,",","."); ?></td>
              <td><?= $data['id_order']; ?></td>
              <td><?= $pembeli['nama']; ?></td>
              <td><?= $pembeli['alamat']; ?></td>
              <?php if ($data['status'] == "Dalam Pesanan") { ?>
                <td>
                  <a href="<?= site_url('admin/terima/'.$data['id_order']); ?>" class="btn-small">Terima</a>
                  <a href="<?= site_url('admin/batalkan/'.$data['id_order']); ?>" class="btn-small red" onClick="return confirm('Anda yakin ingin membatalkan pesanan?')">Batalkan</a>
                </td>
              <?php } else { ?>
                <td><b><?= $data['status']; ?></b></td>
              <?php } ?>
              <td><a href="<?= site_url('admin/penjualan/'.$data['id_order']); ?>" class="btn-small blue">Detail</a></td>
            </tr>
          <?php } 
        endforeach; ?>
      </tbody>
    </table>
  <?php } ?>
</div>

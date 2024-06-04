<main class="container">
  <div class="card-panel form-wrapper z-depth-1">
    <h5 class="center-align">Pesanan Belum Bayar</h5><br>
    <?php if ($transaksi == NULL) { ?>
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
            <th>Alamat Pengiriman</th>
            <th>Metode Pembayaran</th>
            <th>No. Pesanan</th>
            <th>Waktu Pemesanan</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach($transaksi as $data):
            $produk = $this->db->get_where('menu', ['id_produk' => $data->id_produk])->row_array(); ?>
            <tr>
              <td><a href="<?= site_url('welcome/index/'.$data->id_produk); ?>">
                <img src="<?= site_url('./asset/uploads/post/'.$produk['filename']); ?>" style="width: 12vh;">
              </a></td>
              <td><?= $produk['nama_produk']; ?></td>
              <td>Rp<?= number_format($produk['harga'],0,",","."); ?></td>
              <td><?= $data->jumlah; ?></td>
              <td>Rp<?= number_format($data->total_harga,0,",","."); ?></td>
              <td><?= $data->alamat; ?></td>
              <td><?= ucfirst($data->payment_type)." ".ucfirst($data->bank) ?></td>
              <td><?= $data->id_order ?></td>
              <td><?= date("d-m-Y H:i", strtotime($data->transaction_time)) ?></td>
              <td><?php if ($data->pdf_url) { ?>
                <a href="<?= $data->pdf_url ?>" class="btn-small green" target="_blank">Bayar Sekarang</a>
              <?php } ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php } ?>
  </div>

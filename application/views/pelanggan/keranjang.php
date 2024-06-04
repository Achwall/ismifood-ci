<main class="container">
  <div class="card-panel form-wrapper z-depth-1">
    <h5 class="center-align">Keranjang Saya</h5><br>
    <?php if ($keranjang == NULL) { ?>
      <div class="card-panel red lighten-4 errorflash center"><h6>Keranjang belanja kosong</h6></div>
      <center><a href="<?= site_url(); ?>" class="btn green">Belanja Sekarang</a></center>
    <?php } else { ?>
      <table class="responsive-table striped centered">
        <thead>
          <tr>
            <th>Gambar</th>
            <th>Nama Produk</th>
            <th>Harga Satuan</th>
            <th>Jumlah</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach($keranjang as $data):
            $produk = $this->db->get_where('menu', ['id_produk' => $data->id_produk])->row_array(); ?>
            <tr>
              <td><a href="<?= site_url('welcome/index/'.$data->id_produk); ?>">
                <img src="<?= site_url('./asset/uploads/post/'.$produk['filename']); ?>" style="width: 25vh;">
              </a></td>
              <td><?= $produk['nama_produk']; ?></td>
              <td>Rp<?= number_format($produk['harga'],0,",","."); ?></td>
              <form action="<?= site_url('order/index/'.$data->id_produk.'/'.$data->id_keranjang); ?>" method="post">
                <td><input name="jumlah" type="number" value="<?= $data->jumlah; ?>" required style="width: 6vh; text-align: center;" min="1" max="<?= $produk['stok']; ?>"></td>
                <td><button class="btn" type="submit" name="checkout">Checkout</button></td>
              </form>
              <td><a href="<?= site_url('order/hapus/'.$data->id_keranjang); ?>" class="btn red" onClick="return confirm('Anda yakin ingin dihapus?')">Hapus</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php } ?>
  </div>

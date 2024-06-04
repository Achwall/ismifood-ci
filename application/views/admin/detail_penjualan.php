<?php $produk = $this->db->get_where('menu', ['id_produk' => $detail['id_produk']])->row_array();
$pembeli = $this->db->get_where('user', ['username' => $detail['username']])->row_array(); ?>

<div class="row">
  <div class="col s12 m8 offset-m2">
    <div class="card-panel form-wrapper z-depth-1">
      <h5 class="center">Detail Pesanan</h5><br>
      <div class="row">
        <div class="col s12">
          <div class="card horizontal">
            <div class="card-image">
              <a href="<?= site_url('welcome/index/'.$produk['id_produk']); ?>" style="color: black;">
                <img src="<?= site_url('./asset/uploads/post/'.$produk['filename']); ?>">
              </a>
            </div>
            <div class="card-stacked">
              <div class="card-content">
                <span class="card-title"><b><?= $produk['nama_produk']; ?></b></span>
                <table>
                  <tr></tr>
                  <tr>
                    <td style="border-right: 1px solid rgba(0, 0, 0, 0.12);">Harga Satuan:</td>
                    <td>Rp<?= number_format($detail['total_harga']/$detail['jumlah'],0,",","."); ?></td>
                  </tr>
                  <tr>
                    <td style="border-right: 1px solid rgba(0, 0, 0, 0.12);">Jumlah:</td>
                    <td>x<?= $detail['jumlah']; ?></td>
                  </tr>
                  <tr>
                    <td style="border-right: 1px solid rgba(0, 0, 0, 0.12);">Total Harga:</td>
                    <td>Rp<?= number_format($detail['total_harga'],0,",","."); ?></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          
        </div>
        <div class="col s12">
          <hr style="margin: 2vh 0 3vh;">
          <h6><b>Alamat Pengiriman</b></h6>
          <div class="col s6" style="border-right: 1px solid grey;">
            <p>
              <b><?= $detail['nama']; ?></b><br>
              <?= $detail['no_hp']; ?><br>
              <?= $detail['alamat']; ?>
            </p>
          </div>
          <div class="col s6">
            <p>
              <?php if ($detail['tgl_order']) { echo "Tanggal Order: ".date("d-m-Y H:i", strtotime($detail['tgl_order'])); } ?><br>
              <?php if ($detail['tgl_selesai']) { echo "Tanggal Selesai: ".date("d-m-Y H:i", strtotime($detail['tgl_selesai'])); } ?>
            </p>
          </div>
        </div>
        <div class="col s12">
          <hr style="margin: 3vh 0;">
          <div class="left">
            <h6>No. Pesanan: <?= $detail['id_order']; ?></h6>
            <br>
            <a href="<?= site_url('admin/penjualan'); ?>" class="btn white green-text"><i class="material-icons left">arrow_back</i>Kembali</a>
          </div>
          <div class="right">
            <h6>Status: <?= $detail['status']; ?></h6>
            <br>
            <?php if ($detail['status'] == "Dalam Pesanan") { ?>
              <a href="<?= site_url('admin/terima/'.$detail['id_order']); ?>" class="btn">Terima</a>
              <a href="<?= site_url('admin/batalkan/'.$detail['id_order']); ?>" class="btn red" onClick="return confirm('Anda yakin ingin membatalkan pesanan?')">Batalkan</a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style type="text/css">
  table, tr, td {
    text-align: right;
  }
</style>

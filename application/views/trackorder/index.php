<?php $id_active = isset($active_order[0]['order_id']) ? $active_order[0]['order_id'] : ''; ?>

<div class="container" style="margin-top: 150px;">
  <h3 style="text-align: center; font-weight: bold;">Detail Order</h3>
  <div class="dropdown show">
    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Choose Order
    </a>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
      <?php
      foreach ($orders as $item) {
      ?>
        <a class="dropdown-item" href="<?= base_url('track/active_order/' . $item['id']) ?>">
          <p>Order <?= $item['id'] ?></p>
        </a>
      <?php
      }
      ?>
    </div>
  </div>
  <?php
  if (isset($all_data)) {
  ?>

    <table class="table table-light">
      <thead>
        <tr>
          <th>ID</th>
          <th>Order ID</th>
          <th>Produk Name</th>
          <th>Pcs</th>
          <th>Total</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($all_data as $item) {
          if ($item['order_id'] == $id_active) {
        ?>
            <tr>
              <td class="pt-2"><?= $item['id'] ?></td>
              <td class="pt-2"><?= $item['order_id'] ?></td>
              <td class="pt-2"><?= $item['nama'] . ' : ' . $item['model_produk'] ?></td>
              <td class="pt-2"><?= $item['pcs'] ?></td>
              <td class="pt-2"><?= $item['subtotal'] ?></td>
              <td class="pt-0">
                <?php if ($payment['status_dp'] == 0) { ?>
                  <a class="btn btn-primary pt" href="<?= base_url('payment/payment_continue/' . $item['id']) ?>" role="button">
                    Lanjutkan pembayaran DP
                  </a>
                <?php } else if ($payment['status_dp'] == 1 && $item['order_status'] >= 4) { ?>
                  <a class="btn btn-primary pt" href="<?= base_url('payment/payment_continue/' . $item['id']) ?>" role="button">
                    Lanjutkan pembayaran pelunasan
                  </a>
                <?php } ?>
              </td>
            </tr>
        <?php
          }
        }

        ?>
      </tbody>
    </table>
  <?php } ?>
</div>

<div class="container" style="margin-top: 100px;">
  <h3 style="text-align: center; font-weight: bold;">Track Order</h3>

  <?php foreach ($orders as $item) { ?>
    <?php if ($item['id'] == $id_active) { ?>
      <img src="<?= base_url('assets/img/line.png') ?>" style="position: absolute; z-index: 2; width: 3px; margin-left: 560px; margin-top: 43px;" alt="">
      <img src="<?= base_url('assets/img/line.png') ?>" style="position: absolute; z-index: 2; width: 3px; margin-left: 560px; margin-top: 108px;" alt="">
      <img src="<?= base_url('assets/img/line.png') ?>" style="position: absolute; z-index: 2; width: 3px; margin-left: 560px; margin-top: 170px;" alt="">
      <img src="<?= base_url('assets/img/line.png') ?>" style="position: absolute; z-index: 2; width: 3px; margin-left: 560px; margin-top: 235px;" alt="">
      <img src="<?= base_url('assets/img/line.png') ?>" style="position: absolute; z-index: 2; width: 3px; margin-left: 560px; margin-top: 300px;" alt="">
      <img src="<?= base_url('assets/img/line.png') ?>" style="position: absolute; z-index: 2; width: 3px; margin-left: 560px; margin-top: 365px;" alt="">
      <img src="<?= base_url('assets/img/line.png') ?>" style="position: absolute; z-index: 2; width: 3px; margin-left: 560px; margin-top: 425px;" alt="">
      <div class="row" style="margin-top: 20px; position: relative;">
        <div class="col-2 pr-0" style="margin-left: 410px; max-width: 10%;">
          <?php if ($item['order_status'] >= 1) { ?>
            <img class="" src="<?= base_url('assets/img/tick.png') ?>" style="width: 40px; z-index: 2; position: absolute; margin-left: 70px; margin-top: -10px" alt="">
          <?php } else { ?>
            <img class="float-right" src="<?= base_url('assets/img/bulat.png') ?>" style="width: 30px; z-index: 1; position: relative;" alt="">
          <?php } ?>
        </div>
        <div class="col-10 pt-1 pl-4" style="max-width: 30%">
          <p>Menunggu Pembayaran</p>
        </div>
      </div>
      <div class="row" style="margin-top: 20px; position: relative; z-index: 1;">
        <div class="col-2 pr-0" style="margin-left: 410px; max-width: 10%;">
          <?php if ($item['order_status'] >= 2) { ?>
            <img class="" src="<?= base_url('assets/img/tick.png') ?>" style="width: 40px; z-index: 2; position: absolute; margin-left: 70px; margin-top: -10px" alt="">
          <?php } else { ?>
            <img class="float-right" src="<?= base_url('assets/img/bulat.png') ?>" style="width: 30px; z-index: 1; position: relative;" alt="">
          <?php } ?>
        </div>
        <div class="col-10 pt-1 pl-4" style="max-width: 30%">
          <p>Diproses</p>
        </div>
      </div>
      <div class="row" style="margin-top: 20px;">
        <div class="col-2 pr-0" style="margin-left: 410px; max-width: 10%;">
          <?php if ($item['order_status'] >= 3) { ?>
            <img class="" src="<?= base_url('assets/img/tick.png') ?>" style="width: 40px; z-index: 2; position: absolute; margin-left: 70px; margin-top: -10px" alt="">
          <?php } else { ?>
            <img class="float-right" src="<?= base_url('assets/img/bulat.png') ?>" style="width: 30px; z-index: 1; position: relative;" alt="">
          <?php } ?>
        </div>
        <div class="col-10 pt-1 pl-4" style="max-width: 30%">
          <p>Proses produksi</p>
        </div>
      </div>
      <div class="row" style="margin-top: 20px;">
        <div class="col-2 pr-0" style="margin-left: 410px; max-width: 10%;">
          <?php if ($item['order_status'] >= 4) { ?>
            <img class="" src="<?= base_url('assets/img/tick.png') ?>" style="width: 40px; z-index: 2; position: absolute; margin-left: 70px; margin-top: -10px" alt="">
          <?php } else { ?>
            <img class="float-right" src="<?= base_url('assets/img/bulat.png') ?>" style="width: 30px; z-index: 1; position: relative;" alt="">
          <?php } ?>
        </div>
        <div class="col-10 pt-1 pl-4" style="max-width: 30%">
          <p>Produksi selesai</p>
        </div>
      </div>
      <div class="row" style="margin-top: 20px;">
        <div class="col-2 pr-0" style="margin-left: 410px; max-width: 10%;">
          <?php if ($item['order_status'] >= 5) { ?>
            <img class="" src="<?= base_url('assets/img/tick.png') ?>" style="width: 40px; z-index: 2; position: absolute; margin-left: 70px; margin-top: -10px" alt="">
          <?php } else { ?>
            <img class="float-right" src="<?= base_url('assets/img/bulat.png') ?>" style="width: 30px; z-index: 1; position: relative;" alt="">
          <?php } ?>
        </div>
        <div class="col-10 pt-1 pl-4" style="max-width: 30%">
          <p>Menunggu pelunasan</p>
        </div>
      </div>
      <div class="row" style="margin-top: 20px;">
        <div class="col-2 pr-0" style="margin-left: 410px; max-width: 10%;">
          <?php if ($item['order_status'] >= 6) { ?>
            <img class="" src="<?= base_url('assets/img/tick.png') ?>" style="width: 40px; z-index: 2; position: absolute; margin-left: 70px; margin-top: -10px" alt="">
          <?php } else { ?>
            <img class="float-right" src="<?= base_url('assets/img/bulat.png') ?>" style="width: 30px; z-index: 1; position: relative;" alt="">
          <?php } ?>
        </div>
        <div class="col-10 pt-1 pl-4" style="max-width: 30%">
          <p>Pelunasan terkonfirmasi</p>
        </div>
      </div>
      <div class="row" style="margin-top: 20px;">
        <div class="col-2 pr-0" style="margin-left: 410px; max-width: 10%;">
          <?php if ($item['order_status'] >= 7) { ?>
            <img class="" src="<?= base_url('assets/img/tick.png') ?>" style="width: 40px; z-index: 2; position: absolute; margin-left: 70px; margin-top: -10px" alt="">
          <?php } else { ?>
            <img class="float-right" src="<?= base_url('assets/img/bulat.png') ?>" style="width: 30px; z-index: 1; position: relative;" alt="">
          <?php } ?>
        </div>
        <div class="col-10 pt-1 pl-4" style="max-width: 30%">
          <p>Pengiriman</p>
        </div>
      </div>
      <div class="row" style="margin-top: 20px;">
        <div class="col-2 pr-0" style="margin-left: 410px; max-width: 10%;">
          <?php if ($item['order_status'] >= 8) { ?>
            <img class="" src="<?= base_url('assets/img/tick.png') ?>" style="width: 40px; z-index: 2; position: absolute; margin-left: 70px; margin-top: -10px" alt="">
          <?php } else { ?>
            <img class="float-right" src="<?= base_url('assets/img/bulat.png') ?>" style="width: 30px; z-index: 1; position: relative;" alt="">
          <?php } ?>
        </div>
        <div class="col-10 pt-1 pl-4" style="max-width: 30%">
          <p>Transaksi selesai</p>
        </div>
      </div>
    <?php } ?>

  <?php } ?>
</div>

<script>
  $("")
</script>
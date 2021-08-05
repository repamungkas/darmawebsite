<?php
// var_dump($order_id);
?>
<div class="container" style="margin-top: 150px;">
    <?= $this->session->flashdata('message1'); ?>
    <h3 style="text-align: center; font-weight: bold;">Confirmation</h3>
    <p style="text-align: center; margin-top: 50px;">Please upload the payment bank receipt </p>
    <!-- <?php echo json_encode($payment); ?> -->
    <!-- <?php echo json_encode($payment['final_bill']); ?> -->
    <div class="container" style="border: 1px solid black; border-radius: 20px; width: 60%;">
        <h5 class="mt-3">Fill for data confirmation</h5>
        <hr>
        <div class="row">
            <div class="col">
                <?php if ($payment['status_dp'] > 0) { ?>
                    <?php echo form_open_multipart('payment/pelunasan'); ?>
                    <form action="<?= base_url('payment/pelunasan') ?>" method="post">
                        <div class="md-form form-group mt-4">
                            <h5 class="mt-3">Order Number : <?= $this->session->userdata('order_number')  ?></h5>
                            <input type="text" class="form-control" id="order_id" name="order_id" value="<?= $this->session->userdata('order_number')  ?>" hidden>
                        </div>
                        <div class="md-form form-group mt-4">
                            <input type="text" class="form-control" id="name" name="name">
                            <label for="formGroupExampleInputMD">Nama</label>
                        </div>
                        <div class="md-form form-group mt-4">
                            <h6 class="mt-3">Jumlah transfer : </h6>
                            <?php if ($payment['status_dp'] == 0) { ?>
                                <h6 class="mt-3"><?= $payment['dp_bill'] ?></h6>
                            <?php } else { ?>
                                <h6 class="mt-3"><?= $payment['final_bill'] ?></h6>
                            <?php } ?>
                        </div>
                        <p class="pt-2">Jenis pembayaran</p>
                        <?php if ($payment['status_dp'] == 0) { ?>
                            <h6 value="DP">DP</h6>
                        <?php } else { ?>
                            <h6 value="Pelunasan">Pelunasan</h6>
                        <?php } ?>
                        <p class="pt-2">Bank reciept</p>
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="userfile" size="20">
                        </div>
                        <button type="submit" value="upload">Submit</button>
                    </form>
                <?php } else { ?>
                    <?php echo form_open_multipart('payment/doconfirm'); ?>
                    <form action="<?= base_url('payment/doconfirm/') ?>" method="post">
                        <div class="md-form form-group mt-4">
                            <h5 class="mt-3">Order Number : <?= $this->session->userdata('order_number')  ?></h5>
                            <input type="text" class="form-control" id="order_id" name="order_id" value="<?= $this->session->userdata('order_number')  ?>" hidden>
                        </div>
                        <div class="md-form form-group mt-4">
                            <input type="text" class="form-control" id="name" name="name">
                            <label for="formGroupExampleInputMD">Nama</label>
                        </div>
                        <div class="md-form form-group mt-4">
                            <h6 class="mt-3">Jumlah transfer : </h6>
                            <?php if ($payment['status_dp'] == 0) { ?>
                                <h6 class="mt-3"><?= $payment['dp_bill'] ?></h6>
                            <?php } else { ?>
                                <h6 class="mt-3"><?= $payment['final_bill'] ?></h6>
                            <?php } ?>
                        </div>
                        <p class="pt-2">Jenis pembayaran</p>
                        <?php if ($payment['status_dp'] == 0) { ?>
                            <h6 value="DP">DP</h6>
                        <?php } else { ?>
                            <h6 value="Pelunasan">Pelunasan</h6>
                        <?php } ?>
                        <p class="pt-2">Bank reciept</p>
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="userfile" size="20">
                        </div>
                        <button type="submit" value="upload">Submit</button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
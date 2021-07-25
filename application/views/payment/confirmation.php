<?php
// var_dump($order_id);
?>
<div class="container" style="margin-top: 150px;">
    <?= $this->session->flashdata('message1'); ?>
    <h3 style="text-align: center; font-weight: bold;">Confirmation</h3>
    <p style="text-align: center; margin-top: 50px;">Please upload the payment bank receipt </p>
    <div class="container" style="border: 1px solid black; border-radius: 20px; width: 60%;">
        <h5 class="mt-3">Fill for data confirmation</h5>
        <hr>
        <div class="row">
            <div class="col">
                <?php echo form_open_multipart('payment/doconfirm'); ?>
                <form action="<?= base_url('payment/doconfirm/') ?>" method="post">
                    <div class="md-form form-group mt-4">
                        <input type="text" class="form-control" id="name" name="name">
                        <label for="formGroupExampleInputMD">Nama</label>
                    </div>
                    <div class="md-form form-group mt-4">
                        <input type="text" class="form-control" id="id_order" name="order_id" value="<?= $this->session->userdata('order_id') ?>">
                        <label for="formGroupExampleInput2MD">ID Order</label>
                    </div>
                    <div class="md-form form-group mt-4">
                        <input type="text" class="form-control" id="jumlah_transfer" name="transfer_bill" value="<?= $this->session->userdata('dp_total') ?>">
                        <label for="formGroupExampleInput2MD">Jumlah transfer</label>
                    </div>
                    <p class="pt-2">Jenis pembayaran</p>
                    <div class="form-group">
                        <div class="form-group col-md-4 p-0">
                            <select class="form-control" id="jenis_pembayaran" name="jenis_pembayaran">
                                <?php if ($this->session->userdata('status_dp') == 0) { ?>
                                    <option value="DP">DP</option>
                                <?php } else { ?>
                                    <option value="Pelunasan">Pelunasan</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <p class="pt-2">Bank reciept</p>
                    <div class="form-group">
                        <input type="file" class="form-control-file" name="userfile" size="20">
                    </div>
                    <button type="submit" value="upload">Submit</button>
                </form>

            </div>
        </div>
    </div>
</div>
<?php
// var_dump($order_id);
?>
<div class="container" style="margin-top: 150px;">
    <h3 style="text-align: center; font-weight: bold;">Confirmation</h3>
    <p style="text-align: center; margin-top: 50px;">Please upload the payment bank receipt </p>
    <div class="container" style="border: 1px solid black; border-radius: 20px; width: 60%;">
        <h5 class="mt-3">Fill for data confirmation</h5>
        <hr>
        <div class="row">
            <div class="col">
                <form action="<?= base_url('payment/doconfirm/') ?>">
                    <div class="md-form form-group mt-4">
                        <input type="text" class="form-control" id="formGroupExampleInputMD">
                        <label for="formGroupExampleInputMD">Nama</label>
                    </div>
                    <div class="md-form form-group mt-4">
                        <input type="text" class="form-control" id="formGroupExampleInput2MD">
                        <label for="formGroupExampleInput2MD">ID Order</label>
                    </div>
                    <div class="md-form form-group mt-4">
                        <input type="text" class="form-control" id="formGroupExampleInput2MD">
                        <label for="formGroupExampleInput2MD">Jumlah transfer</label>
                    </div>
                    <p class="pt-2">Bank reciept</p>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    <button type="submit">Submit</button>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="container" style="margin-top: 150px;">
    <h3 style="text-align: center; font-weight: bold;">Payment</h3>
    <p style="text-align: center; margin-top: 50px;">Please complete the payment immediately so that the order can be processed </p>
    <div class="container" style="border: 1px solid black; border-radius: 20px; width: 60%;">
        <h5 class="mt-3">Order Number : <?= $this->session->userdata('order_number')  ?></h5>
        <hr>
        <div class="row">
            <div class="col-sm">
                <img style="width: 100px;" src="<?= base_url('assets/img') ?>/bca.png" alt="">
            </div>
            <div class="col-sm">
                <div class="row">
                    <div class="col text-right">
                        <p class="mb-0 mt-3" style="font-weight: bold;">444-606060<a class="ml-2" href="" style="font-size: 10pt;">Copy</a></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-right">
                        <p class="mb-0">A/N Bahar Laksamana</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <p style="font-weight: bold;">Total Payment</p>
            </div>
            <div class="col-sm">
                <p class="float-right" style="font-weight: bold;">Total Payment</p>
            </div>
        </div>
    </div>
    <a href="<?= base_url('payment') ?>/confirmation">
        <h4 class="mt-5 float-right" style="color: black;">Confirmation payment <i class="fas fa-arrow-right"></i></h4>
    </a>
</div>
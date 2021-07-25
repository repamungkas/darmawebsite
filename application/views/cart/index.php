<div class="container" style="margin-top: 150px;">
    <h3 style="text-align: center; font-weight: bold;">Cart</h3>
    <!-- <?php echo json_encode($this->session->userdata('product_type')) ?> -->
    <!-- <?php echo json_encode($_SESSION) ?> -->
    <div class="row pt-4">
        <div class="col-7" style="padding-right: 0px; padding-left: 0px; border: 2px solid black; border-radius: 20px; height: fit-content;">
            <h5 class="pl-3 pt-3">Shipping address</h5>
            <hr style="border: 1px solid black;">
            <?php
            if (count($user) > 0) {
                echo "<p class='ml-2'>" . $user['address'] . "</p>";
            ?>
            <?php } else { ?>
                <p class="pl-3 pt-2">No shipping address has been yet</p>
                <a href="" class="pl-3 pt-2" style="font-weight: bold;">Add address</a>
            <?php } ?>
            <!-- <a href="<?= base_url() ?>cart/clear_cart" class="btn btn-danger pt-2 pb-2" style="float: right;"><i class="far fa-trash-alt" style="font-size: 16pt;"></i></a> -->
        </div>
        <?php $i = 1; ?>
        <?php $itemcontent = $this->cart->contents(); ?>
        <div class="col-4" style=" margin-left: 50px; border: 2px solid black; border-radius: 20px;">
            <h5 class="pl-2 pt-3" style="font-weight: bold;">Summary</h5>
            <br>
            <div class="row pr-2">
                <div class="col-8">
                    <p>Total</p>
                </div>
                <div class="col-4 text-right">
                    <?php
                    $total = 0;
                    foreach ($this->cart->contents() as $items) {
                        $subtotal = $items['price'] * $items['qty'];
                        $total = $total + $subtotal;
                    }
                    $this->session->set_userdata('grand_total', $total);
                    // echo json_encode($itemcontent);
                    // $this->session->set_userdata('order_type', $total);
                    ?>
                    <p><?= 'IDR ' . number_format($total, 0, '', '.') ?></p>
                </div>
            </div>
            <div class="row pr-2">
                <div class="col-8">
                    <p>DP 50%</p>
                </div>
                <div class="col-4 text-right">
                    <?php
                    $dp = 0;
                    $dp = $total / 2;
                    $this->session->set_userdata('dp_total', $dp);
                    ?>
                    <p><?= 'IDR ' . number_format($dp, 0, '', '.') ?></p>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-8">
                    <p>Total shipping Costs</p>
                </div>
                <div class="col-4">
                    <p>IDR. 0</p>
                </div>
            </div> -->
            <div class="row">
                <div class="col">
                    <hr>
                </div>
            </div>
            <div class="row pr-2">
                <div class="col-8">
                    <p style="font-weight: bold;">Total DP</p>
                </div>
                <div class="col-4">
                    <?php if ($dp > 0) { ?>
                        <p><?= 'IDR ' . number_format($dp, 0, '', '.') ?></p>
                    <?php } else { ?>
                        <p><?= 'IDR ' . number_format($total, 0, '', '.') ?></p>
                    <?php } ?>
                </div>
            </div>
            <?php if ($this->session->has_userdata('email')) { ?>
                <a href="<?= base_url('payment') ?>" class="btn btn-primary rounded-pill checkout" style="display: block;">DP Payment</a>
            <?php } else { ?>
                <a href="<?= base_url('auth') ?>" class="btn btn-primary rounded-pill checkout" style="display: block;">Login untuk order</a>
            <?php } ?>
        </div>
        <div class="col-7" style="padding-right: 0px; padding-left: 0px; border: 2px solid black; border-radius: 20px; margin-top: -100px;">
            <h5 class="pl-3 pt-3">Detail Product</h5>
            <hr style="border-width: 2px; border-color: black;">
            <div class="row">
                <?php foreach ($this->cart->contents() as $items) : ?>
                    <div class="col-3 ml-4 text-center px-1 py-1 mb-3" style="border: 1px solid black; border-radius: 20px;">
                        <img class="rounded my-2" src="<?= base_url() ?>/assets/img/produk/<?= $items['options']['gambar'] ?>" style="width: 150px;" alt="">
                    </div>
                    <div class="col-5">
                        <p><?= $items['name'] . ' ' . $this->session->userdata('product_type') ?></p>
                        <p><?= $items['options']['ukuran'] ?></p>
                        <p><?= $items['qty'] . ' pcs' ?></p>
                    </div>
                    <div class="col-3 text-right">
                        <a href="<?= base_url('cart/clear_cart/' . $items['rowid']) ?>"><i class="far fa-trash-alt"></i></a>
                        <p class="mt-3"><?= 'IDR ' . number_format(($items['price'] * $items['qty']), 0, '', '.') ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>


    <!-- <a class="btn btn-success checkout" href="<?= base_url('cart/checkout') ?>">Checkout</a> -->
    <!-- <a href="https://wa.me/+6282257537871?text=Saya%20tertarik%20dengan%20mobil%20Anda%20yang%20dijual%0Aini%20baris2" class="btn btn-success" target="_blank">Checkout</a> -->
    <!-- <a href="<?= base_url() ?>cart/checkout" class="btn btn-success">Checkout</a> -->
    <script>
        $('.checkout').click(function() {
            var nama = $('#nama').val()
            var email = $('#email').val()
            var alamat = $('#alamat').val()
            var no_hp = $('#no_hp').val()
            var output = 'Nama %3A ' + nama + ' %0A' +
                'Email %3A ' + email + ' %0A' +
                'No hp %3A ' + no_hp + ' %0A' +
                'Alamat %3A ' + alamat + ' %0A%0A' +
                '<?= $output ?>'
            location.href = 'https://wa.me/+6282257537871?text=' + output
        })
    </script>
</div>
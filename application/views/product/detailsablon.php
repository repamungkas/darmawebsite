<div class="container">
    <?php echo form_open_multipart('product/add_cart/sablon'); ?>
    <form action="<?= base_url('product/add_cart/sablon') ?>" method="post">
        <div class="container">
            <?= $this->session->flashdata('message'); ?>
            <?php foreach ($query as $p) : ?>
                <div class="row myrow" style="margin-top: 150px; margin-left: 0px;">
                    <div class="col-6 mycol" style="padding-left: 50px; padding-right: 0px; margin-left: -20px;">
                        <div class="box" style="border: 2px solid black;">
                            <!-- <img src="<?= base_url('assets') ?>/img/produk/<?= $p->gambar; ?>" style="width: 159px; height: fit-content;"> -->
                        </div>
                        <div class="box" style="border: 2px solid black;">
                            <!-- <img src="<?= base_url('assets') ?>/img/produk/<?= $p->gambar; ?>" style="width: 159px; height: fit-content;"> -->
                        </div>
                        <div class="box" style="border: 2px solid black;">
                            <!-- <img src="<?= base_url('assets') ?>/img/produk/<?= $p->gambar; ?>" style="width: 159px; height: fit-content;"> -->
                        </div>
                    </div>
                    <div class="col-6 mycol1" style="padding-left: 5px; padding-top: 5px;">
                        <div class="boxgambar" style="border: 2px solid black;">
                            <img src="<?= base_url('assets') ?>/img/produk/<?= $p->gambar; ?>" style="width: 495px;">
                        </div>
                    </div>
                    <div class="col mt-2">

                        <!-- <form action="" method="post"> -->
                        <h4><?= $p->nama; ?> <?= $p->model_produk; ?></h4>
                        <h4><?= $p->ukuran; ?></h4>
                        <p class="mb-0" id="display_harga">IDR <?= number_format($p->harga, 0, '', '.') ?></p>
                        <input type="hidden" id="harga" name="harga" value="<?= $p->harga ?>">
                        <input type="hidden" id="harga_sablon_logo" name="harga_sablon_logo" value="50000">
                        <br>
                        <p style="font-weight: bold; margin-top: -5px; margin-bottom: 10px; font-size: 14pt;">QTY</p>
                        <div class="form-group">
                            <div class="form-group col-md-4 p-0 ">
                                <select class="form-control mb-0" id="jumlah" name="jumlah">
                                    <option value="50">50pcs</option>
                                    <option value="100">100pcs</option>
                                    <option value="200">200pcs</option>
                                    <option value="300">300pcs</option>
                                    <option value="400">400pcs</option>
                                    <option value="500">500pcs</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <p style="font-weight: bold; margin-bottom: 10px; font-size: 14pt; margin-top: -20px;">Ukuran gambar</p>
                        <div class="form-group">
                            <div class="form-group p-0">
                                <select class="form-control" id="ukuran_sablon" name="ukuran_sablon">
                                    <option value="normal">20.5CM X 31CM</option>
                                    <option value="besar">Lebih dari 20.5CM X 31CM</option>
                                </select>
                            </div>
                        </div>
                        <div id="biaya_sablon"></div>
                        <h5>Total</h5>
                        <input type="hidden" id="total" name="harga" value="<?= $p->harga ?>">
                        <p class="mb-0" id='display_total' style="font-weight: bold;"></p>
                        <br>
                        <input type="hidden" name="id" value="<?= $p->id ?>">
                        <h5 style="margin-top: -10px;" class="font-weight-bold mb-0"><a class="menu" href="#uploadlogo">Upload desain logo anda</a></h5>
                        <!-- <form>
                        <div class="form-group">
                            <input type="file" name="userfile" class="form-control-file mt-4" id="exampleFormControlFile1">
                        </div>
                    </form> -->

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="container">
            <h4 id="uploadlogo">Upload Design Logo</h4>
            <hr>
            <div class="row">
                <div class="col-6">
                    <!-- <form action="<?= base_url('product/uploaddesign')  ?>" method="post"> -->
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Area Sablon</label>
                        <select class="form-control w-50" id="area_sablon" name="area_sablon">
                            <option>Depan dan atas</option>
                            <option>Atas dan belakang</option>
                            <option>Depan, atas dan belakang</option>
                            <option>Samping kanan dan kiri</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="warna">Warna Sablon</label>
                        <input type="text" class="form-control w-50" id="warna" name="warna" aria-describedby="emailHelp" placeholder="masukkan 1 warna">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Upload desain logo anda</label>
                        <input type="file" name="userfile" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <p style="font-weight: bold;">Note</p>
                    <ul>
                        <li>Format file vector ai,cdr,ps atau pdf</li>
                        <li>Ukuran file max 45mb</li>
                        <li>Warna pilihan 1 warna</li>
                        <li>Tidak full block</li>
                    </ul>
                    <!-- </form> -->
                </div>
                <div class="col-6">
                    <h5 class="mb-5" style="font-weight: bold;">Contoh area desain logo</h5>
                    <img style="width: 350px;" src="<?= base_url('assets/img/layoutcontohsablon.png') ?>" alt="">
                </div>
            </div>
        </div>
        <button class="btn btn-primary p-2 mt-5 w-25" style="font-size: 12pt;"><i class="fas fa-cart-plus " style="font-size: 12pt;"></i> ORDER NOW !</button>
    </form>
</div>
<script>
    var min_qty = $('#jumlah').val()
    var default_harga = $('#harga').val()
    var total = min_qty * default_harga

    $('#biaya_sablon').append(`<h6> + Biaya sablon IDR 50.000</h6><br>`)
    total = total + 50000

    $('#display_total').append(formatRupiah(total, 'IDR '))

    $('#jumlah').change(function() {
        // var harga = $('#harga').data('default')
        // var qty = $(this).val()
        // harga = harga * (qty / min_qty);
        // $('#harga').html("IDR " + harga)
        var harga = $('#harga').val()
        var qty = $(this).val()

        console.log('qty >>> ', qty)

        if (qty >= 100 && qty < 200) {
            $('#harga_sablon_logo').val(0)
            $('#display_harga').html(formatRupiah($('#harga').val(), 'IDR '))
            total = $('#harga').val() * qty;
            $('#biaya_sablon').html('')
        } else if (qty >= 200 && qty < 300) {
            $('#harga_sablon_logo').val(0)
            $('#harga').val(default_harga - 500)
            $('#display_harga').html(formatRupiah($('#harga').val(), 'IDR '))
            total = $('#harga').val() * qty;
            $('#biaya_sablon').html('')
        } else if (qty >= 300 && qty < 400) {
            $('#harga_sablon_logo').val(0)
            $('#harga').val(default_harga - 650)
            $('#display_harga').html(formatRupiah($('#harga').val(), 'IDR '))
            total = $('#harga').val() * qty;
            $('#biaya_sablon').html('')
        } else if (qty >= 400 && qty < 500) {
            $('#harga_sablon_logo').val(0)
            $('#harga').val(default_harga - 750)
            $('#display_harga').html(formatRupiah($('#harga').val(), 'IDR '))
            total = $('#harga').val() * qty;
            $('#biaya_sablon').html('')
        } else if (qty >= 500) {
            $('#harga_sablon_logo').val(0)
            $('#harga').val(default_harga - 800)
            $('#display_harga').html(formatRupiah($('#harga').val(), 'IDR '))
            total = $('#harga').val() * qty;
            $('#biaya_sablon').html('')
        } else {
            $('#harga').val(default_harga)
            $('#harga_sablon_logo').val(50000)
            $('#display_harga').html(formatRupiah($('#harga').val(), 'IDR '))
            total = $('#harga').val() * qty;
            $('#biaya_sablon').append(`<h6>Biaya sablon IDR 50.000</h6><br>`)
            total = total + 50000
        }

        $('#display_total').html(formatRupiah(total, 'IDR '))
    });

    $('#ukuran_sablon').change(function() {
        if ($(this).val() == 'besar') {
            total = total + 100000
        } else {
            total = total - 100000
        }
        $('#display_total').html(formatRupiah(total, 'IDR '))
    })

    function formatRupiah(angka, prefix) {
        var
            number_string = angka.toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'IDR ' + rupiah : '');
    }
</script>
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
            <div class="col mt-5">
                <!-- Action e yo wes tak ganti karo iki -->
                <form action="<?= base_url('product/addcartsablon/sablon') ?>" method="post">
                    <!-- <form action="" method="post"> -->
                    <h4><?= $p->nama; ?> <?= $p->model_produk; ?></h4>
                    <h4><?= $p->ukuran; ?></h4>
                    <p id="display_harga">IDR <?= number_format($p->harga, 0, '', '.') ?></p>
                    <input type="hidden" id="harga" name="harga" value="<?= $p->harga ?>">
                    <input type="hidden" id="harga_sablon_logo" name="harga_sablon_logo" value="50000">
                    <br>
                    <p style="font-weight: bold; margin-bottom: 10px; font-size: 14pt;">QTY</p>
                    <div class="form-group">
                        <div class="form-group col-md-4 p-0">
                            <select class="form-control" id="jumlah" name="jumlah">
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
                    <input type="hidden" name="id" value="<?= $p->id ?>">
                    <!-- 2. Iki -->
                    <button class="btn btn-primary p-2" style="font-size: 12pt"><i class="fas fa-cart-plus " style="font-size: 12pt;"></i> ORDER NOW !</button>
                    <!-- 1. Seng iki gak usah wes tak ganti karo -->
                    <!-- <?php echo anchor(base_url('product/tambah_keranjang/' . $p->id), '<button type="button" class="btn btn-primary p-2" style="font-size: 12pt;"><i class="fas fa-cart-plus " style="font-size: 12pt;"></i> ORDER NOW !</button>'); ?> -->
                </form>
            </div>
        </div>
    <?php endforeach; ?>
    <script>
        // var min_qty = $('#jumlah').val()
        var default_harga = $('#harga').val()

        $('#jumlah').change(function() {
            // var harga = $('#harga').data('default')
            // var qty = $(this).val()
            // harga = harga * (qty / min_qty);
            // $('#harga').html("IDR " + harga)
            var harga = $('#harga').val()
            var qty = $(this).val()

            if (qty >= 100 && qty < 200) {
                $('#harga_sablon_logo').val(0)
                $('#display_harga').html(formatRupiah($('#harga').val(), 'IDR '))
            } else if (qty >= 200 && qty < 300) {
                $('#harga_sablon_logo').val(0)
                $('#harga').val(default_harga - 500)
                $('#display_harga').html(formatRupiah($('#harga').val(), 'IDR '))
            } else if (qty >= 300 && qty < 400) {
                $('#harga_sablon_logo').val(0)
                $('#harga').val(default_harga - 650)
                $('#display_harga').html(formatRupiah($('#harga').val(), 'IDR '))
            } else if (qty >= 400 && qty < 500) {
                $('#harga_sablon_logo').val(0)
                $('#harga').val(default_harga - 750)
                $('#display_harga').html(formatRupiah($('#harga').val(), 'IDR '))
            } else if (qty >= 500) {
                $('#harga_sablon_logo').val(0)
                $('#harga').val(default_harga - 800)
                $('#display_harga').html(formatRupiah($('#harga').val(), 'IDR '))
            } else {
                $('#harga').val(default_harga)
                $('#harga_sablon_logo').val(50000)
                $('#display_harga').html(formatRupiah($('#harga').val(), 'IDR '))
            }
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
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
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<div class="container">

    <!-- <a class="btn btn-primary mb-2 float-right" href="<?= base_url('admin/pembayaran') ?>">Lihat pembayaran</a> -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Order Id</th>
                <th scope="col">Produk Id</th>
                <th scope="col">Model Produk</th>
                <th scope="col">Type</th>
                <th scope="col">Ukuran sablon</th>
                <th scope="col">Price</th>
                <th scope="col" class="text-center">Pcs</th>
                <th scope="col" class="text-center">Design logo</th>
                <th scope="col" class="text-center">Warna</th>
                <th scope="col" class="text-center">Area sablon</th>
                <th scope="col" class="text-center">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($all_orderdetail as $p) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $p->order_id; ?></td>
                    <td><?= $p->produk_id; ?></td>
                    <td><?= $p->model_produk; ?></td>
                    <td><?= $p->type; ?></td>
                    <td><?= $p->ukuran_sablon; ?></td>
                    <td><?= $p->price; ?></td>
                    <td><?= $p->pcs; ?></td>
                    <td>
                        <p class="text-center" style="font-size: 24px;"><a href="<?= base_url('admin/download/') . $p->designlogo  ?>"><i class="fas fa-download"></i></a></p>
                        <!-- <?= $p->designlogo; ?> -->
                    </td>
                    <td><?= $p->warna; ?></td>
                    <td><?= $p->area_sablon; ?></td>
                    <td><?= $p->subtotal; ?></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
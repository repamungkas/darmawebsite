<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<div class="container">

    <a class="btn btn-primary mb-2 float-right" href="<?= base_url('admin/pembayaran') ?>">Lihat pembayaran</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Customer Id</th>
                <th scope="col">Shipping Address</th>
                <th scope="col">Order Date</th>
                <th scope="col">Order Amount</th>
                <th scope="col">Order Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($query as $p) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $p->customer_id; ?></td>
                    <td><?= $p->shipping_address; ?></td>
                    <td><?= $p->order_date; ?></td>
                    <td><?= $p->order_amount; ?></td>
                    <td>
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                            foreach ($status_pemesanan as $s) :
                                if ($s->id == $p->order_status) {
                                    echo $s->status_ket;
                                }
                            ?>
                            <?php endforeach; ?>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <?php foreach ($status_pemesanan as $sp) : ?>
                                <a class="dropdown-item" href="<?= base_url('admin/edit_status_pemesanan/' . $sp->id . '/' . $p->id) ?>">
                                    <?= $sp->status_ket; ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </td>
                    <td>
                        <!-- <a href="#" class="edit" data-toggle="modal" data-target="#edituserModal"><i class="material-icons">&#xE254;</i></a> -->
                        <a href="#" class="delete" data-toggle="modal" data-target="#deleteModal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
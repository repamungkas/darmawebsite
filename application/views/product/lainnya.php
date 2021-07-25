<div class="container" style="margin-top: 100px;">
    <h4 class="text-center">Box Karton</h4>
    <div class="row justify-content-sm-center">
        <div class="col-sm-1 pl-0 pr-0 text-center">
            <p style="font-size: 12pt;">
                <a href="<?= base_url('product/pizza'); ?>" style="color: black;">Box Pizza</a>
            </p>
        </div>
        <div class="col-sm-1 pl-0 pr-0 text-center">
            <p style="font-size: 12pt;">
                <a href="<?= base_url('product/sepatu'); ?>" style="color: black;">Box Sepatu</a>
            </p>
        </div>
        <div class="col-sm-1 pl-0 pr-0 text-center">
            <p style="font-size: 12pt;">
                <a href="<?= base_url('product/tenteng'); ?>" style="color: black;">Box Tenteng</a>
            </p>
        </div>
        <div class="col-sm-1 pl-0 pr-0 text-center">
            <p style="font-size: 12pt;">
                <a href="<?= base_url('product/lainnya'); ?>" style="color: black;">Box Lainnya</a>
            </p>
        </div>
    </div>
</div>

<div class="row" style="margin: 25px 100px;">
    <?php foreach ($query as $p) : ?>
        <div class="col-sm-3" style="margin-bottom: 50px;">
            <div class="card" style="width: 20rem;">
                <img src="<?= base_url('assets') ?>/img/produk/<?= $p->gambar; ?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?= $p->nama; ?> <?= $p->model_produk; ?></h5>
                    <h5 class="card-title"><?= $p->ukuran; ?></h5>
                    <p class="card-text">Mulai dari IDR <?= $p->harga; ?></p>
                    <a href="#" class="btn btn-primary">Detail</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
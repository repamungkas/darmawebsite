<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

<div class="container">
    <div class="table-responsive">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-4">
                    <h2>Manage Product</h2>
                </div>
                <div class="col-sm-4 mx-sm-auto">
                    <?= $this->session->flashdata('message'); ?>
                </div>
                <div class="col-sm-4">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success btn-sm my-sm-1 float-right" data-toggle="modal" data-target="#addproduct">
                        Add product
                        <i class="fas fa-user-plus pl-2"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addproduct">Add new product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="<?= base_url('admin/insert_product') ?>" class="needs-validation" novalidate>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="text" class="form-control" id="nama_produk" name="nama_produk" aria-describedby="" required>
                                            <div class="invalid-feedback">
                                                Please provide name !
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Model</label>
                                            <input type="text" class="form-control" id="model_produk" name="model_produk" aria-describedby="" required>
                                            <div class="invalid-feedback">
                                                Please provide model !
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Size</label>
                                            <input type="text" class="form-control" id="ukuran" name="ukuran" aria-describedby="" required>
                                            <div class="invalid-feedback">
                                                Please provide size !
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Price</label>
                                            <input type="text" class="form-control" id="harga" name="harga" aria-describedby="" required>
                                            <div class="invalid-feedback">
                                                Please provide price !
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Stok</label>
                                            <input type="text" class="form-control" id="stok" name="stok" aria-describedby="" required>
                                            <div class="invalid-feedback">
                                                Please provide stok !
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary ">Insert</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Model</th>
                    <th scope="col">Image</th>
                    <th scope="col">Size</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($query as $p) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $p->nama; ?></td>
                        <td><?= $p->model_produk; ?></td>
                        <td>
                            <img style="width: 50px;" src="<?= base_url('assets/img/produk/' . $p->gambar) ?>" alt="<?= $p->gambar; ?>" srcset="">
                            <!-- <?= $p->gambar; ?> -->
                        </td>
                        <td><?= $p->ukuran; ?></td>
                        <td><?= $p->harga; ?></td>
                        <td><?= $p->sku; ?></td>
                        <td>
                            <a href="#" class="edit" data-toggle="modal" data-target="#edituserModal"><i class="material-icons">&#xE254;</i></a>
                            <a href="#" class="delete" data-toggle="modal" data-target="#deleteModal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
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
    <!-- <?php echo $user['role_id']; ?> -->
    <?php echo json_encode($user); ?>
    <div class="table-responsive">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-4">
                    <h2>Manage Users</h2>
                </div>
                <div class="col-sm-4 mx-sm-auto">
                    <?= $this->session->flashdata('message'); ?>
                </div>
                <div class="col-sm-4">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success btn-sm my-sm-1 float-right" data-toggle="modal" data-target="#adduserModal">
                        Create user
                        <i class="fas fa-user-plus pl-2"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="adduserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="adduserModal">Create new user</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="<?= base_url('admin/createuser') ?>" class="needs-validation" novalidate>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" aria-describedby="" placeholder="Enter fullname" required>
                                            <div class="invalid-feedback">
                                                Please provide name !
                                            </div>
                                            <?= form_error('name', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" aria-describedby="" placeholder="Enter address" required>
                                            <div class="invalid-feedback">
                                                Please provide address !
                                            </div>
                                            <?= form_error('address', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" aria-describedby="" placeholder="user@gmai.com" required>
                                            <div class="invalid-feedback">
                                                Please provide valid email !
                                            </div>
                                            <?= form_error('email', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">No. Handphone</label>
                                            <input type="text" class="form-control" id="nohandphone" name="nohandphone" aria-describedby="" placeholder="Enter no. handphone" required>
                                            <div class="invalid-feedback">
                                                Please provide no handphone !
                                            </div>
                                            <?= form_error('nohandphone', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Role</label>
                                            <div class="form-group">
                                                <select class="form-control" id="role_id" name="role_id">
                                                    <option value="1">Admin</option>
                                                    <option value="2">User</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" class="form-control" id="password1" name="password1" placeholder="Password" required>
                                            <div class="invalid-feedback">
                                                Please enter a password !
                                            </div>
                                            <?= form_error('password1', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Repeat password</label>
                                            <input type="password" class="form-control" id="password2" name="password2" placeholder="" required>
                                            <div class="invalid-feedback">
                                                Password do not match !
                                            </div>
                                            <?= form_error('password2', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>

                                        <button type="submit" class="btn btn-primary ">Create</button>
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
                    <th scope="col">Date Created</th>
                    <th scope="col">Address</th>
                    <th scope="col">Email</th>
                    <th scope="col">No Handphone</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($query as $u) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $u->name; ?></td>
                        <td><?= date('d F Y', $u->date_created) ?></td>
                        <td><?= $u->address; ?></td>
                        <td><?= $u->email; ?></td>
                        <td><?= $u->nohandphone; ?></td>
                        <td>
                            <?php
                            if ($u->role_id == 1) {
                                echo 'Super Admin';
                            } else if ($u->role_id == 2) {
                                echo 'Admin';
                            } else {
                                echo 'Member';
                            }
                            ?>
                        </td>
                        <td>
                            <a href="#" class="edit" data-toggle="modal" data-target="#edituserModal" id_user="<?= $u->id ?>"><i class="material-icons">&#xE254;</i></a>
                            <?php
                            if ($u->role_id > 2) { ?>
                                <a href="#" class="delete" data-toggle="modal" id_user="<?= $u->id ?>" data-target="#deleteModal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>

            </tbody>
        </table>

        <!-- Modal delete -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModal">Are you sure delete user <?= $u->name  ?></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="<?= base_url('admin/deleteuser') ?>" method="post">
                        <input type="hidden" id="id_user" name="id_user">
                        <div class="modal-body">Select "Delete" below if you sure to delete this user.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal edit user -->

<div class="modal fade" id="edituserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edituserModal">Edit user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" method="post" action="<?= base_url('admin/doedit') ?>" novalidate>
                    <input type="hidden" name="id_usr" id="id_usr" value="">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="edit_name" value="" aria-describedby="" placeholder="Enter fullname" required>
                        <div class="invalid-feedback">
                            Please provide name !
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Address</label>
                        <input type="text" class="form-control" id="edit_address" value="" name="edit_address" aria-describedby="" placeholder="Enter address" required>
                        <div class="invalid-feedback">
                            Please provide address !
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" id="edit_email" value="" name="edit_email" aria-describedby="" placeholder="user@gmai.com" required>
                        <div class="invalid-feedback">
                            Please provide valid email !
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">No. Handphone</label>
                        <input type="text" class="form-control" id="edit_nohandphone" value="" name="edit_nohandphone" aria-describedby="" placeholder="Enter no. handphone" required>
                        <div class="invalid-feedback">
                            Please provide no handphone !
                        </div>
                    </div>
                    <?php if ($user['role_id'] == 1) { ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Role</label>
                            <div class="form-group">
                                <select class="form-control" id="edit_role_id" name="edit_role_id">
                                    <option value="2">Administrator</option>
                                    <option value="3">User</option>
                                </select>
                            </div>
                        </div>
                    <?php } else {
                    } ?>
                    <button type="submit" id="save_button" class="btn btn-primary ">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- <?php $this->load->view('templates/include_js.php'); ?> -->

<script type="text/javascript">
    // console.log('beads');

    $(".edit").off().on('click', function() {
        $("#id_usr").val($(this).attr('id_user'));
    })

    $('#edituserModal').on('shown.bs.modal', function() {
        $.ajax({
            url: '<?= base_url('admin/edituser/') ?>' + $("#id_usr").val(),
            type: 'get',
            success: function(result) {
                var obj = jQuery.parseJSON(result);
                console.log(obj[0].name);
                $("#edit_name").val(obj[0].name)
                $("#edit_address").val(obj[0].address)
                $("#edit_email").val(obj[0].email)
                $("#edit_nohandphone").val(obj[0].nohandphone)
                $("#edit_role_id").val(obj[0].role_id)
            }
        })
    })

    $(".delete").off().on('click', function() {
        console.log($(this).attr('id_user'));
        $('#id_user').val($(this).attr('id_user'));
    })

    // $('#save_button').on('click', function() {
    //     $.ajax({
    //         url: '<?= base_url('admin/doedit/') ?>',
    //         type: 'post',
    //         data: {
    //             name: $('#edit_name').val(),
    //             address: $('#edit_address').val(),
    //             email: $('#edit_email').val(),
    //             nohandphone: $('#edit_nohandphone').val(),
    //             role_id: $('#edit_role_id').val(),
    //         },
    //         success: function(result) {
    //             console.log(result);
    //         }
    //     })
    // })
</script>
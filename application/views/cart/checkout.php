<div class="container" style="margin-top: 150px;">
    <div class="row">
        <div class="col">
            <h3>Shopping information</h3>
            <br>
            <?php if (count($user) > 0) { ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="hidden" id="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Alamat</label>
                    <input type="hidden" id="alamat" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="hidden" id="email" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">No Handphone</label>
                    <input type="hidden" id="no_hp" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>


                <input type="hidden" id="nama" value="<?= $user['name'] ?>">
                <input type="hidden" id="alamat" value="<?= $user['address'] ?>">
                <input type="hidden" id="email" value="<?= $user['email'] ?>">
                <input type="hidden" id="no_hp" value="<?= $user['nohandphone'] ?>">
            <?php } else { ?>
                <form class="mb-5">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="nama">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Alamat</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="alamat">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">No Handphone</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="no handphone">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            <?php } ?>
        </div>
        <div class="col">
            <h3 class="float-sm-right">Shopping Cart</h3>
            <br>
            <table class="table table-borderless right" style="padding-left: 20px;">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Price</th>
                </tr>
            </table>
        </div>
    </div>
</div>
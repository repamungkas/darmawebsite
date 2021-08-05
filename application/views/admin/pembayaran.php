<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>


<!-- <?php echo json_encode($querypayment) ?> -->
<div class="container">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Bank Account</th>
        <th scope="col">Order ID</th>
        <th scope="col">Status DP</th>
        <th scope="col">Status Pelunasan</th>
        <th scope="col">Grand Total</th>
        <th scope="col">Shipping Cost</th>
        <th scope="col">DP Bill</th>
        <th scope="col">Final Bill</th>
        <th scope="col">Resi DP</th>
        <th scope="col">Resi Pelunasan</th>
        <?php if ($order_status >= 4) { ?>
          <th scope="col">Update Shipping Cost</th>
        <?php } ?>

      </tr>
    </thead>
    <tbody>
      <?php foreach ($querypayment as $q) { ?>
        <tr>
          <td><?= $q->bank_account ?></td>
          <td><?= $q->order_id ?></td>
          <td><?= $q->status_dp ?></td>
          <td><?= $q->status_pelunasan ?></td>
          <td><?= $q->grand_total ?></td>
          <td><?= $q->shipping_cost ?></td>
          <td><?= $q->dp_bill ?></td>
          <td><?= $q->final_bill ?></td>
          <td><img style="width: 200px;" src="<?= base_url('assets/img/resi_dp/' . $q->resi_dp) ?>" alt=""></td>
          <td><img style="width: 200px;" src="<?= base_url('assets/img/resi_pelunasan/' . $q->resi_pelunasan) ?>" alt=""></td>
          <!-- <td><?= $q->resi_pelunasan ?></td> -->
          <?php if ($order_status >= 4) { ?>
            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="far fa-edit"></i></button></td>
          <?php } ?>
        </tr>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="<?= base_url('admin/updateshipping/' . $q->order_id) ?>" method="post">
                  <div class="row pr-2">
                    <div class="col-8">
                      <p>TGrand Total</p>
                    </div>
                    <div class="col-4 text-right">
                      <p><?= $q->grand_total ?></p>
                    </div>
                  </div>
                  <div class="row pr-2">
                    <div class="col-8">
                      <p>DP</p>
                    </div>
                    <div class="col-4 text-right">
                      <p><?= $q->dp_bill ?></p>
                    </div>
                  </div>
                  <div class="row pr-2">
                    <div class="col-4">
                      <p>Shipping Cost</p>
                    </div>
                    <div class="col-8 text-right">
                      <input type="number" class="form-control" placeholder="Enter Shipping Cost" name="shippingcost" id="shippingcost" value="<?= $q->shipping_cost ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="row">
                      <div class="col">
                        <hr>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        <?php } ?>
    </tbody>
  </table>
</div>

<script>
</script>
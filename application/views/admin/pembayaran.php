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
                    <td><img style="width: 200px;" src="<?= base_url('assets/img/resipayment/' . $q->resi_dp) ?>" alt=""></td>
                    <td><?= $q->resi_pelunasan ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
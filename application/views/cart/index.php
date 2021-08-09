<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type='text/javascript'
    src="http://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxtransport-xdomainrequest/1.0.1/jquery.xdomainrequest.min.js">
  </script>
</head>

<body>

  <div class="container" style="margin-top: 150px;">
    <h3 style="text-align: center; font-weight: bold;">Cart</h3>
    <!-- <?php echo json_encode($this->session->userdata('product_type')) ?> -->
    <!-- <?= json_encode($this->cart->contents()); ?> -->
    <!-- <?= json_encode($province); ?> -->
    <div class="row pt-4">
      <div class="col-7"
        style="padding-right: 0px; padding-left: 0px; border: 2px solid black; border-radius: 20px; height: fit-content;">
        <h5 class="pl-3 pt-3">Shipping address</h5>
        <hr style="border: 1px solid black;">

        <div>
          <label>Kurir: </label>
          <select id="kurir">
            <option value="jne">JNE</option>
            <option value="tiki">TIKI</option>
            <option value="pos">POS</option>
          </select>
        </div>

        <?php
            if (count($user) > 0) {
                echo "Alamat: ";
                echo "<p class='ml-2'>" . $user['address'] . "</p>";
            ?>
        <?php } else { ?>
        <p class="pl-3 pt-2">No shipping address has been yet</p>
        <!-- <a href="" class="pl-3 pt-2" style="font-weight: bold;">Add address</a> -->
        <?php } ?>

        <!-- onchange="location = this.value;" -->

        <div>
          <label>Provinsi: </label>
          <select id="provinsi">
            <option value=""> </option>
            <?php foreach ($province as $p) { ?>
            <option value="<?= $p['province_id'] ?>">
              <?= $p['province'] ?>
            </option>
            <?php } ?>
          </select>
        </div>

        <div id="kota">
        </div>

        <div id="paket">
        </div>

        <div id="ongkir">
        </div>

        <!-- <a href="<?= base_url() ?>cart/clear_cart" class="btn btn-danger pt-2 pb-2" style="float: right;"><i class="far fa-trash-alt" style="font-size: 16pt;"></i></a> -->
      </div>
      <?php $i = 1; ?>
      <?php $itemcontent = $this->cart->contents(); ?>
      <div class="col-4" style=" margin-left: 50px; border: 2px solid black; border-radius: 20px;">
        <h5 class="pl-2 pt-3" style="font-weight: bold;">Summary</h5>
        <br>
        <div class="row pr-2">
          <div class="col-8">
            <p>Total</p>
          </div>
          <div class="col-4 text-right">
            <?php
                    $total = 0;
                    foreach ($this->cart->contents() as $items) {
                        $subtotal = $items['price'] * $items['qty'];
                        $total = $total + $subtotal;
                        if ($items['options']['type'] == 'sablon' && $items['qty'] == 50) {
                            $total = $total + 50000;
                        }
                        if ($items['options']['ukuran_sablon'] == 'besar') {
                            $total = $total + 100000;
                        }
                    }
                    $this->session->set_userdata('grand_total', $total);
                    ?>
            <p><?= 'IDR ' . number_format($total, 0, '', '.') ?></p>
          </div>
        </div>
        <div class="row pr-2">
          <div class="col-8">
            <p>DP 50%</p>
          </div>
          <div class="col-4 text-right">
            <?php
                    $dp = 0;
                    $dp = $total / 2;
                    $this->session->set_userdata('dp_total', $dp);
                    ?>
            <p><?= 'IDR ' . number_format($dp, 0, '', '.') ?></p>
          </div>
        </div>
        <!-- <div class="row">
                <div class="col-8">
                    <p>Total shipping Costs</p>
                </div>
                <div class="col-4">
                    <p>IDR. 0</p>
                </div>
            </div> -->
        <div class="row">
          <div class="col">
            <hr>
          </div>
        </div>
        <div class="row pr-2">
          <div class="col-8">
            <p style="font-weight: bold;">Total DP</p>
          </div>
          <div class="col-4">
            <?php if ($dp > 0) { ?>
            <p><?= 'IDR ' . number_format($dp, 0, '', '.') ?></p>
            <?php } else { ?>
            <p><?= 'IDR ' . number_format($total, 0, '', '.') ?></p>
            <?php } ?>
          </div>
        </div>
        <?php if ($this->session->has_userdata('email')) { ?>
        <a href="<?= base_url('payment') ?>" class="btn btn-primary rounded-pill checkout" style="display: block;">DP
          Payment</a>
        <?php } else { ?>
        <a href="<?= base_url('auth') ?>" class="btn btn-primary rounded-pill checkout" style="display: block;">Login
          untuk order</a>
        <?php } ?>
      </div>
      <div class="col-7"
        style="padding-right: 0px; padding-left: 0px; border: 2px solid black; border-radius: 20px; margin-top: -100px;">
        <h5 class="pl-3 pt-3">Detail Product</h5>
        <hr style="border-width: 2px; border-color: black;">
        <div class="row">
          <?php foreach ($this->cart->contents() as $items) : ?>
          <div class="col-3 ml-4 text-center px-1 py-1 mb-3" style="border: 1px solid black; border-radius: 20px;">
            <img class="rounded my-2" src="<?= base_url() ?>/assets/img/produk/<?= $items['options']['gambar'] ?>"
              style="width: 150px;" alt="">
          </div>
          <div class="col-5">
            <p><?= $items['name'] . ' ' . $items['options']['type'] ?></p>
            <p><?= $items['options']['ukuran'] ?></p>
            <p><?= $items['qty'] . ' pcs' ?></p>
          </div>
          <div class="col-3 text-right">
            <a href="<?= base_url('cart/clear_cart/' . $items['rowid']) ?>"><i class="far fa-trash-alt"></i></a>
            <?php
                        $total = ($items['price'] * $items['qty']);
                        if ($items['options']['type'] == 'sablon' && $items['qty'] == 50) {
                            $total = $total + 50000;
                        }
                        if ($items['options']['ukuran_sablon'] == 'besar') {
                            $total = $total + 100000;
                        }
                        ?>
            <p class="mt-3"><?= 'IDR ' . number_format($total, 0, '', '.') ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>

  <script>
  $('.checkout').click(function() {
    var nama = $('#nama').val()
    var email = $('#email').val()
    var alamat = $('#alamat').val()
    var no_hp = $('#no_hp').val()
    var output = 'Nama %3A ' + nama + ' %0A' +
      'Email %3A ' + email + ' %0A' +
      'No hp %3A ' + no_hp + ' %0A' +
      'Alamat %3A ' + alamat + ' %0A%0A' +
      '<?php $output ?>'
    location.href = 'https://wa.me/+6282257537871?text=' + output
  })

  $('#provinsi').change(function(e) {
    const province_id = e.target.value

    $('#kota').html('');

    if (province_id) {
      $.ajax({
        url: `<?php echo base_url(); ?>/cart/shipping_get_city/${province_id}`, //the page containing php script
        type: "get", //request type,
        dataType: 'json',
        success: function(result) {
          const cities = result.rajaongkir.results;
          if (cities.length >= 1) {
            let html = '<option value=""> </option>'
            cities.forEach((city, idx) => {
              const htmlWithValue = `<option value="${city.city_id}">
                  ${city.city_name}
                  </option>`
              html += htmlWithValue
            })
            $('#kota').html(`
              <label>Kota: </label>
              <select id="provinsi">
              ${html}
              </select>
            `);
          }
        }
      });
    }
    $('#paket').html('');
    $('#ongkir').html('');
  });

  $('#kota').change(function(e) {
    const courier = $('#kurir').val()
    const origin = '255'
    const destination = e.target.value
    const weight = '700'

    $('#paket').html('');

    if (destination) {
      $.ajax({
        url: `<?php echo base_url(); ?>/cart/shipping_get_cost/${origin}/${destination}/${courier}/${weight}`, //the page containing php script
        type: "get", //request type,
        dataType: 'json',
        success: function(result) {
          const costs = result.rajaongkir.results;
          if (costs.length >= 1) {
            let html = '<option value=""> </option>'
            costs.forEach((item, idx) => {
              item.costs.forEach((option, idx) => {
                const htmlWithValue = `<option value="${option.cost[0].value}">
                    ${option.service}
                    </option>`
                html += htmlWithValue
              })
            })
            $('#paket').html(`
              <label>Paket: </label>
              <select id="paket">
              ${html}
              </select>
            `);
          }
        }
      });
    }
    $('#paket').html('');
    $('#ongkir').html('');
  });

  $('#paket').change(function(e) {
    const shippingCost = e.target.value

    $('#ongkir').html(`<p>Ongkos kirim: ${shippingCost}</p>`);
  });


  // $.getJSON('http://localhost/dev/')

  // shipping_get_city
  //   console.log('change province')
  //   $.ajax({
  //     type: "GET",
  //     url: 'https://api.rajaongkir.com/starter/city',
  //     // qs: {
  //     //   id: '39',
  //     //   province: '5'
  //     // },
  //     headers: {
  //       'key': '58a4e641443959d6488c2b5eed119bdc',
  //       'Access-Control-Allow-Origin': '*'
  //     },
  //     success: function(data) {
  //       console.log('data get city >>> ', data)
  //     },
  //     error: function() {
  //       alert('There was some error performing the AJAX call!');
  //     }
  //   })
  // });

  // $('#provinsi').change(function() {
  //   const settings = {
  //     cache: false,
  //     dataType: "jsonp",
  //     async: true,
  //     crossDomain: true,
  //     url: "https://api.rajaongkir.com/starter/city",
  //     method: "GET",
  //     headers: {
  //       "key": "58a4e641443959d6488c2b5eed119bdc",
  //       "accept": "application/json",
  //       "Access-Control-Allow-Origin": "*"
  //     }
  //   }

  //   $.ajax(settings).done(function(response) {
  //     console.log('response >>> ', response);
  //   });
  // });
  </script>
</body>

</html>

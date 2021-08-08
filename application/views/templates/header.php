<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $title; ?></title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <link href="<?= base_url('assets'); ?>/css/style1.css" rel="stylesheet">
  <!-- Favicons -->
  <link href="<?= base_url(); ?>assets/img/favicon.png" rel="icon">
  <link href="<?= base_url(); ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="<?= base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendor/aos/aos.css" rel="stylesheet">


  <!-- Template Main CSS File -->

  <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <!-- Bootstrap core CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">



</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header-transparent">
    <div class="container">

      <div id="logo" class="pull-left">
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt=""></a> -->
        <!-- Uncomment below if you prefer to use a text logo -->
        <h1><a href="<?= base_url(); ?>">Darmabox</a></h1>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="<?php if ($this->uri->segment(1) == "") {
                        echo "menu-active";
                      } ?>"><a style="font-weight: bold;" href="<?= base_url(); ?>">Home</a></li>
          <li><a style="font-weight: bold;" href="<?= base_url('product') ?>">Shop</a></li>
          <li><a style="font-weight: bold;" href=" <?= base_url('cart') ?> ">Cart <sup><?php $keranjang = count($this->cart->contents()); ?> <?php echo $keranjang ?></sup> </a></li>
          <li class="
            <?php
            if ($this->uri->segment(1) == "auth") {
              echo "menu-active";
            }
            ?>">
            <?php
            if ($user != null) {
            ?>
          <li class="menu-has-children"><a href="<?= base_url('home'); ?>"><?= $user['name'] ?></a>
            <ul>
              <!-- <li><a href="#">Order History</a></li> -->
              <!-- <li><a href="<?= base_url('payment/confirmation') ?>">Payment Confirmation</a></li> -->
              <li><a href="<?= base_url('track') ?>">Track Order</a></li>
              <li><a href="<?= base_url('auth/logout'); ?>">Logout</a></li>
            </ul>
          </li>
        <?php
            } else {
              echo "<a style='font-weight: bold;' href=" . base_url('auth') . ">Login</a>";
            }
        ?>
        </li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- End Header -->
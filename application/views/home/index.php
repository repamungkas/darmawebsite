      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="<?= base_url(); ?>assets/img/imgslide1.jpg" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100 slide" src="<?= base_url() ?>assets/img/headerr1.jpg" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="<?= base_url() ?>assets/img/slide3.jpg" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>


      <div class="row">
        <div class="col pl-0 pr-0">
          <div class="view overlay">
            <a href="<?= base_url('product/pizza') ?>">
              <img src="<?= base_url() ?>assets/img/produk/pizza.jpg" alt="" class="w-100">
              <div class="mask w-100 flex-center rgba-grey-strong">
                <h5 class="white-text">BOX PIZZA</h5>
              </div>
            </a>
          </div>
        </div>
        <div class="col pl-0 pr-0">
          <div class="view overlay">
            <a href="<?= base_url('product/sepatu') ?>">
              <img src="<?= base_url() ?>assets/img/produk/sepatu.jpg" alt="" class="w-100">
              <div class="mask w-100 flex-center rgba-grey-strong">
                <p class="white-text">BOX SEPATU</p>
              </div>
            </a>
          </div>
        </div>
        <div class="col pl-0 pr-0">
          <div class="view overlay">
            <a href="<?= base_url('product/tenteng') ?>">
              <img src="<?= base_url() ?>assets/img/produk/tenteng.jpg" alt="" class="w-100">
              <div class="mask w-100 flex-center rgba-grey-strong">
                <p class="white-text">BOX TENTENG</p>
              </div>
            </a>
          </div>
        </div>
      </div>



      <div class="d-flex align-items-center justify-content-center mt-3 mb-3">
        <!-- <hr class="w-25 horizontal-line"> -->
        <div style="height:1.5px;background-color:#666666" class="pr-3 w-25"></div>
        <p class="mb-0 mr-3 ml-3">CUSTOM BOX</p>
        <div style="height:1.5px;background-color:#666666" class="pl-3 w-25"></div>
        <!-- <hr class="w-25"> -->
      </div>


      <div class="row mt-4 mb-5">
        <div class="col-xl pr-0 pl-0">
          <img src="<?= base_url('assets/img/custom.jpg') ?>" class="w-100" alt="">
        </div>
        <div class="col-xl pr-0 pl-0">
          <img src="<?= base_url('assets/img/custom2.jpg') ?>" class="w-100" alt="">
        </div>
      </div>

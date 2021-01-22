  <!-- Header area -->
  <header class="overflow-hidden mb-lg-5 mb-md-5">
    <!-- banner area -->
    <div class="banner-cover overflow-hidden d-flex align-items-center justify-content-center">
      <img src="<?= BASEURL;?>/img/users/banner/<?= $data["user"]["banner"];?>" class="banner" alt="">
    </div>
    <!-- profile info areae -->
    <div class="container d-flex justify-content-between">
      <!-- profile -->
      <div class="profile d-flex flex-column flex-lg-row flex-md-row mx-auto mx-md-0 mx-lg-0">
        <div class="d-flex justify-content-center">
          <img src="<?= BASEURL;?>/img/users/profile/<?= $data["user"]["profile"];?>" class="rounded-circle photo-profile" alt="">
        </div>
        <div class="ml-0 ml-lg-4 ml-md-4 my-auto text-center text-md-left text-lg-left">
          <h2 class="font-weight-bold"><?= $data["user"]["name"];?></h2>
          <p><?= $data["user"]["email"];?></p>
        </div>
      </div>
    </div>
  </header>

  <!-- Main contents -->
  <main>
    <!-- view -->
     <div class="view-full mb-5 fixed-top vw-100 vh-100 d-none flex-column justify-content-center align-items-center">
      <!-- image full view -->
      <div class="main-full">
        <img src="" class="status-img rounded mb-3"   alt="">
      </div>
    </div>
    <!-- container -->
    <div class="container d-flex flex-column flex-lg-row flex-md-row justify-content-center">
      <!-- Aside areas -->
      <div class="aside col-md-3 col-lg-3 col-12 d-flex flex-column h-50">
        <!-- Setting area -->
        <div class="p-3 mb-4 rounded order-2">
          <p class="text-dark mb-5">You are visiting <strong><?= $data["user"]["name"];?></strong></p>
          <a href="<?= BASEURL;?>/Home" class="aside-element  badge p-3 mt-2 rounded-pill d-flex align-items-center text-dark text-center">
            <i class="fas fa-sign-out-alt"></i>
            <p class="my-auto ml-3">Home</p>
          </a href="#">
        </div>
      </div>

      <!-- Main content -->
      <div class="col-md-6 col-lg-6 mx-0 mx-md-2 mx-lg-2 col-12 order-3 order-md-2 order-lg-2">
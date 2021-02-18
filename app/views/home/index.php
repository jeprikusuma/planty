  <!-- Header area -->
  <header class="overflow-hidden mb-lg-5 mb-md-5 header d-none d-md-block d-lg-block">
    <!-- banner area -->
    <audio id="notif" src="<?= BASEURL;?>/sound/notif.mp3"></audio>
    <div class="banner-cover overflow-hidden d-flex align-items-center justify-content-center">
      <img src="<?= BASEURL;?>/img/users/banner/<?= $data["user"]["banner"];?>" class="banner" alt="">
    </div>
    <!-- profile info areae -->
    <div class="container d-flex justify-content-between">
      <!-- profile -->
      <div class="profile d-flex flex-column flex-lg-row flex-md-row mx-auto mx-md-0 mx-lg-0">
        <div class="d-flex justify-content-center posititon-relative">
          <div class="rounded-circle photo-profile bg-dark position-absolute justify-content-center align-items-center d-none" style="z-index: 999;">
          <i class="fas fa-redo text-white" style="font-size: 2.5rem"></i>
          </div>
          <img src="<?= BASEURL;?>/img/users/profile/<?= $data["user"]["profile"];?>" class="rounded-circle photo-profile animate__animated animate__fadeIn animate" alt="">
        </div>
        <div class="ml-0 ml-lg-4 ml-md-4 my-auto text-center text-md-left text-lg-left animate__animated animate__fadeInUp animate">
          <h2 class="font-weight-bold"><?= $data["user"]["name"];?></h2>
          <p><?= $data["user"]["email"];?></p>
        </div>
      </div>
    </div>
  </header>

  <!-- Main contents -->
  <main>
    <!-- view -->
     <div class="view-full fixed-top vw-100 vh-100 d-none flex-column justify-content-center align-items-center" style="z-index: 9999;">
      <!-- image full view -->
      <div class="main-full">
        <img src="" class="status-img rounded mb-3"   alt="">
      </div>
    </div>
    <!-- container -->
    <div class="container d-flex flex-column flex-lg-row flex-md-row justify-content-center">
      <!-- Aside areas -->
      <div class="aside col-md-3 col-lg-3 col-12 d-flex flex-column h-50 ">
        <!-- Setting area -->
        <div class="p-3 mb-4 rounded order-2 d-none d-md-block d-lg-block">
          <a href="" class="aside-element badge p-3 rounded-pill d-flex text-dark align-items-center text-center animate__animated animate__fadeInLeft animate" data-toggle="modal" data-target="#input-edit">
            <i class="fas fa-cog"></i>
            <p class=" my-auto ml-3">Setting</p>
          </a>
          <a href="" class="aside-element active badge p-3 mt-3 rounded-pill d-flex text-dark align-items-center text-center animate__animated animate__fadeInLeft animate" onclick = "publicClick(event)">
            <i class="fas fa-globe"></i>
            <p class="my-auto ml-3">Public</p>
          </a>
          <a href="" class="aside-element  badge p-3 mt-3 rounded-pill d-flex text-dark align-items-center text-center animate__animated animate__fadeInLeft animate" onclick = "myClick(event)">
            <i class="fas fa-user"></i>
            <p class="my-auto ml-3">My Posts</p>
          </a>
          <a href="" class="aside-element  badge p-3 mt-3 rounded-pill d-flex text-dark align-items-center text-center animate__animated animate__fadeInLeft animate" onclick = "markClick(event)">
            <i class="fas fa-bookmark"></i>
            <p class="my-auto ml-3">Marked</p>
          </a>
          <a href="" class="aside-element  badge p-3 mt-3 rounded-pill d-flex text-dark align-items-center text-center animate__animated animate__fadeInLeft animate" onclick = "toChat(event)">
            <i class="fas fa-comment-alt"></i>
            <p class="my-auto ml-3">Chat</p>
            <span class="chatCountDiscover badge badge-pill ml-2 badge-info py-1"><small class="chatCount">20</small></span>
          </a>
          <a href="" class="aside-element  badge p-3 mt-3 rounded-pill d-flex text-dark align-items-center text-center animate__animated animate__fadeInLeft animate" data-toggle="modal" data-target="#input-report">
            <i class="fas fa-bug"></i>
            <p class="my-auto ml-3">Report</p>
          </a>
          <a href="" class="aside-element  badge p-3 mt-3 rounded-pill d-flex text-dark align-items-center text-center animate__animated animate__fadeInLeft animate" data-toggle="modal" data-target="#static-about">
            <i class="fas fa-info-circle"></i>
            <p class="my-auto ml-3">About</p>
          </a>
          <a href="" class="aside-element logout badge p-3 mt-3 rounded-pill d-flex align-items-center text-danger text-center animate__animated animate__fadeInLeft animate" data-toggle="modal" data-target="#single-logout">
            <i class="fas fa-sign-out-alt"></i>
            <p class="my-auto ml-3">Logout</p>
          </a>
        </div>
      </div>
        
  <!-- Main contents -->
  <main class="d-flex flex-column flex-lg-row flex-md-row">
    <!-- Sticky Aside -->
    <aside class="aside-adm col-md-4 col-lg-4 col-12 bg-light">
      <!-- profile -->
      <div class="mt-5">
        <div class="d-flex justify-content-center">
          <img src="<?= BASEURL;?>/img/users/profile/<?= $data["user"]["profile"];?>"  class="rounded-circle photo-profile" alt="">
        </div>
        <!-- text -->
        <div class="mt-3 text-center">
          <h5><?=$data["user"]["email"]?></h5>
           <p>Administrator of Jepri Media</p>
        </div>
      </div>
      <!-- fitur -->
      <div class="mt-5 mb-5 d-flex justify-content-center">
        <div class="col-8">
          <hr>
          <a href="<?=BASEURL?>/Admin" class="d-flex text-dark align-items-center text-center">
            <i class="fas fa-home"></i>
            <p class="my-auto ml-3 text-left">Home</p>
          </a>
          <hr>
          <a href="<?=BASEURL?>/Admin/users" class="d-flex text-dark align-items-center text-center">
            <i class="fas fa-user-friends"></i>
            <p class="my-auto ml-3 text-left">Users Management</p>
          </a>
          <hr>
          <a href="<?=BASEURL?>/Admin/posts" class="d-flex text-dark align-items-center text-center">
            <i class="fas fa-mail-bulk"></i>
            <p class="my-auto ml-3 text-left">Posts Management</p>
          </a>
          <hr>
          <a href="#" class="d-flex align-items-center text-danger text-center" data-toggle="modal" data-target="#single-logout">
            <i class="fas fa-sign-out-alt"></i>
            <p class="my-auto ml-3">Logout</p>
          </a href="#">
          <hr>
        </div>
      </div>
    </aside>
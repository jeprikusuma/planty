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
    <div class="container d-flex flex-column flex-lg-row flex-md-row justify-content-center">
      <!-- Aside areas -->
      <div class="aside col-md-3 col-lg-3 col-12 d-flex flex-column h-50">
        <!-- Setting area -->
        <div class="p-3 mb-4 rounded order-2">
          <a href="#" class="aside-element badge p-3 rounded-pill d-flex text-dark align-items-center text-center" data-toggle="modal" data-target="#input-edit">
            <i class="fas fa-user-cog"></i>
            <p class=" my-auto ml-3">Edit Profile</p>
          </a>
          <a href="#" class="aside-element  badge p-3 mt-2 rounded-pill d-flex text-dark align-items-center text-center" data-toggle="modal" data-target="#static-about">
            <i class="fas fa-info-circle"></i>
            <p class="my-auto ml-3">About</p>
          </a>
          <a href="#" class="aside-element  badge p-3 mt-2 rounded-pill d-flex align-items-center text-danger text-center" data-toggle="modal" data-target="#single-logout">
            <i class="fas fa-sign-out-alt"></i>
            <p class="my-auto ml-3">Logout</p>
          </a href="#">
        </div>
      </div>

      <!-- Main content -->
      <div class="col-md-6 col-lg-6 mx-0 mx-md-2 mx-lg-2 col-12 order-3 order-md-2 order-lg-2">
        <!-- posting-->
        <div class="posting">
          <div class="col-12 shadow-sm py-3 px-4 mb-4 bg-white rounded">
            <!-- input -->
              <form action="" method="post" id ="posting">
                <div class="d-flex justify-content-between align-items-start">
                  <img src="<?= BASEURL;?>/img/users/profile/<?= $data["user"]["profile"];?>" class="photo-status rounded-circle" alt="">
                  <div class="ml-2 col-12 d-flex flex-column">
                    <label for="inImg" class="select-img bg-light col-10 rounded py-5 mb-3 d-flex justify-content-center text-muted">
                      Click to select an image...
                    </label>
                    <input type="text" name="content" class="form-control col-10" placeholder="What do you think?" autocomplete="off" id = "posting-status" >
                    <input type="file" name="" id="inImg" class="d-none">
                  </div>
                </div>
                <div class="mt-4 d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
          </div>
         
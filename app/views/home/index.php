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
    <div class="container d-flex flex-column flex-lg-row flex-md-row justify-content-between">
      <!-- Banner areas -->
      <div class="aside col-md-4 col-lg-4 col-12 d-flex flex-column h-50">
        <!-- Aside area -->
        <div class="order-3 order-md-1 order-lg-1  mb-3">
          <div class="input-group">
            <!-- Search user -->
            <input type="text" name="search" id = "search" class="form-control" autocomplete="off" placeholder="Whose posts do you only want to see?" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button type="submit" id="button-search" class="btn btn-primary" type="button" onclick="searchClick()"><i class="fas fa-search"></i></button>
            </div>
          </div>
        </div>
        <!-- Setting area -->
        <div class="p-3 mt-4 mb-4 border rounded order-2">
          <h4>Setting</h4>
          <hr>
          <a href="#" class="d-flex text-dark align-items-center text-center" data-toggle="modal" data-target="#input-edit">
            <i class="fas fa-user-cog"></i>
            <p class="my-auto ml-3">Edit Profile</p>
          </a>
          <hr>
          <a href="#" class="d-flex text-dark align-items-center text-center" data-toggle="modal" data-target="#static-about">
            <i class="fas fa-info-circle"></i>
            <p class="my-auto ml-3">About</p>
          </a>
          <hr>
          <a href="#" class="d-flex align-items-center text-danger text-center" data-toggle="modal" data-target="#single-logout">
            <i class="fas fa-sign-out-alt"></i>
            <p class="my-auto ml-3">Logout</p>
          </a href="#">
        </div>
        <!-- alert -->
        <div class="alert alert-primary alert-dismissible fade show order-1 order-md-3 order-lg-3" role="alert">
          You have read and agree to the <strong>terms and conditions and accept the privacy policy</strong>. Any content deemed infringing will be removed.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>

      <!-- Main content -->
      <div class="col-md-7 col-lg-7 col-12">
        <!-- posting-->
        <div class="posting">
          <div class="col-12 shadow-sm p-4 mb-4 bg-white rounded">
            <!-- input -->
              <form action="" method="post" id ="posting">
                <div class="d-flex justify-content-between align-items-center">
                  <img src="<?= BASEURL;?>/img/users/profile/<?= $data["user"]["profile"];?>" class="photo-status rounded-circle" alt="">
                  <input type="text" name="content" class="ml-2 form-control col-10" placeholder="What do you think?" autocomplete="off" id = "posting-status" >
                </div>
                <div class="mt-4 d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
          </div>
         
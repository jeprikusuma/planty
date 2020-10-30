    <!-- Main Content -->
    <div class="col-md-8 col-lg-8 col-12 justify-content-center container">
      <div class="col-11 mt-5 container">
        <!-- set user-->
        <div class="posting">
        <form action="<?=BASEURL;?>/Admin/users" method="post">
          <div class="input-group mb-3 order-3 order-md-1 order-lg-1">
                <!-- Search user -->
                <input type="text" class="form-control" placeholder="Whose users do you only want to see?" aria-describedby="basic-addon2" autocomplete="off" name="search">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                </div>
          </div>
       </form>
          <div class="d-flex mb-4">
            <a href="<?= BASEURL;?>/Admin/users" class="btn  <?= ($data["nav"] == "def")?'btn-info ': 'btn-outline-info'; ?> mr-2">All Users</a>
            <a href="<?= BASEURL;?>/Admin/users/nonActive" class="btn <?= ($data["nav"] == "nonActive")?'btn-info ': 'btn-outline-info'; ?>  mr-2">Non-active</a>
            <a href="<?= BASEURL;?>/Admin/users/active" class="btn <?= ($data["nav"] == "active")?'btn-info ': 'btn-outline-info'; ?> ">Active</a>
          </div>
        </div>
         <!-- all users -->
        <?php Flasher::flash(); ?>
        <div class="users">
        <?php if(isset($data['search'])) : ?>
            <h5 class="mt-3 mb-3">Show results: <?=$data['search']?></h5>
        <?php endif; ?>
        <?php if(count($data["main"])==0) : ?>
            <p class="mt-5">There are no user here...</p>
        <?php else : ?>
        <?php foreach($data["main"] as $user): ?>
          <div class="col-12 shadow-sm p-4 mb-4 d-flex justify-content-between <?= ($user["isActive"] == 1)?'bg-white': 'bg-light'; ?>  rounded flex-column flex-lg-row flex-md-row">
            <!-- header -->
                <div class="d-flex align-items-center">
                  <img src="<?= BASEURL;?>/img/users/profile/<?= $user["profile"];?>" class="rounded-circle" width="50px" alt="">
                  <div class="d-flex flex-column ml-4">
                    <h5><?= $user["name"];?></h5>
                    <p class="text-secondary"><?= $user["email"];?></p>
                  </div>
                </div>
                <div class="d-flex align-items-center justify-content-end mt-3 mt-md-0 mt-lg-0">
                <?php if($user["name"] != "Admin") : ?>
                    <?php if($user["isActive"] == 1) : ?>
                        <a href="#" class="btn btn-warning text-white mr-1" class="btn btn-primary text-white mr-1" onclick="costumModalSet('warning', 'Suspend', 'Suspend <?= $user['name'] ?>','<?= BASEURL;?>/Admin/setSuspend/<?= $user['id'] ?>/sus')" data-toggle="modal" data-target="#costum-modal">Suspend</a>
                    <?php else: ?>
                        <a href="#" class="btn btn-primary text-white mr-1" onclick="costumModalSet('primary', 'Unsuspend', 'Unsuspend <?= $user['name'] ?>','<?= BASEURL;?>/Admin/setSuspend/<?= $user['id'] ?>/un')" data-toggle="modal" data-target="#costum-modal">Unsuspend</a>
                    <?php endif; ?>
                        <a href="#" class="btn btn-danger" onclick="costumModalSet('danger','Delete', 'Delete <?= $user['name'] ?>','<?= BASEURL;?>/Admin/deleteUser/<?= $user['id'] ?>')" data-toggle="modal" data-target="#costum-modal">Delete</a>
                <?php endif; ?>
                </div>
                          </div>
          <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </main>
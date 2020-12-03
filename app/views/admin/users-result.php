        <?php Flasher::flash(); ?>
        <?php if(isset($data['search'])) : ?>
            <?php if($data['search'] != "") : ?>
               <h5 class="mt-3 mb-3">Show results: <?=$data['search']?></h5>
            <?php endif; ?>
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
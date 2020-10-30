<div class="col-md-8 col-lg-8 col-12 justify-content-center container">
      <div class="col-11 mt-5 container">
        <!-- set user-->
        <div class="posting">
        <form action="<?=BASEURL;?>/Admin/posts" method="post">
          <div class="input-group mb-3 order-3 order-md-1 order-lg-1">
                <!-- Search user -->
                <input type="text" class="form-control" placeholder="Whose posts do you only want to see?" aria-describedby="basic-addon2" autocomplete="off" name="search">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                </div>
          </div>
        </form>
          <div class="d-flex mb-4">
            <a href="<?= BASEURL;?>/Admin/posts" class="btn <?= ($data["nav"] == "def")?'btn-info ': 'btn-outline-info'; ?> mr-2">All Posts</a>
            <a href="<?= BASEURL;?>/Admin/posts/sus" class="btn <?= ($data["nav"] == "sus")?'btn-info ': 'btn-outline-info'; ?>">Suspended Posts</a>
          </div>
        </div>
         <!-- all status -->
         <?php Flasher::flash(); ?>
        <div class="status">
        <?php if(isset($data['search'])) : ?>
            <h5 class="mt-3 mb-3">Show results: <?=$data['search']?></h5>
        <?php endif; ?>
        <?php if(count($data["main"])==0) : ?>
            <p class="mt-5">There are no post here...</p>
        <?php else : ?>
        <?php foreach($data["main"] as $post): ?>
          <div class="col-12 shadow-sm p-4 mb-4  <?= ($post["suspended"] == 0)?'bg-white': 'bg-light'; ?> rounded">
            <!-- header -->
                <div class="d-flex align-items-center">
                  <img src="<?= BASEURL;?>/img/users/profile/<?=$post["profile"]?>" class="rounded-circle" width="50px" alt="">
                  <div class="d-flex flex-column ml-4">
                    <h5><?=$post["name"]?></h5>
                    <p class="text-secondary"><?=$post["upload"]?></p>
                  </div>
                </div>
                <div class="mt-4 d-flex justify-content-start">
                  <p><?=$post["content"]?></p>
                </div>
                <div class="mt-4 d-flex justify-content-end">
                <?php if($post["suspended"] == 0) : ?>
                   <a href="#" class="btn btn-warning text-white mr-1" onclick="costumModalSet('warning', 'Suspend', 'Suspend post by  <?= $post['name'] ?>','<?= BASEURL;?>/Admin/setSuspendPost/<?= $post['id'] ?>/sus')" data-toggle="modal" data-target="#costum-modal">Suspend</a>
                <?php else : ?>
                    <a href="#" class="btn btn-primary text-white mr-1" onclick="costumModalSet('primary', 'Unsuspend', 'Unsuspend post by <?= $post['name'] ?>','<?= BASEURL;?>/Admin/setSuspendPost/<?= $post['id'] ?>/un')" data-toggle="modal" data-target="#costum-modal">Unsuspend</a>
                <?php endif; ?>
                   <a href="#" class="btn btn-danger" onclick="costumModalSet('danger', 'Delete', 'Delete post by <?= $post['name'] ?>','<?= BASEURL;?>/Admin/deletePost/<?= $post['id'] ?>')" data-toggle="modal" data-target="#costum-modal">Delete</a>
                </div>
          </div>
        <?php endforeach; ?>
        <?php endif; ?>
        </div>
      </div>
    </div>
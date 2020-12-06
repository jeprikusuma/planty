         <!-- all status -->
        <?php Flasher::flash(); ?>
        <?php if(isset($data['search'])) : ?>
            <h5 class="mt-3 mb-3">Show results: <?=$data['search']?></h5>
        <?php endif; ?>
        <?php if(count($data["posts"])==0) : ?>
            <p class="mt-5">There are no post here...</p>
        <?php else : ?>
        <?php foreach($data["posts"] as $post): ?>
          <div class="col-12 shadow-sm p-4 mb-4 bg-white rounded">
            <!-- header -->
                <div class="d-flex align-items-center">
                  <img src="<?= BASEURL;?>/img/users/profile/<?=$post["profile"]?>" class="photo-status rounded-circle" alt="">
                  <div class="d-flex flex-column ml-4">
                    <h5><?=$post["name"]?></h5>
                    <p class="text-secondary"><?=$post["upload"]?></p>
                  </div>
                </div>
                <div class="mt-4 d-flex flex-column  justify-content-start">
                  <p><?=$post["content"]?></p>
                  <div class="more<?=$post["id"]?> d-flex align-items-center">
                   <?php require("statusmore.php")?>
                  </div>
                </div>
                <?php if(isset($data["nav"])) : ?>
                <?php if($data["nav"] == "my") : ?>
                <div class="mt-4 d-flex justify-content-end">
                  <a href="#" class="btn btn-danger" onclick="costumModalSet('danger', 'Delete', 'delete this post','<?= BASEURL;?>/Home/deletePost/<?=$post['id']?>')" data-toggle="modal" data-target="#costum-modal">Delete</a>
                </div>
                <?php endif; ?>
                <?php endif; ?>
          </div>
        <?php endforeach; ?>
        <?php endif; ?>
        
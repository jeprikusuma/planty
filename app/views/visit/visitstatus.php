         <!-- all status -->
         <?php Flasher::flash(); ?>
        <?php if(count($data["posts"])==0) : ?>
            <p class="mt-5">There are no post here...</p>
        <?php else : ?>
        <?php foreach($data["posts"] as $post): ?>
          <div class="col-12 shadow-sm p-4 mb-4 bg-white rounded">
            <!-- header -->
                <div class="d-flex align-items-start">
                  <img src="<?= BASEURL;?>/img/users/profile/<?=$post["profile"]?>" class="photo-status mt-1 rounded-circle" alt="">
                  <div class="d-flex flex-column ml-4">
                    <h5><?=$post["name"]?></h5>
                    <p class="text-secondary"><?=$post["upload"]?></p>
                  </div>
                </div>
                <div class="mt-4 d-flex flex-column  justify-content-start">
                <?php if($post['file'] != NULL): ?>
                   <img src="<?= BASEURL;?>/img/users/post/<?=$post["file"]?>" class="status-img rounded mb-3" width="100%" alt="" onclick="viewFull('<?= BASEURL;?>/img/users/post/', '<?=$post['file']?>')">
                <?php endif; ?>
                  <p><?=$post["content"]?></p>
                  <div class="more<?=$post["id"]?> d-flex align-items-center mt-2">
                   <?php require("visitstatusmore.php")?>
                  </div>
                </div>
          </div>
        <?php endforeach; ?>
        <?php endif; ?>
        
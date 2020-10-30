<div class="d-flex mb-4">
            <a href="<?= BASEURL;?>/Home/" class="btn btn-info mr-2">Public Posts</a>
            <a href="<?= BASEURL;?>/Home/mypost" class="btn btn-outline-info">My Posts</a>
          </div>
        </div>
         <!-- all status -->
        <div class="status">
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
                <div class="mt-4 d-flex justify-content-start">
                  <p><?=$post["content"]?></p>
                </div>
          </div>
        <?php endforeach; ?>
        <?php endif; ?>
        </div>
      </div>
    </div>
  </main>
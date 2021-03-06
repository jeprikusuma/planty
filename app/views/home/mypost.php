  <div class="d-flex mb-4">
            <button class="btn <?= ($data["nav"] == "public")?'btn-info ': 'btn-outline-info'; ?> mr-2" id="button-public">Public Posts</button>
            <button class="btn <?= ($data["nav"] == "my")?'btn-info ': 'btn-outline-info'; ?>" id="button-my">My Posts</button>
          </div>
        </div>
         <!-- all status -->
        <div class="status">
        <?php if(count($data["posts"])==0) : ?>
            <p class="mt-5">There are no post here...</p>
        <?php else : ?>
        <?php foreach($data["posts"] as $post): ?>
          <div class="col-12 shadow-sm p-4 mb-4 bg-white rounded">
            <!-- header -->
                <div class="d-flex align-items-center">
                  <img src="<?= BASEURL;?>/img/users/profile/<?=$post["profile"]?>" class="rounded-circle photo-status"  alt="">
                  <div class="d-flex flex-column ml-4">
                    <h5><?=$post["name"]?></h5>
                    <p class="text-secondary"><?=$post["upload"]?></p>
                  </div>
                </div>
                <div class="mt-4 d-flex justify-content-start">
                  <p><?=$post["content"]?></p>
                </div>
                <?php if ($data["nav"] == "my") : ?>
                <div class="mt-4 d-flex justify-content-end">
                  <a href="#" class="btn btn-danger" onclick="costumModalSet('danger', 'Delete', 'delete this post ?','<?= BASEURL;?>/Home/deletePost/<?=$post['id']?>')" data-toggle="modal" data-target="#costum-modal">Delete</a>
                </div>
                <?php endif; ?>
          </div>
        <?php endforeach; ?>
        <?php endif; ?>
        </div>
      </div>
    </div>       
  </main>

  
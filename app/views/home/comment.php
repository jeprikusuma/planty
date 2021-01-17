    <div class="comment">
             <?php $user = $data['user'];?>
          <div class="col-12 shadow-sm p-4 mb-4 bg-white rounded">
              <!-- header -->
              <div class="d-flex align-items-center">
                <img src="<?= BASEURL;?>/img/users/profile/<?=$data["profile"]?>"  class="photo-status rounded-circle"  width="50px"  alt="">
                <div class="d-flex flex-column ml-4">
                  <h5><?=$data["name"]?></h5>
                  <p class="text-secondary"><?=$data["upload"]?></p>
                </div>
              </div>
              <div class="mt-4 mb-3 d-flex justify-content-start">
                  <?php if($data['file'] != NULL): ?>
                    <img src="<?= BASEURL;?>/img/users/post/<?=$data["file"]?>" class="status-img rounded mb-3" width="100%"   alt="">
                  <?php endif; ?>
                  <p><?=$data["content"]?></p>
             </div>
             <div class="more<?=$data["id"]?> d-flex align-items-center mb-5">
                   <?php require("statusmore.php")?>
             </div>
             <div class="mb-4 mt-2">
                <div class="d-flex ml-2 mt-2 justify-content-between align-items-center">
                  <img src="<?= BASEURL;?>/img/users/profile/<?=$user["profile"]?>" class="photo-status rounded-circle d-md-block d-lg-block  d-none " width="50px" alt="">
                  <input type="text" class="ml-2 form-control col-9" placeholder="Reply to <?=$data["name"]?>" id="comment-value">
                  <button type="submit" class="btn btn-primary" onclick="commentPost(<?=$data['id']?>)">Send</button>
                </div>                
            </div>
             <div class="comments">
             <?php require("comments.php")?>
             </div>
          </div>
        </div>
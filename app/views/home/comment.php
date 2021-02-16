    <div class="comment">
             <?php $user = $data['user'];?>
          <div class="col-12 shadow-sm p-4 mb-4 bg-white rounded">
              <!-- header -->
              <div class="d-flex align-items-start justify-content-between">
                <div class="d-flex align-items-start">
                  <img src="<?= BASEURL;?>/img/users/profile/<?=$data["profile"]?>"  class="photo-status rounded-circle"  width="50px"  alt="">
                  <div class="d-flex flex-column ml-4 mr-3">
                    <a href="<?= BASEURL;?>/Home/visit/<?= $data['userComment'];?>"><h5 class="text-dark"><?=$data["name"]?></h5></a>
                    <p class="text-secondary"><?=$data["upload"]?></p>
                  </div>
                </div>
                <?php if($data["email"] != $_SESSION['user']) : ?>              
                    <div class="btn-group">
                      <i class="fas fa-ellipsis-v text-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                      <div class="dropdown-menu ">
                        <a class="dropdown-item text-dark" href="" onclick="createRoomChat(<?=$data['userComment']?>,event)">Personal chat</a>
                        <a class="dropdown-item text-dark" href="" onclick="costumModalSet('warning', 'Hide Post', 'hide this post ?','<?= BASEURL;?>/Home/hidePost/<?=$data['id']?>')" data-toggle="modal" data-target="#costum-modal">Hide post for me</a>
                        <a class="dropdown-item text-dark" onclick="costumModalReport('Post', 'Tell us why you want to report <strong>post from <?=$data['name']?>?</strong>','<?= BASEURL;?>/Report/reportPost/<?=$data['id']?>')" data-toggle="modal" data-target="#costum-report">Report post</a>
                        <a class="dropdown-item text-dark" onclick="costumModalReport('Member', 'Tell us why you want to report <strong><?=$data['name']?>?</strong>','<?= BASEURL;?>/Report/reportUser/<?=$data['userComment']?>')" data-toggle="modal" data-target="#costum-report">Report member</a>
                      </div>
                    </div>
                <?php endif; ?>
              </div>
              <div class="mt-4 mb-3 d-flex flex-column justify-content-start">
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
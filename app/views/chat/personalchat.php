        <div class="shadow-sm rounded p-2 mb-4 mt-5 mt-md-0 mt-lg-0 col-12" id="idChat" data-idchat="<?=$data['chat']['id']?>">
          <div class="d-flex justify-content-between  px-3">
            <div class="d-flex align-items-center">
              <img src="<?= BASEURL;?>/img/users/profile/<?= $data['userChat']['profile'];?>" class="photo-status rounded-circle" width="50px" alt="">
              <div class="d-flex flex-column ml-4 mt-2">
                <a  href="<?= BASEURL;?>/Home/visit/<?= $data['userChat']['id'];?>" class="text-dark">
                  <h5><?= $data['userChat']['name']?></h5>
                </a>
                <p class="text-secondary"><?= $data['userChat']['email']?></p>
              </div>
            </div>
            <a class="d-flex align-items-center text-secondary">
              <?php $personalChat = json_decode($data["personalChat"]);?>
              <?php if(count($personalChat) == 0 || ($data['chat']['deleted'] != 0 && $data['chat']['deleted'] != $data['userChat']['id'])) : ?>
              <?php else : ?>
                <i class="fas fa-trash m-trash" onclick="costumModalSet('danger', 'Delete Chat', ' delete chat with <?= $data['userChat']['name']?>? <span>Chat is only hidden, it will return if your chat partner sends a message. Chats will be permanently deleted if your chat partner also deletes this chat.</span>','<?= BASEURL;?>/Chat/deleteChat/<?=$data['chat']['id']?>')" data-toggle="modal" data-target="#costum-modal"></i>
              <?php endif; ?>
            </a>
          </div>
          <hr>
          <div class="chats overflow-auto" style="height: 30rem;">
             <?php require_once('personalchats.php')?>
          </div>
          <div class="input-group mb-3 order-3 order-md-1 order-lg-1 mt-3">
            <input type="text" class="form-control" aria-describedby="basic-addon2" id="inputChat">
            <div class="input-group-append">
              <button class="btn btn-primary" onclick="sendPersonalChat(<?=$data['chat']['id']?>, <?=$data['chat']['user1']?>, <?=$data['chat']['user2']?>)" type="button"><i class="fas fa-paper-plane"></i></button>
            </div>
          </div>
        </div>
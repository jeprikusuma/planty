        <?php if(!isset($data['chats'])) : ?>
            <p class="mt-4">Loading...</p>
        <?php elseif(count($data['chats']) == 0) : ?>
            <p class="mt-4">Choose a member and start your first chat.</p>
        <?php else : ?>
            <?php foreach($data["chats"] as $chat): ?>
                <?php $isUser1 = $chat['email1'] == $_SESSION['user']?>

                <div class="p-chat d-flex align-items-center" onclick="toPersonalChat(<?= $chat['id']?>, <?= $isUser1 ? $chat['idUser2'] : $chat['idUser1']?>)">
                    <div class="position-relative">
                    <img src="<?= BASEURL;?>/img/users/profile/<?= $isUser1 ? $chat['profile2'] : $chat['profile1']?>" class="photo-status rounded-circle" width="50px" alt="">
                    <?php if($chat['lastFor'] == $_SESSION['user']) : ?>
                         <span class="badge badge-pill badge-info p-2 position-absolute" style="bottom: 0; right: 0;"> </span> 
                    <?php endif ?>
                    </div>
                    <div class="d-flex flex-column mt-2 ml-4">
                    <h5><?= $isUser1 ? $chat['user2'] : $chat['user1']?></h5>
                    <p><?=  substr($chat['lastChat'], 0, 50);?></p>
                </div>
                </div>  
                <hr>
            <?php endforeach ?>
        <?php endif ?>
        
        
        
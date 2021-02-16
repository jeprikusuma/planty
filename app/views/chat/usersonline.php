        <?php if(!isset($data['usersOnline'])) : ?>
            <p class="mt-4">Loading...</p>
        <?php else : ?>
            <?php foreach($data["usersOnline"] as $userData): ?>
                <div class="d-flex align-items-center p-user flex-row">
                    <div class="position-relative">
                    <img src="<?= BASEURL;?>/img/users/profile/<?= $userData['profile'];?>" class="photo-status rounded-circle" width="50px" alt="">
                    </div>
                    <div class="d-flex flex-column ml-4">
                    <?php if($userData['email'] == $_SESSION['user']) : ?>
                        <h5>You</h5>
                    <?php else : ?>
                        <h5 onclick="createRoomChat(<?= $userData['id'] ?>)"><?= $userData['name']?></h5>
                        <p onclick="createRoomChat(<?= $userData['id'] ?>)"><?= $userData['email']?></p>
                    <?php endif ?>
                </div>
                </div>
                <hr>
            <?php endforeach ?>
        <?php endif ?>
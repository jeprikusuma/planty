
               <?php $comments = json_decode($data["comments"]);?>
               
               <?php if(count($comments) <= 1) : ?>
                <p class="mt-5">There are no comments here...</p>
                <?php else : ?>
                    <?php foreach($comments as $comment): ?>
                        <?php $comment = (array) $comment ?>
                        <?php if(count($comment) > 1): ?>
                            <div class="comment mt-4 ml-2 d-flex justify-content-start">
                                <img src="<?= BASEURL;?>/img/users/profile/<?=$comment["img"]?>"  class="photo-status rounded-circle" width="30px" alt="">
                                <div class="d-flex flex-column ml-4">
                                    <h5><?=$comment["name"]?></h5>
                                    <p class="small text-secondary">Reply on <?=$comment["upload"]?></p>
                                    <p><?=$comment["comment"]?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
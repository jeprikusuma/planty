                    <?php if(!isset($post)) $post = $data;?>
                    <?php $user = $data['user'];?>

                    <span class="mr-1"><?= count(json_decode($post["likes"], true))-1;?></span>     
                    <?php if(array_search($user['id'],json_decode($post["likes"]))) : ?>
                      <i class="fas fa-heart like-done" onclick="unlike(<?=$post['id']?>)"></i>
                    <?php else : ?>
                        <i class="fas fa-heart like" onclick="like(<?=$post['id']?>)"></i>
                    <?php endif; ?>
                    <span class="mr-1 ml-3"><?= count((array)json_decode($post["comments"], true))-1;?></span> 
                    <i class="fas fa-comment-alt comment" onclick="toComment(<?=$post['id']?>)"></i>
                    <?php if(array_search($user['id'], json_decode($post["mark"]))) : ?>
                      <i class="fas fa-bookmark ml-4 s-marked" onclick="unmark(<?=$post['id']?>)"></i>
                    <?php else : ?>
                      <i class="fas fa-bookmark ml-4 s-mark" onclick="mark(<?=$post['id']?>)"></i>
                    <?php endif; ?>
                    
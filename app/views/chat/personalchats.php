            <?php $personalChat = json_decode($data["personalChat"]);?>

            <?php foreach($personalChat as $chat): ?>
                <?php $chat = (array) $chat?>
                <?php if($chat['from'] == $_SESSION['user']): ?>
                    <div class="d-flex justify-content-end my-2" >
                    <div class="d-flex align-items-end">
                    </div>
                    <div class="bg-primary rounded text-white text-left px-3 py-1 chat-from" style="max-width: 50%;" >
                        <?=$chat['value'] ?>
                    </div>
                    </div>
                <?php else: ?>
                    <div class="d-flex justify-content-start my-2">
                    <div class="bg-light rounded text-dark px-3 py-1" style="max-width: 50%;">
                        <?=$chat['value'] ?>
                    </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
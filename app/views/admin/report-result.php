<?php Flasher::flash(); ?>
        <?php if(isset($data['search'])) : ?>   
            <?php if($data['search'] != "") : ?>
                <h5 class="mt-3 mb-3">Show results: <?=$data['search']?></h5>
            <?php endif; ?>
        <?php endif; ?>
        <?php if(count($data["main"])==0) : ?>
            <p class="mt-5">There are no report here...</p>
        <?php else : ?>
        <?php foreach($data["main"] as $report): ?>
            <?php if($data['nav'] == "system") : ?>
                <div class="col-12 shadow-sm p-4 mb-4 rounded">
                <div class="d-flex align-items-center">
                  <img src="<?= BASEURL;?>/img/users/profile/<?=$report["profile"]?>" class="adm-sm-img rounded-circle" width="50px" height="50px" alt="">
                  <div class=" d-flex flex-column ml-4">
                    <h5><?=$report["name"]?></h5>
                    <p class="text-secondary"><?=$report["sended"]?></p>
                  </div>
                </div>
                <div class="mt-4 d-flex flex-column justify-content-start">
                  <p><?=$report["description"]?></p>
                </div>
               </div>
            <?php elseif($data['nav'] == "user") : ?>
                <div class="col-12 shadow-sm p-4 mb-4 rounded">
                <div class="d-flex align-items-center">
                  <img src="<?= BASEURL;?>/img/users/profile/<?=$report["profile"]?>" class="adm-sm-img rounded-circle" width="50px" height="50px" alt="">
                  <div class=" d-flex flex-column ml-4">
                    <h5><?=$report["name"]?></h5>
                    <p class="text-secondary"><?=$report["sended"]?></p>
                  </div>
                </div>
                <div class="mt-4 d-flex flex-column justify-content-start">
                  <p><?=$report["description"]?></p>
                  <div>
                  <div class="col-12 shadow-sm p-4 mb-4 d-flex justify-content-between <?= ($report['forUser']["isActive"] == 1)?'bg-white': 'bg-light'; ?>  rounded flex-column flex-lg-row flex-md-row">
                    <!-- header -->
                        <div class="d-flex align-items-center">
                        <img src="<?= BASEURL;?>/img/users/profile/<?= $report['forUser']["profile"];?>" class="adm-sm-img rounded-circle" width="50px" height="50px" alt="">
                        <div class="d-flex flex-column ml-4">
                            <h5><?= $report['forUser']["name"];?></h5>
                            <p class="text-secondary"><?= $report['forUser']["email"];?></p>
                        </div>
                        </div>
                    </div>
                  </div>
                </div>
               </div>
            <?php else: ?>
                <div class="col-12 shadow-sm p-4 mb-4 rounded">
                <div class="d-flex align-items-center">
                  <img src="<?= BASEURL;?>/img/users/profile/<?=$report["profile"]?>" class="adm-sm-img rounded-circle" width="50px" height="50px" alt="">
                  <div class=" d-flex flex-column ml-4">
                    <h5><?=$report["name"]?></h5>
                    <p class="text-secondary"><?=$report["sended"]?></p>
                  </div>
                </div>
                <div class="mt-4 d-flex flex-column justify-content-start">
                  <p><?=$report["description"]?></p>
                  <div>
                  <div class="col-12 shadow-sm p-4 mb-4  <?= ($report['forPost']["suspended"] == 0)?'bg-white': 'bg-light'; ?> rounded">
                    <!-- header -->
                        <div class="d-flex align-items-center">
                        <img src="<?= BASEURL;?>/img/users/profile/<?=$report['forPost']["profile"]?>" class="adm-sm-img rounded-circle" width="50px" height="50px" alt="">
                        <div class=" d-flex flex-column ml-4">
                            <h5><?=$report['forPost']["name"]?></h5>
                            <p class="text-secondary"><?=$report['forPost']["upload"]?></p>
                        </div>
                        </div>
                        <div class="mt-4 d-flex flex-column justify-content-start">
                        <?php if($report['forPost']['file'] != NULL): ?>
                            <img src="<?= BASEURL;?>/img/users/post/<?=$report['forPost']["file"]?>" class="status-img rounded mb-3" width="100%" alt="">
                        <?php endif; ?>
                        <p><?=$report['forPost']["content"]?></p>
                        </div>
                        <div class="more<?=$report['forPost']["id"]?> d-flex align-items-center">
                            <span class="mr-1"><?= count(json_decode($report['forPost']["likes"], true))-1;?></span> 
                            <i class="fas fa-heart like-done"></i>
                            <span class="mr-1 ml-3"><?= count((array)json_decode($report['forPost']["comments"], true))-1;?></span> 
                            <i class="fas fa-comment-alt comment"></i>
                        </div>
                     </div>
                  </div>
                </div>
               </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php endif; ?>
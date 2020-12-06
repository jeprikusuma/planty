        <?php Flasher::flash(); ?>
        <?php if(isset($data['search'])) : ?>   
            <?php if($data['search'] != "") : ?>
                <h5 class="mt-3 mb-3">Show results: <?=$data['search']?></h5>
            <?php endif; ?>
        <?php endif; ?>
        <?php if(count($data["main"])==0) : ?>
            <p class="mt-5">There are no hastag here...</p>
        <?php else : ?>
        <hr>
        <?php foreach($data["main"] as $trend): ?>
        <div class="d-flex justify-content-between">
          <div class="trending d-flex text-dark align-items-center text-center">
            <i class="fas fa-hashtag"></i>
            <p class="my-auto ml-3 text-left"><?=$trend["hastag"]?>
            <span class="small"><br><?= count(json_decode($trend["posts"], true));?> Posts</span>
            </p>
        </div>
        <div class="button">
                 <?php if($trend["isSuspended"] == 0) : ?>
                   <a href="#" class="btn btn-warning" onclick="costumModalSet('warning', 'Suspend', 'Suspend hastag #<?= $trend['hastag'] ?>','<?= BASEURL;?>/Admin/setSuspendHastag/<?= $trend['id'] ?>/sus')" data-toggle="modal" data-target="#costum-modal">Suspend</a>
                <?php else : ?>
                    <a href="#" class="btn btn-primary text-white mr-1" onclick="costumModalSet('primary', 'Unsuspend', 'Unsuspend hastag #<?= $trend['hastag'] ?>','<?= BASEURL;?>/Admin/setSuspendHastag/<?= $trend['id'] ?>/un')" data-toggle="modal" data-target="#costum-modal">Unsuspend</a>
                <?php endif; ?>
        </div>
        </div>
        <hr>
        <?php endforeach; ?>
        <?php endif; ?>
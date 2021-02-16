        <div class="d-flex mb-4" id="discover-button">
        <h4 class="mt-4 mt-lg-0 mt-md-0">  
        <?php if($data["nav"] == "public"):?>
        Public Posts
        <?php elseif($data["nav"] == "mark"):?>
        Marked Posts
        <?php else : ?>
        My Posts
        <?php endif; ?>
        </h4>
        </div>
        <div class="status" id = "status">
        <?php require_once("status.php")?>
        </div>
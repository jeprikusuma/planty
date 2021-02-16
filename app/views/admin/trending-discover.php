        <div class="d-flex mb-4">
            <button class="btn <?= ($data["nav"] == "def")?'btn-info ': 'btn-secondary'; ?> mr-2" onclick='trendingNav("all")'>All Posts</button>
            <button class="btn <?= ($data["nav"] == "sus")?'btn-info ': 'btn-secondary'; ?>" onclick='trendingNav("sus")'>Suspended Posts</button>
          </div>
         <!-- all status -->
        <div class="status mt-5" id="trending-result">
        <?php require_once("trending-result.php") ?>
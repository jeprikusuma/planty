<div class="d-flex mb-4">
            <button class="btn <?= ($data["nav"] == "system")?'btn-info ': 'btn-secondary'; ?> mr-2" onclick='reportNav("system")'>System</button>
            <button class="btn <?= ($data["nav"] == "user")?'btn-info ': 'btn-secondary'; ?>" onclick='reportNav("user")'>User</button>
            <button class="btn <?= ($data["nav"] == "post")?'btn-info ': 'btn-secondary'; ?>" onclick='reportNav("post")'>Post</button>
          </div>
         <!-- all status -->
        <div class="status mt-5" id="report-result">
        <?php require_once("report-result.php") ?>
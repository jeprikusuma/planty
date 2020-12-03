        <div class="d-flex mb-4" id="discover-button">
             <button class="btn <?= ($data["nav"] == "public")?'btn-info ': 'btn-outline-info'; ?> mr-2" id="button-public" onclick = "publicClick()">Public Posts</button>
            <button class="btn <?= ($data["nav"] == "my")?'btn-info ': 'btn-outline-info'; ?>" id="button-my" onclick = "myClick()">My Posts</button>
        </div>
        <div class="status" id = "status">
        <?php require_once("status.php")?>
        </div>
        <div class="d-flex mb-4" id="nav-user"> 
            <button class="btn  <?= ($data["nav"] == "def")?'btn-info ': 'btn-secondary'; ?> mr-2" onclick="userNav('all')">All Users</button>
            <button class="btn <?= ($data["nav"] == "nonActive")?'btn-info ': 'btn-secondary'; ?>  mr-2" onclick="userNav('nonActive')">Non-active</button>
            <button class="btn <?= ($data["nav"] == "active")?'btn-info ': 'btn-secondary'; ?> " onclick='userNav("active")'>Active</button>
          </div>
         <!-- all users -->
          <div class="users" id="users-result">
          <?php require_once("users-result.php")?>
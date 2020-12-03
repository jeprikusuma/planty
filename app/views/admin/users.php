      <div class="col-11 mt-5 container">
        <!-- set user-->
        <div class="posting">
          <div class="input-group mb-3 order-3 order-md-1 order-lg-1">
                <!-- Search user -->
                <input type="text" class="form-control" placeholder="Whose users do you only want to see?" aria-describedby="basic-addon2" autocomplete="off" name="search" id="search-user">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit" onclick ="searchUserClick()"><i class="fas fa-search"></i></button>
                </div>
          </div>
        </div>
        <div id="users-discover">
        <?php require_once("users-discover.php")?>
        </div>
        </div>
      </div>
    </div>
      <div class="col-11 mt-5 container">
        <!-- set user-->
        <div class="posting">
          <div class="input-group mb-3 order-3 order-md-1 order-lg-1">
                <!-- Search user -->
                <input type="text" class="form-control" placeholder="Whose posts do you only want to see?" aria-describedby="basic-addon2" autocomplete="off" name="search" id="search-posts">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit" onclick="searchPostsClick()"><i class="fas fa-search"></i></button>
                </div>
          </div>
        </div>
        <div id="posts-discover">
          <?php require_once("posts-discover.php")?>
        </div>
        </div>
      </div>
    </div>
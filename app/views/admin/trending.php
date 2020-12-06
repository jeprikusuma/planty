    <div class="col-11 mt-5 container">
        <!-- set user-->
        <div class="posting">
          <div class="input-group mb-3 order-3 order-md-1 order-lg-1">
                <!-- Search user -->
                <input type="text" class="form-control" placeholder="Look for a specific hashtag?" aria-describedby="basic-addon2" autocomplete="off" name="search" id="search-trending">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit" onclick="searchTrendingClick()"><i class="fas fa-search"></i></button>
                </div>
          </div>
        </div>
        <div id="trending-discover">
          <?php require_once("trending-discover.php")?>
        </div>
        </div>
      </div>
    </div>
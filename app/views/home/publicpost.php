       <div id="discover">
        <?php require_once("discover.php")?>
      </div>
      </div>
      
    </div>
    <!-- Right Aside -->
    <div class="aside col-md-4 col-lg-4 col-12 d-flex flex-column h-50 order-2 order-md-3 order-lg-3">
        <!-- area -->
        <div class="order-4 order-md-1 order-lg-1  mb-3">
          <div class="input-group">
            <!-- Search user -->
            <input type="text" name="search" id = "search" class="form-control" autocomplete="off" placeholder="Whose posts do you only want to see?" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button type="submit" id="button-search" class="btn btn-primary" type="button" onclick="searchClick()"><i class="fas fa-search"></i></button>
            </div>
          </div>
        </div>
        <!-- Trendings area -->
        <div class="p-3 mt-3 mb-4 shadow-sm text-dark order-md-2 order-lg-2 rounded order-3">
          <h4>Trending</h4>
          <?php foreach($data["trending"] as $trend): ?>
          <hr>
          <a href="<?=BASEURL?>/Home/hastag/<?=$trend["hastag"]?>" class="trending d-flex text-dark align-items-center text-center animate__animated animate__fadeInUp animate">
            <i class="fas fa-hashtag"></i>
            <p class="my-auto ml-3 text-left"><?=$trend["hastag"]?>
            <span class="small"><br><?= count(json_decode($trend["posts"], true));?> Posts</span>
            </p>
          </a>
          <?php endforeach; ?>
        </div>
        <!-- alert -->
        <div class="alert alert-info alert-dismissible fade show order-1 order-md-3 order-lg-3 animate__animated animate__fadeIn animate" role="alert">
          You have read and agree to the <strong>terms and conditions and accept the privacy policy</strong>. Any content deemed infringing will be removed.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>



  </main>
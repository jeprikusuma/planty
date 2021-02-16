        <!-- area -->
        <div class="search-post order-1 mt-4 mt-md-0 mt-lg-0 order-md-1 order-lg-1 d-md-block d-lg-block mb-3">
          <div class="input-group">
            <!-- Search user -->
            <input type="text" name="search" id = "search" class="form-control" autocomplete="off" placeholder="Whose posts do you only want to see?" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button type="submit" id="button-search" class="btn btn-primary" type="button" onclick="searchClick()"><i class="fas fa-search"></i></button>
            </div>
          </div>
        </div>
        <!-- Trendings area -->
        <div class="trending-discover d-md-block d-lg-block p-3 mt-3 mb-4 shadow-sm text-dark order-md-2 order-lg-2 rounded order-3">
          <h4>Trending</h4>
          <?php foreach($data["trending"] as $trend): ?>
          <hr>
          <a  onclick = "trendingClick(event, 'hastag/<?=$trend['hastag']?>')" class="trending d-flex text-dark align-items-center text-center animate__animated animate__fadeInUp animate">
            <i class="fas fa-hashtag"></i>
            <p class="my-auto ml-3 text-left"><?=$trend["hastag"]?>
            <span class="small"><br><?= count(json_decode($trend["posts"], true));?> Posts</span>
            </p>
          </a>
          <?php endforeach; ?>
        </div>
        <!-- alert -->
        <div class="alert alert-info alert-dismissible fade show order-1 order-md-3 order-lg-3 animate__animated animate__fadeIn animate d-none d-md-block d-lg-block" role="alert">
          You have read and agree to the <strong>terms and conditions and accept the privacy policy</strong>. Any content deemed infringing will be removed.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
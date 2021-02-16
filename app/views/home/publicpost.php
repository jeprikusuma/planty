    <!-- Main content -->
    <div id="main" class="col-md-6 col-lg-6 mb-5 mx-0 mx-md-2 mx-lg-2 col-12 order-3 order-md-2 order-lg-2">
    <?php require_once("main.php")?>
    </div>
    <!-- Right Aside -->
    <div id="right" class="aside col-md-4 col-lg-4 col-12 d-flex flex-column h-50 order-2 order-md-3 order-lg-3">
    <?php require_once("aside.php")?>   
    </div>
  </div>

  </main>
  <div class="fixed-bottom bg-white d-flex p-3 vw-100 justify-content-around shadow-lg d-lg-none d-md-none animate__animated animate__fadeInUp animate">
        <a href="" class="m-aside-element active text-secondary mx-3" onclick = "publicClick(event)">
          <i class="fas fa-globe" style="font-size:  1.7rem;"></i>
        </a>
        <a href="" class="m-aside-element text-secondary mx-3" onclick = "myClick(event)">
          <i class="fas fa-user" style="font-size:  1.7rem;"></i>
        </a>
        <a href="" class="m-aside-element text-secondary mx-3" onclick = "markClick(event)">
          <i class="fas fa-bookmark" style="font-size:  1.7rem;"></i>
        </a>
        <a href="" class="m-aside-element text-secondary mx-3" onclick = "toChat(event)">
          <i class="fas fa-comment-alt" style="font-size:  1.7rem;"></i>
          <span class="chatCountDiscover badge badge-pill badge-info py-1"><small class="chatCount">0</small></span>
        </a>
        <div class="btn-group dropup">
          <a href="" class="m-aside-element text-secondary mx-3" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bars " style="font-size:  1.7rem;"></i>
          </a>
          <div class="dropdown-menu mb-3">
            <a class="dropdown-item text-secondary" href="" data-toggle="modal" data-target="#input-edit">Setting</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-secondary" href="" data-toggle="modal" data-target="#input-report">Report</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-secondary" href="" data-toggle="modal" data-target="#static-about">About</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" href="" data-toggle="modal" data-target="#single-logout">Logout</a>
          </div>
        </div>        
      </div>
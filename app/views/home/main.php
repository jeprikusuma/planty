<!-- posting-->
    <div class="posting ">
          <div class="col-12 posting-discover shadow-sm py-3 px-4 mb-4 bg-white rounded animate__animated animate__fadeIn animate d-none d-md-block d-lg-block">
            <!-- input -->
              <form action="" method="post" id ="posting" onsubmit="submitPost(event)">
                <div class="d-flex justify-content-between align-items-start">
                  <img src="<?= BASEURL;?>/img/users/profile/<?= $data["user"]["profile"];?>" class="photo-status rounded-circle" alt="">
                  <div class="ml-2 col-12 d-flex flex-column">
                    <label for="inImg" class="select-img bg-light col-10 rounded py-5 mb-3 d-flex justify-content-center text-muted">
                      <img class="rounded d-none" src="" alt="">
                       <span > Click to select an image...</span>
                    </label>
                    <input type="text" name="content" class="form-control col-10" placeholder="What do you think?" autocomplete="off" id = "posting-status" >
                    <input type="file" name="" id="inImg" class="d-none" onchange="selectImage(event)" >
                  </div>
                </div>
                <div class="mt-4 d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
          </div>
       <div id="discover">
       <?php if(!isset($data['discover'])) : ?>
             <?php require_once("discover.php");?>
        <?php endif?>
      </div>
      </div> 
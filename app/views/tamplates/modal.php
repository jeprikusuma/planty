  <!-- modal -->
  <!-- modal delete -->
  <?php foreach($data["posts"] as $post): ?>
  <div class="modal fade" id="delete-<?=$post["id"]?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure to <strong>delete</strong> this post ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a href="<?= BASEURL;?>/Home/deletePost/<?=$post["id"]?>"  class="btn btn-danger">Delete</a>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
  <!-- static modal - about -->
  <div class="modal fade" id="static-about" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">About</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <strong>Jepri media</strong> is a social media that is used to share text status with other users around the world. Users can also view the profiles of specific people and make friends with them.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Confirm</button>
        </div>
      </div>
    </div>
  </div>
  <!-- modal single action -->
  <div class="modal fade" id="single-logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure to logout as <strong><?= $data["user"]["name"];?></strong> ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a href="<?= BASEURL;?>/Auth/logout" class="btn btn-danger">Log out</a>
        </div>
      </div>
    </div>
  </div>

  <!-- modal input -->
  <div class="modal fade" id="input-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="<?=BASEURL;?>/Home/editProfile/" enctype="multipart/form-data">
            <!-- name input -->
            <div class="name-input form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" autocomplete="off" required value="<?= $data["user"]["name"];?>"/>
              <div class="invalid-feedback"> Please enter your name! </div>
            </div>
            <!-- email input -->
            <div class="email-input form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="example@example.com" autocomplete="off"
                 readonly value="<?= $data["user"]["email"];?>"/>
              <div class="invalid-feedback"> Please enter your email! </div>
            </div>
            <!-- gender input -->
             <div class="gender-input form-group">
              <label for="gender">Gender</label>
              <select class="form-control" id="gender" name="gender">
                <option <?= ($data["user"]["gender"] == "male")? "selected":"";?> value="male">Male</option>
                <option <?= ($data["user"]["gender"] == "famale")? "selected":"";?> value="famale">Famale</option>
              </select>
              <div class="invalid-feedback"> Please enter your email! </div>
            </div>
            <!-- password input -->
            <div class="form-row">
              <div class="password-input form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="<?= $data["user"]["password"];?>" required />
                <div class="invalid-feedback">
                  Please enter your password!
                </div>
              </div>
              <div class="confirm-password-input form-group col-md-6">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" class="form-control" id="confirm-password" name="confirm-password"value="<?= $data["user"]["password"];?>" required />
                <div class="invalid-feedback">
                  Please enter your password again!
                </div>
              </div>
            </div>
            <!-- profile -->
            <div class="form-group">
              <label for="profile">Profile image</label>
              <input type="file" class="form-control-file" id="profile" name="profile-photo">
            </div>
           <!-- banner -->
            <div class="form-group">
              <label for="banner">Banner image</label>
              <input type="file" class="form-control-file" id="banner" name="banner-photo">
            </div>
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
          <button type="submit" name="editprofile" class="btn btn-primary">Submit</button>
        </form>
        </div>
      </div>
    </div>
  </div>
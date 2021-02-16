
  <section class="auth">
    <div class="container d-flex p-0 p-lg-5 p-md-5 justify-content-center position-relative  overflow-hidden">
      <div
        class="d-flex row shadow col-12  p-5 bg-white rounded justify-content-center justify-content-lg-between align-items-center">
        <!-- Image Section -->
        <div class="col-12 col-md-10 col-lg-6 p-0 align-items-between justify-content-center d-none d-lg-block d-md-block">
          <div class="d-flex overflow-hidden justify-content-center">
            <img src="<?= BASEURL;?>/img/system/picture1.png" class="w-100 animate__animated animate__fadeIn animate" alt="" />
          </div>
          <div class="m-3 text-center text-secondary">
            <h5>Unlimited access to all features.</h5>
            <p>Planty is a completely free application, use it wherever and whenever you want without fear of being charged.</p>
          </div>
        </div>
        <!-- Form Section -->
        <div class="col-12 col-md-10 col-lg-5 p-0 mt-5 mt-lg-0">
        <?php Flasher::flash(); ?>
          <!-- Header -->
          <div class="text-primary mb-4">
            <h2 >Welcome <span id="name-user"></span></h2>
          </div>
          <!-- Form -->
          <form method="post">
            <!-- name input -->
            <div class="name-input form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" autocomplete="off" required />
              <div class="invalid-feedback"> Please enter your name! </div>
            </div>
            <!-- email input -->
            <div class="email-input form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="example@example.com" autocomplete="off"
                required />
              <div class="invalid-feedback"> Please enter your email! </div>
            </div>
            <!-- gender input -->
             <div class="gender-input form-group">
              <label for="gender">Gender</label>
              <select class="form-control" id="gender" name="gender">
                <option selected  value="male">Male</option>
                <option value="famale">Female</option>
              </select>
              <div class="invalid-feedback"> Please enter your email! </div>
            </div>
            <!-- password input -->
            <div class="form-row">
              <div class="password-input form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required />
                <div class="invalid-feedback">
                  Please enter your password!
                </div>
              </div>
              <div class="confirm-password-input form-group col-md-6">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" class="form-control" id="confirm-password" name="confirm-password" required />
                <div class="invalid-feedback">
                  Please enter your password again!
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck" required />
                <label class="form-check-label" for="gridCheck">
                  I have read and agree to the terms and conditions and accept
                  privacy policy.
                </label>
              </div>
            </div>
            <button type="submit" name="register" class="btn btn-primary">Register</button>
          </form>
          <p class="text-center mt-3 text-secondary">Already here? <a href="<?= BASEURL;?>/Auth/login">Login</a></p>
        </div>
      </div>
    </div>
    <div class="bg bg-top position-absolute d-none d-md-block d-lg-block">
      <img src="<?= BASEURL;?>/img/system/element.png" alt="">
    </div>
    <div class="bg bg-bot position-absolute d-none d-md-block d-lg-block">
      <img src="<?= BASEURL;?>/img/system/element.png" alt="">
    </div>
  </section>


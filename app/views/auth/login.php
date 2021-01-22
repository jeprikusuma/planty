
  <section class="auth">
    <div class="container d-flex p-0 p-lg-5 p-md-5 justify-content-center position-relative  overflow-hidden">
      <div
        class="d-flex row shadow col-12 p-5 bg-white rounded justify-content-center justify-content-lg-between align-items-center">
        <!-- Image Section -->
        <div class="col-12 col-md-10 col-lg-6 p-0 align-items-between justify-content-center d-none d-lg-block d-md-block">
          <div class="d-flex overflow-hidden justify-content-center">
            <img src="<?= BASEURL;?>/img/system/picture2.png" class="w-100 animate__animated animate__fadeIn animate" alt="" />
          </div>
          <div class="m-3 text-center text-secondary">
            <h5>Answer and ask whatever it is.</h5>
            <p>Let's learn and share experiences with other plant community members.</p>
          </div>
        </div>
        <!-- Form Section -->
        <div class="col-12 col-md-10 col-lg-5 p-0 mt-5 mt-lg-0">
        <?php Flasher::flash(); ?>
          <!-- Header -->
          <div class="text-primary mb-4">
            <h2>Welcome Back!</h2>
          </div>
          <!-- Form -->
          <form method="post">
            <!-- email input -->
            <div class="email-input form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="example@example.com" autocomplete="off"
                required />
              <div class="invalid-feedback"> Please enter your email! </div>
            </div>
            <!-- email input -->
            <div class="password-input form-group">
              <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required />
                <div class="invalid-feedback">
                  Please enter your password!
                </div>
            </div>
            <!-- Remember me -->
            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck" name="remember" />
                <label class="form-check-label" for="gridCheck">
                  Remember me?
                </label>
              </div>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
          </form>
          <p class="text-center mt-3 text-secondary">First time here? <a href="<?= BASEURL;?>/Auth/register">Register</a></p>
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


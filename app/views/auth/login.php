
  <section class="auth">
    <div class="container d-flex p-0 p-lg-5 p-md-5 justify-content-center position-relative  overflow-hidden">
      <div
        class="d-flex row shadow p-5 bg-white rounded justify-content-center justify-content-lg-between align-items-center">
        <!-- Image Section -->
        <div class="col-12 col-md-10 col-lg-6 p-0 align-items-between justify-content-center">
          <div class="d-flex overflow-hidden justify-content-center">
            <img src="<?= BASEURL;?>/img/system/register.png" class="w-100" alt="" />
          </div>
          <div class="m-3 text-center text-secondary">
            <h5>Play with your friends easly.</h5>
            <p>Jepri Media is a platform for connecting people around the world
              with one tap on your screen.</p>
          </div>
        </div>
        <!-- Form Section -->
        <div class="col-12 col-md-10 col-lg-5 p-0 mt-5 mt-lg-0">
        <?php Flasher::flash(); ?>
          <!-- Header -->
          <div class="text-primary">
            <h2>Welcome Back!</h2>
            <hr />
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
      <img src="<?= BASEURL;?>/img/system/bg.png" alt="">
    </div>
    <div class="bg bg-bot position-absolute d-none d-md-block d-lg-block">
      <img src="<?= BASEURL;?>/img/system//bg.png" alt="">
    </div>
  </section>


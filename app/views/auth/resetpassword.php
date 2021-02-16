
  <section class="auth">
    <div class="container d-flex p-0 p-lg-5 p-md-5 justify-content-center position-relative  overflow-hidden">
      <div
        class="d-flex row shadow col-12 p-5 bg-white rounded justify-content-center justify-content-lg-between align-items-center">
        <!-- Image Section -->
        <div class="col-12 col-md-10 col-lg-6 p-0 align-items-between justify-content-center d-none d-lg-block d-md-block">
          <div class="d-flex overflow-hidden justify-content-center">
            <img src="<?= BASEURL;?>/img/system/picture3.png" class="w-100 animate__animated animate__fadeIn animate" alt="" />
          </div>
          <div class="m-3 text-center text-secondary">
            <h5>One-time account verification.</h5>
            <p>Use your account to join Planty forever without the need for periodic verification.</p>
          </div>
        </div>
        <!-- Form Section -->
        <div class="col-12 col-md-10 col-lg-5 p-0 mt-5 mt-lg-0">
        <?php Flasher::flash(); ?>
          <!-- Header -->
          <div class="text-primary mb-4">
            <h2>Reset Password</h2>
          </div>
          <!-- Form -->
          <form method="post">
            <!-- password input -->
            <div class="password-input form-group">
              <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required />
                <div class="invalid-feedback">
                  Please enter your password!
                </div>
            </div>
            <!-- confirm input -->
            <div class="confirm-password-input form-group">
              <label for="confirm-password">Confirm Password</label>
                <input type="password" class="form-control" id="confirm-password" name="confirm-password" required />
                <div class="invalid-feedback">
                  Please enter your password again!
                </div>
            </div>
            <button type="submit" name="reset" class="btn btn-primary">Reset</button>
          </form>
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



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
          <!-- Header -->
          <div class="text-primary mb-4">
            <h2>Verify Your Account!</h2>
          </div>
          <!-- Main -->
          <div  style="margin-bottom: 10rem">
            <p>We have sent a verification email to your account. Please check your inbox or spam. If email is not sent click <a href="<?= BASEURL;?>/Auth/verify/<?= $data['id'];?>/resend">resend.</a></p>
          </div>
          <p class="text-center text-secondary">Create a new account? <a href="<?= BASEURL;?>/Auth/register">Register</a></p>
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


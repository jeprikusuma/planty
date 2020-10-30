    <!-- Main Content -->
    <div class="col-md-8 col-lg-8 col-12 container">
      <div class=" d-flex flex-column mt-4">
        <!-- user -->
        <div class="col-12 d-flex justify-content-between">
            <!-- all user -->
            <div class="col-6 bg-primary text-white shadow-sm  rounded d-flex flex-column p-3 justify-content-center align-items-center">
                  <h1><?= $data["main"]["allUsers"] ?></h1>
                  <h5>All User</h5>
            </div>
            <div class="col-6">
                <div class="col-12 bg-info text-white shadow-sm p-5 mb-3 flex-column shadow-sm rounded  d-flex justify-content-center align-items-center">
                  <h1><?= $data["main"]["usersMale"] ?></h1>
                  <h5>Male</h5>
                </div>
                <div class="col-12 bg-warning text-white shadow-sm p-5 flex-column rounded  d-flex justify-content-center align-items-center">
                  <h1><?= $data["main"]["usersFamale"] ?></h1>
                  <h5>Famale</h5>
                </div>
            </div>
        </div>
        <!-- post -->
        <div class="col-12 d-flex mt-3 mb-5 justify-content-between">
            <div class="col-6">
                <div class="col-12 bg-success text-white shadow-sm p-5 mb-3 flex-column rounded  d-flex justify-content-center align-items-center">
                  <h1><?= $data["main"]["postsToday"] ?></h1>
                  <h5>Today</h5>
                </div>
                <div class="col-12 bg-danger text-white shadow-sm p-5 flex-column rounded  d-flex justify-content-center align-items-center">
                  <h1><?= $data["main"]["postsSuspended"] ?></h1>
                  <h5>Suspended</h5>
                </div>
            </div>
          <div class="col-6 bg-secondary text-white shadow-sm rounded d-flex flex-column p-3 justify-content-center align-items-center">
                <h1><?= $data["main"]["allPosts"] ?></h1>
                <h5>All Post</h5>
          </div>
      </div>
        
      </div>
    </div>
  </main>

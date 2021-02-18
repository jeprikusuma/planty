        <div class="input-group mb-2 mb-md-3 mb-lg-3 mt-4 mt-lg-0 mt-md-0 order-1 chat-area-input d-md-flex d-lg-flex">
          <!-- Search user -->
          <input type="text" class="form-control" placeholder="Whose user do you want to chat with?" aria-describedby="basic-addon2" id="searchChatUserInput">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button" onclick="searchChatUser()"><i class="fas fa-search"></i></button>
          </div>
        </div>
         <!-- Setting area -->
         <div id="accordion" class="p-3 mt-4 mb-4 shadow-sm order-2 rounded chat-area-show d-md-block d-lg-block animate__animated animate__fadeIn" >
          <a id = "searchUserTitle" data-toggle="collapse" href="#onlineUsers" role="button" aria-expanded="false" aria-controls="onlineUsers" class="text-dark"><h4>Online Members</h4></a>
          <hr>
          <div id="onlineUsers" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <?php require_once('usersonline.php')?>
          </div>
          
      </div>
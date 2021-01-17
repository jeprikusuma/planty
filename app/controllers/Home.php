<?php

class Home extends Controller{
	public function index(){
		if(Session::role() != 'User'){
			header('Location:'.BASEURL.'/Auth/register');
		}
		// menyiapkan data user
		$data['user'] = $this->model('User_model')->findUser( $_SESSION["user"]);
		$data['posts'] = $this->model('Post_model')->postsIsSuspended(0);
		$data['trending'] = $this->model('Hastag_model')->trendingHastag();
		$data['header'] = 'Home';
		$data['nav'] = 'public';
		// view
		$this->view('tamplates/header', $data);
		$this->view('home/index', $data);
		$this->view('home/publicpost', $data);
		$this->view('tamplates/modal', $data);
		$this->view('tamplates/footer');
	}
	public function search($keyword = null){
		$_POST = json_decode(file_get_contents('php://input'), true);
		if(!isset($_POST['status'])){
			header('Location:'.BASEURL.'/Home');
		}
		if($keyword){
			$data["posts"] = $this->model('Post_model')->searchPosts($keyword);
			$data['search'] = ($keyword);
		}else{
			$data["posts"] = $this->model('Post_model')->postsIsSuspended(0);
		}

		$data['user'] = $this->model('User_model')->findUser( $_SESSION["user"]);

		if(isset($_POST['nav'])){
			$data['nav'] = $_POST['nav'];
			$this->view('home/discover', $data);
		}else{
			$this->view('home/status', $data);
		}		
	}
	
	public function hastag($hastag = null){
		$_POST = json_decode(file_get_contents('php://input'), true);
		if(!isset($_POST['hastag'])){
			header('Location:'.BASEURL.'/Home');
		}
		if($hastag){
			$hastagData = $this->model('Hastag_model')->hastagPosts($hastag);
			$hastagData = substr($hastagData["posts"], 1, -1);
			$hastagData=array_map('intval', explode(',', $hastagData));
			$hastagData = implode("','",$hastagData);

			$data["posts"]  = $this->model('Post_model')->multiPostsData($hastagData);
			$data['search'] = ('#'.$hastag);
		}else{
			$data["posts"] = $this->model('Post_model')->postsIsSuspended(0);
		}

		$data['user'] = $this->model('User_model')->findUser( $_SESSION["user"]);

		if(isset($_POST['nav'])){
			$data['nav'] = $_POST['nav'];
			$this->view('home/discover', $data);
		}else{
			$this->view('home/status', $data);
		}		
	}

	public function like(){
		$_POST = json_decode(file_get_contents('php://input'), true);
		if(!isset($_POST['status'])){
			header('Location:'.BASEURL.'/Home');
		}

		$user= $this->model('User_model')->findUser( $_SESSION["user"]);
		$this->model('Post_model')->postLike($_POST['like'], $user['id']);
		$data = $this->model('Post_model')->singlePost($_POST['like']);
		$data["user"] = $user;

		$this->view('home/statusmore', $data);
	}

	public function unlike(){
		$_POST = json_decode(file_get_contents('php://input'), true);
		if(!isset($_POST['status'])){
			header('Location:'.BASEURL.'/Home');
		}

		$user = $this->model('User_model')->findUser( $_SESSION["user"]);
		$this->model('Post_model')->postUnlike($_POST['like'], $user['id']);
		$data = $this->model('Post_model')->singlePost($_POST['like']);;

		$data["user"] = $user;
		$this->view('home/statusmore', $data);
	}

	public function commentArea(){
		$_POST = json_decode(file_get_contents('php://input'), true);
		if(!isset($_POST['status'])){
			header('Location:'.BASEURL.'/Home');
		}

		$data = $this->model('Post_model')->singlePost($_POST['post']);
		$data["user"] = $this->model('User_model')->findUser( $_SESSION["user"]);

		$this->view('home/comment', $data);	
	}

	public function commentPost(){
		$_POST = json_decode(file_get_contents('php://input'), true);
		if(!isset($_POST['status'])){
			header('Location:'.BASEURL.'/Home');
		}
		$user = $this->model('User_model')->findUser( $_SESSION["user"]);

		$data["name"] = $user["name"];
		$data["img"] = $user["profile"];
		$data["comment"] = $_POST["comment"];
		$this->model('Post_model')->postComment($_POST['post'], $data);

		$data = $this->model('Post_model')->singlePost($_POST['post']);
		$data["user"] = $user;


		$this->view('home/comment', $data);	
	}

	public function mypost(){
		$_POST = json_decode(file_get_contents('php://input'), true);

		$data['user'] = $this->model('User_model')->findUser( $_SESSION["user"]);
		$data["posts"] = $this->model('Post_model')->postById($data['user']["id"]);

		if(!isset($_POST['status'])){
			if(Session::role() != 'User'){
				header('Location:'.BASEURL.'/Auth/register');
			}
			// menyiapkan data user
			$data["nav"] = 'my';
			$data['header'] = 'Home';
			// view
			$this->view('tamplates/header', $data);
			$this->view('home/index', $data);
			$this->view('home/publicpost', $data);
			$this->view('tamplates/modal', $data);
			$this->view('tamplates/footer');
		}else{
			$data["nav"] = $_POST["nav"];
			// view
			$this->view('home/discover', $data);
		}
		
	}

	public function editProfile(){
		if(!isset($_POST["editprofile"])){
			header('Location:'.BASEURL.'/Home');
		}

		// perubahan user
		$user = $this->model('User_model')->findUser( $_SESSION["user"]);

		// cek perubahan penting
		// cek perubahan password
		if($_POST["password"] != $user["password"]){
			if($_POST["password"] == $_POST["confirm-password"]){
				$_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);
			}else{
				Flasher::setFlash('Password not match!', 'danger');
				header('Location:'.BASEURL.'/Home');
			}
		}		
		// cek & upload foto profil
		$profileUploaded = false;
		if($_FILES["profile-photo"]["name"] != ""){
			$profileUploaded = $this->upload($user["id"], $_FILES["profile-photo"], "img/users/profile/", "jpg|png|jpeg");
			if(!$profileUploaded){
				$uploadSucces = false;
				Flasher::setFlash('Error on upload. Check your file extention!', 'danger');
				header('Location:'.BASEURL.'/Home');
			}
		}

		// cek & upload foto baner
		$bannerUploaded = false;
		if($_FILES["banner-photo"]["name"] != ""){
			$bannerUploaded = $this->upload($user["id"], $_FILES["banner-photo"], "img/users/banner/", "jpg|png|jpeg");
			if(!$bannerUploaded){
				$uploadSucces = false;
				Flasher::setFlash('Error on upload. Check your file extention!', 'danger');
				header('Location:'.BASEURL.'/Home');
			}
		}
		
		// set data file
		// profile
		if($profileUploaded){
			$profileBefore = $user["profile"];
			if($profileBefore != "default-male.png" && $profileBefore != "default-famale.png"){
				unlink('img/users/profile/' . $profileBefore);
			}
		}else{
			$profileUploaded = $user["profile"];
		}
		$_POST["profile-photo"] = $profileUploaded;

		// banner
		if($bannerUploaded){
			$bannerBefore = $user["banner"];
			if($bannerBefore != "banner.png"){
				unlink('img/users/banner/' . $bannerBefore);
			}
		}else{
			$bannerUploaded = $user["banner"];
		}
		$_POST["banner-photo"] = $bannerUploaded;

		// update semua data
		$update = $this->model('User_model')->editUser($_POST);
		// redirect
		if($update > 0){
			// set ulang session
			$user = $this->model('User_model')->findUser( $_SESSION["user"]);
			Session::make($user["email"], $user["password"]);
			// redirect
			Flasher::setFlash('Update Successfully!', 'success');
			header('Location:'.BASEURL.'/Home');
		}else{
			// redirect
			Flasher::setFlash('Error on update!', 'danger');
			header('Location:'.BASEURL.'/Home');
		}

	}
	public function posting(){
		// data user
		$user = $this->model('User_model')->findUser( $_SESSION["user"]);;
		$_POST["file"] = NULL;

		if(isset($_FILES['file'])){
			if($_FILES['file']['size'] <= 3000000){
				$upload = $this->upload($user["id"], $_FILES["file"], "img/users/post/", "jpg|png|jpeg");
				if(!$upload){
					Flasher::setFlash('Error on upload. Check your file extention!', 'danger');
				}else{
					$_POST["file"] = $upload;
				}
			}else{
				Flasher::setFlash('Error on upload. Image larger than 3 MB!', 'danger');
			};
			
		}
		if(!isset($_POST["posting"])){
			header('Location:'.BASEURL.'/Home');
		}
		
		// validasi data
		if(!isset($_POST["content"])){
			Flasher::setFlash("Can't read content on post!", 'danger');
		}
	
		// menyiapkan hastag
		$hastag = explode(" ", $_POST["content"]);
		$getTag = [];
		$tagResult = [];
		$pattern = "/[_a-z0-9-]/i"; // untuk mengecek jika ada spesial karakter pada hastag

		foreach ($hastag as $tag) {
			$getTag = explode("#", $tag);
			if(count($getTag) > 1){
				unset($getTag[0]);
				foreach ($getTag as $key => $gt) {
					if(strlen($gt) > 20){
						$gt = substr($gt, 0, 20);
					}
					//cek hasil hastag
					for($i = 0; $i < strlen($gt); $i++) {
						if(!preg_match($pattern, $gt[$i])) {
							$gt = substr($gt, 0, $i);
						} 
					} 
					//hastag sudah siap
					$getTag[$key] = $gt;
					// jika kosong
					if(strlen($getTag[$key]) < 1){
						unset($getTag[$key]);
					}
				}


				$tagResult = array_merge($tagResult, $getTag);
			}
		}
		
		//tambah link pada status/post yang dikirim
		foreach ($tagResult as $rest) {
			$_POST["content"] = str_replace('#'.$rest, "<a href='".BASEURL."/Home/hastag/$rest' class = 'hastag'>#$rest</a>", $_POST["content"]);
		}
		
		
		// menyiapkan data
		$user = $this->model('User_model')->findUser( $_SESSION["user"]);
		$_POST["user"] = $user["id"];
		// insert posts
		$insert = $this->model('Post_model')->postingPost($_POST);
		$insert = intval($insert["LAST_INSERT_ID()"]);

		// redirect
		if($insert > 0){
			// insert insert hastag
			foreach ($tagResult as $hastag) {
				$check = $this->model('Hastag_model')->checkHastag($hastag);
				if($check){
					// cek hari
					date_default_timezone_set("Asia/Singapore");
					$target= date_create($check["lastUpdate"]);
					$origin = date_create('now');
					$interval = date_diff($origin, $target);
					$interval = (int)$interval->format('%a');

					if($interval > 0){
						$this->model('Hastag_model')->updateHastagPopularity($check["id"], $insert);
					}else{
						$this->model('Hastag_model')->updateHastag($check["id"], $insert);
					}
				}else{
					$this->model('Hastag_model')->newHastag($hastag, $insert);
				}
			}
			Flasher::setFlash('Your post has been published!', 'success');
		}else{
			// redirect
			Flasher::setFlash('Error on post!', 'danger');
		}

		$data['user'] = $user;
		$data["posts"] = $this->model('Post_model')->postsIsSuspended(0);
		$data["nav"] = "public";
		$this->view('home/discover', $data);
	}

	public function deletePost($id){
		$_POST = json_decode(file_get_contents('php://input'), true);
		if(Session::role() != 'User' ||!isset( $_POST["delete"])){
			header('Location:'.BASEURL.'/Auth/register');
		}
		// memvalidasi data
		$post = $this->model('Post_model')->postData($id);
		$user = $this->model('User_model')->findUser( $_SESSION["user"]);

		if($post['user'] != $user['id']){
			header('Location:'.BASEURL.'/Auth/register');
		}

		// delete file
		if($post['file'] != NULL){
			unlink('img/users/post/' . $post['file'] );
		}

		// delete hastag post terlebih dahulu
		$this->model('Hastag_model')->deleteHastagPost($id);
		$this->model('Hastag_model')->deleteEmptyHastag();
		// delete post
		if($this->model('Post_model')->deletePost($id) > 0 ){
			Flasher::setFlash('Post has been deleted!', 'success');
		}else{
			Flasher::setFlash('Error on deleting post!', 'danger');
		}

		$data['user'] = $this->model('User_model')->findUser( $_SESSION["user"]);
		$data["posts"] = $this->model('Post_model')->postById($data['user']["id"]);
		$data["nav"] = "my";
		$this->view('home/status', $data);
	}

	private function upload($id, $file, $toDir, $format){
		$name = time().$id;
		$temp = $file['tmp_name'];

		// mendapatkan file format
		$fileFormat = explode('/', $file["type"]);
		$fileFormat = $fileFormat[1];

		// mengecek dengan ketentuan
		$format = explode('|', $format);

		if(in_array($fileFormat, $format)){
			// upload file
			$name = $name.'.'.$fileFormat;
			$fileUploaded = move_uploaded_file($temp, $toDir.$name);
			return $name;
		}else{
			return false;
		}		
	}
}
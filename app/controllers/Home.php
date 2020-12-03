<?php

class Home extends Controller{
	public function index(){
		if(Session::role() != 'User'){
			header('Location:'.BASEURL.'/Auth/register');
		}
		// menyiapkan data user
		$data['user'] = $this->model('User_model')->findUser( $_SESSION["user"]);
		$data["posts"] = $this->model('Post_model')->postsIsSuspended(0);
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

		if(isset($_POST['nav'])){
			$data['nav'] = $_POST['nav'];
			$this->view('home/discover', $data);
		}else{
			$this->view('home/status', $data);
		}		
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
		$_POST = json_decode(file_get_contents('php://input'), true);

		if(!isset($_POST["posting"])){
			header('Location:'.BASEURL.'/Home');
		}

		// validasi data
		if(!isset($_POST["content"])){
			Flasher::setFlash("Can't read content on post!", 'danger');
		}

		// menyiapkan data
		$user = $this->model('User_model')->findUser( $_SESSION["user"]);
		$_POST["user"] = $user["id"];
		
		// insert data
		$insert = $this->model('Post_model')->postingPost($_POST);
		// redirect
		if($insert > 0){
			Flasher::setFlash('Your post has been published!', 'success');
		}else{
			// redirect
			Flasher::setFlash('Error on post!', 'danger');
		}

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
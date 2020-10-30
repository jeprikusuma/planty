<?php

class Home extends Controller{
	public function index(){
		if(Session::role() != 'User'){
			header('Location:'.BASEURL.'/Auth/register');
		}
		// menyiapkan data user
		$data['user'] = $this->model('User_model')->findUser( $_SESSION["user"]);

		// jika search post
		if(isset($_POST["search"])){
			$data["posts"] = $this->model('Post_model')->searchPosts($_POST["search"]);
			$data['search'] = $_POST["search"];
		}else{
			$data["posts"] = $this->model('Post_model')->postsIsSuspended(0);
		}
		
		$data['header'] = 'Home';
		// view
		$this->view('tamplates/header', $data);
		$this->view('home/index', $data);
		$this->view('home/publicpost', $data);
		$this->view('tamplates/modal', $data);
		$this->view('tamplates/footer');
	}

	public function mypost(){
		if(Session::role() != 'User'){
			header('Location:'.BASEURL.'/Auth/register');
		}
		// menyiapkan data user
		$data['user'] = $this->model('User_model')->findUser( $_SESSION["user"]);
		$data["posts"] = $this->model('Post_model')->postById($data['user']["id"]);
		$data['header'] = 'Home';
		// view
		$this->view('tamplates/header', $data);
		$this->view('home/index', $data);
		$this->view('home/mypost', $data);
		$this->view('tamplates/modal', $data);
		$this->view('tamplates/footer');
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
		if(!isset($_POST["posting"])){
			header('Location:'.BASEURL.'/Home');
		}

		// validasi data
		if(!isset($_POST["content"])){
			Flasher::setFlash('Error on post!', 'danger');
			header('Location:'.BASEURL.'/Home');
		}

		// menyiapkan data
		$user = $this->model('User_model')->findUser( $_SESSION["user"]);
		$_POST["user"] = $user["id"];
		
		// insert data
		$insert = $this->model('Post_model')->postingPost($_POST);
		// redirect
		if($insert > 0){
			Flasher::setFlash('Your post has been published!', 'success');
			header('Location:'.BASEURL.'/Home');
		}else{
			// redirect
			Flasher::setFlash('Error on post!', 'danger');
			header('Location:'.BASEURL.'/Home');
		}
	}

	public function deletePost($id){
		if(Session::role() != 'User'){
			header('Location:'.BASEURL.'/Auth/register');
		}
		// memvalidasi data
		$post = $this->model('Post_model')->postData($id);
		$user = $this->model('User_model')->findUser( $_SESSION["user"]);

		if($post['user'] != $user['id']){
			header('Location:'.BASEURL.'/Home');
		}

		if($this->model('Post_model')->deletePost($id) > 0 ){
			Flasher::setFlash('Post has been deleted!', 'success');
			header('Location:'.BASEURL.'/Home/mypost');
		}else{
			Flasher::setFlash('Error on deleting post!', 'danger');
			header('Location:'.BASEURL.'/Home/mypost');
		}
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
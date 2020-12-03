<?php

class Admin extends Controller{

	public function index(){
        $_POST = json_decode(file_get_contents('php://input'), true);
		if(Session::role() != 'Admin'){
			header('Location:'.BASEURL.'/Auth/register');
		}
		// menyiapkan data user
        $data['user'] = $this->model('User_model')->findUser( $_SESSION["user"]);

        // data main user
        $data['main'] = $this->model('User_model')->CountAllUsers();
        $data['main'] += $this->model('User_model')->CountUsersByGender('Male');
        $data['main'] += $this->model('User_model')->CountUsersByGender('Famale');

        // data main posts
        $data['main'] += $this->model('Post_model')->CountAllPosts();
        $data['main'] += $this->model('Post_model')->CountPostsSuspended('Male');
        $data['main'] += $this->model('Post_model')->CountPostsToday('Famale');

        	
		$data['header'] = 'Admin';
		// view
		if(!isset($_POST['aside'])){
            $this->view('tamplates/header', $data);
            $this->view('admin/aside', $data);
            $this->view('tamplates/modal', $data);
            $this->view('tamplates/footer');
        }else{
            $this->view('admin/index', $data);
        }
    }

    public function users($pages = ""){
        $_POST = json_decode(file_get_contents('php://input'), true);
        if(Session::role() != 'Admin'){
			header('Location:'.BASEURL.'/Auth/register');
        }
        if(!isset($_POST['aside'])){
            header('Location:'.BASEURL.'/Admin');
        }
        // menyiapkan data post sesuai yang dipilih
        switch ($pages) {
            case 'nonActive':
                $data['main'] = $this->model('User_model')->usersNonActive();
                $data["nav"] = "nonActive";
                $this->view('admin/users-discover', $data);
                return;
                break;

            case 'active':
                $data['main'] = $this->model('User_model')->usersActive();
                 $data["nav"] = "active";
                 $this->view('admin/users-discover', $data);
                 return;
                 break;

            default:
                $data['main'] = $this->model('User_model')->allUsers();
                $data["nav"] = "def";
                break;
        }
        
        // search post
        if(isset($_POST["search"])){
			$data["main"] = $this->model('User_model')->searchUsers($_POST["search"]);
            $data['search'] = $_POST["search"];
            $data["nav"] = "def";
            $this->view('admin/users-discover', $data);
        }else if(isset($_POST["nav"])){
            $this->view('admin/users-discover', $data);
        }else{
            $this->view('admin/users', $data);
        }
                
    }

    public function posts($pages = "all"){
        $_POST = json_decode(file_get_contents('php://input'), true);
        if(Session::role() != 'Admin'){
			header('Location:'.BASEURL.'/Auth/register');
        }
		if(!isset($_POST['aside'])){
            header('Location:'.BASEURL.'/Admin');
        }
        // menyiapkan data post sesuai yang dipilih
        switch ($pages) {
            case 'sus':
                $data['main'] = $this->model('Post_model')->postsIsSuspended(1);
                $data["nav"] = "sus";
                $this->view('admin/posts-discover', $data);
                return;
                break;

            default:
                $data['main'] = $this->model('Post_model')->allPosts();
                $data["nav"] = "def";
                break;
        }

        // menyiapkan data user
        $data['user'] = $this->model('User_model')->findUser( $_SESSION["user"]);
        // search post
        if(isset($_POST["search"])){
			$data["main"] = $this->model('Post_model')->searchPostsAll($_POST["search"]);
            $data['search'] = $_POST["search"];
            $data["nav"] = "def";
            $this->view('admin/posts-discover', $data);
		}else if(isset($_POST["nav"])){
            $this->view('admin/posts-discover', $data);
        }else{
            $this->view('admin/posts', $data);
        }
    }

    public function deletePost($id){
		$_POST = json_decode(file_get_contents('php://input'), true);

        if(Session::role() != 'Admin'){
			header('Location:'.BASEURL.'/Admin');
        }
        if(!isset($_POST['aside'])){
            header('Location:'.BASEURL.'/Admin');
        }

		if($this->model('Post_model')->deletePost($id) > 0 ){
			Flasher::setFlash('Data has been updated!', 'success');
		}else{
			Flasher::setFlash('Error on update data!', 'danger');
        }
        switch ($_POST["navPosts"]){
            case 'sus':
                $data['main'] = $this->model('Post_model')->postsIsSuspended(1);
                break;

            default:
                $data['main'] = $this->model('Post_model')->allPosts();
                break;
        }

        $data["nav"] = $_POST["navPosts"];
        $this->view('admin/posts-result', $data);
    }
    
    public function setSuspend($id, $set){
        $_POST = json_decode(file_get_contents('php://input'), true);

        if(Session::role() != 'Admin'){
			header('Location:'.BASEURL.'/Admin');
        }
        if(!isset($_POST['aside'])){
            header('Location:'.BASEURL.'/Admin');
        }
        switch ($set) {
            case "sus":
                if($this->model('User_model')->suspend((int)$id)> 0 ){
                    Flasher::setFlash('Data has been updated!', 'success');
                }else{
                    Flasher::setFlash('Error on update data!', 'danger');
                }
                break;
            
            default:
                if($this->model('User_model')->unsuspend((int)$id)> 0 ){
                    Flasher::setFlash('Data has been updated!', 'success');
                }else{
                    Flasher::setFlash('Error on update data!', 'danger');
                }
                break;
        }

        switch ($_POST["nav"]) {
            case 'nonActive':
                $data['main'] = $this->model('User_model')->usersNonActive();
                break;

            case 'active':
                $data['main'] = $this->model('User_model')->usersActive();
                 break;

            default:
                $data['main'] = $this->model('User_model')->allUsers();
                break;
        }
        $data["nav"] = $_POST["nav"];
        $this->view('admin/users-result', $data);
    }

    public function setSuspendPost($id, $set){
        $_POST = json_decode(file_get_contents('php://input'), true);

        if(Session::role() != 'Admin'){
			header('Location:'.BASEURL.'/Admin');
        }
        if(!isset($_POST['aside'])){
            header('Location:'.BASEURL.'/Admin');
        }
        
        switch ($set) {
            case "sus":
                if($this->model('Post_model')->suspend((int)$id)> 0 ){
                    Flasher::setFlash('Data has been updated!', 'success');
                }else{
                    Flasher::setFlash('Error on update data!', 'danger');
                }
                break;
            
            default:
                if($this->model('Post_model')->unsuspend((int)$id)> 0 ){
                    Flasher::setFlash('Data has been updated!', 'success');
                }else{
                    Flasher::setFlash('Error on update data!', 'danger');
                }
                break;
        }

        switch ($_POST["navPosts"]){
            case 'sus':
                $data['main'] = $this->model('Post_model')->postsIsSuspended(1);
                break;

            default:
                $data['main'] = $this->model('Post_model')->allPosts();
                break;
        }

        $data["nav"] = $_POST["navPosts"];
        $this->view('admin/posts-result', $data);
    }

    public function deleteUser($id){
        $_POST = json_decode(file_get_contents('php://input'), true);

        if(Session::role() != 'Admin'){
			header('Location:'.BASEURL.'/Admin');
        }
        if(!isset($_POST['aside'])){
            header('Location:'.BASEURL.'/Admin');
        }

        $this->model('Post_model')->deletePostByUser((int)$id);
        
        if($this->model('User_model')->deleteUser((int)$id)> 0 ){
            Flasher::setFlash('Data has been updated!', 'success');
        }else{
            Flasher::setFlash('Error on update data!', 'danger');
        }

        switch ($_POST["nav"]) {
            case 'nonActive':
                $data['main'] = $this->model('User_model')->usersNonActive();
                break;

            case 'active':
                $data['main'] = $this->model('User_model')->usersActive();
                 break;

            default:
                $data['main'] = $this->model('User_model')->allUsers();
                break;
        }
        $data["nav"] = $_POST["nav"];
        $this->view('admin/users-result', $data);
    }
}
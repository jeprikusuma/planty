<?php

class Admin extends Controller{

	public function index(){
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
		$this->view('tamplates/header', $data);
		$this->view('admin/aside', $data);
		$this->view('admin/index', $data);
		$this->view('tamplates/modal', $data);
		$this->view('tamplates/footer');
    }

    public function users($pages = ""){
        if(Session::role() != 'Admin'){
			header('Location:'.BASEURL.'/Auth/register');
		}
        // menyiapkan data post sesuai yang dipilih
        switch ($pages) {
            case 'nonActive':
                $data['main'] = $this->model('User_model')->usersNonActive();
                $data["nav"] = "nonActive";
                break;

            case 'active':
                $data['main'] = $this->model('User_model')->usersActive();
                 $data["nav"] = "active";
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
        }
        
        // menyiapkan data user
        $data['user'] = $this->model('User_model')->findUser( $_SESSION["user"]);
        $data['header'] = 'Users';
        // view
		$this->view('tamplates/header', $data);
		$this->view('admin/aside', $data);
		$this->view('admin/users', $data);
		$this->view('tamplates/modal', $data);
		$this->view('tamplates/footer');
    }

    public function posts($pages = "all"){
        if(Session::role() != 'Admin'){
			header('Location:'.BASEURL.'/Auth/register');
        }
        
        // menyiapkan data post sesuai yang dipilih
        switch ($pages) {
            case 'sus':
                $data['main'] = $this->model('Post_model')->postsIsSuspended(1);
                $data["nav"] = "sus";
                break;

            default:
            $data['main'] = $this->model('Post_model')->allPosts();
                $data["nav"] = "def";
                break;
        }

        // search post
        if(isset($_POST["search"])){
			$data["main"] = $this->model('Post_model')->searchPostsAll($_POST["search"]);
			$data['search'] = $_POST["search"];
		}

        // menyiapkan data user

        $data['user'] = $this->model('User_model')->findUser( $_SESSION["user"]);
        $data['header'] = 'Posts';
        // view
		$this->view('tamplates/header', $data);
		$this->view('admin/aside', $data);
		$this->view('admin/posts', $data);
		$this->view('tamplates/modal', $data);
		$this->view('tamplates/footer');
    }

    public function deletePost($id){
		if(Session::role() != 'Admin'){
			header('Location:'.BASEURL.'/Auth/register');
		}

		if($this->model('Post_model')->deletePost($id) > 0 ){
			Flasher::setFlash('Data has been updated!', 'success');
			header('Location:'.BASEURL.'/Admin/posts');
		}else{
			Flasher::setFlash('Error on update data!', 'danger');
			header('Location:'.BASEURL.'/Admin/posts');
		}
    }
    
    public function setSuspend($id, $set){
        if(Session::role() != 'Admin'){
			header('Location:'.BASEURL.'/Auth/register');
        }
        
        switch ($set) {
            case "sus":
                if($this->model('User_model')->suspend((int)$id)> 0 ){
                    Flasher::setFlash('Data has been updated!', 'success');
                    header('Location:'.BASEURL.'/Admin/users');
                }else{
                    Flasher::setFlash('Error on update data!', 'danger');
                    header('Location:'.BASEURL.'/Admin/users');
                }
                break;
            
            default:
                if($this->model('User_model')->unsuspend((int)$id)> 0 ){
                    Flasher::setFlash('Data has been updated!', 'success');
                    header('Location:'.BASEURL.'/Admin/users');
                }else{
                    Flasher::setFlash('Error on update data!', 'danger');
                    header('Location:'.BASEURL.'/Admin/users');
                }
                break;
        }
    }

    public function setSuspendPost($id, $set){
        if(Session::role() != 'Admin'){
			header('Location:'.BASEURL.'/Auth/register');
        }
        
        switch ($set) {
            case "sus":
                if($this->model('Post_model')->suspend((int)$id)> 0 ){
                    Flasher::setFlash('Data has been updated!', 'success');
                    header('Location:'.BASEURL.'/Admin/posts');
                }else{
                    Flasher::setFlash('Error on update data!', 'danger');
                    header('Location:'.BASEURL.'/Admin/posts');
                }
                break;
            
            default:
                if($this->model('Post_model')->unsuspend((int)$id)> 0 ){
                    Flasher::setFlash('Data has been updated!', 'success');
                    header('Location:'.BASEURL.'/Admin/posts');
                }else{
                    Flasher::setFlash('Error on update data!', 'danger');
                    header('Location:'.BASEURL.'/Admin/posts');
                }
                break;
        }
    }

    public function deleteUser($id){
        if(Session::role() != 'Admin'){
			header('Location:'.BASEURL.'/Auth/register');
        }

        $this->model('Post_model')->deletePostByUser((int)$id);
        
        if($this->model('User_model')->deleteUser((int)$id)> 0 ){
            Flasher::setFlash('Data has been updated!', 'success');
            header('Location:'.BASEURL.'/Admin/users');
        }else{
            Flasher::setFlash('Error on update data!', 'danger');
            header('Location:'.BASEURL.'/Admin/users');
        }
    }
}
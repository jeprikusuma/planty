<?php

class Report extends Controller{
	public function send(){
        $_POST = json_decode(file_get_contents('php://input'), true);
		if(Session::role() != 'User'){
			header('Location:'.BASEURL.'/Auth/register');
		}
		$user= $this->model('User_model')->findUser( $_SESSION["user"]);
       
        $this->model('Report_model')->sendReport($_POST['des'], $user['id']);
	}

	public function reportPost($id){
        $_POST = json_decode(file_get_contents('php://input'), true);
		if(Session::role() != 'User'){
			header('Location:'.BASEURL.'/Auth/register');
		}
		
		$user= $this->model('User_model')->findUser( $_SESSION["user"]);
       
        $this->model('Report_model')->sendReportPost($_POST['des'], $user['id'], $id);
	}
	
	public function reportUser($id){
        $_POST = json_decode(file_get_contents('php://input'), true);
		if(Session::role() != 'User'){
			header('Location:'.BASEURL.'/Auth/register');
		}
		
		$user= $this->model('User_model')->findUser( $_SESSION["user"]);
       
        $this->model('Report_model')->sendReportUser($_POST['des'], $user['id'], $id);
	}

	public function show($pages = ""){
        $_POST = json_decode(file_get_contents('php://input'), true);
        if(Session::role() != 'Admin'){
			header('Location:'.BASEURL.'/Auth/register');
        }
		if(!isset($_POST['aside'])){
            header('Location:'.BASEURL.'/Admin');
        }
        // menyiapkan data post sesuai yang dipilih
        switch ($pages) {
            case 'user':
                $data['main'] = $this->model('Report_model')->showReportUser();
				for($i = 0; $i < count($data['main']); $i++){
					$data['main'][$i]['forUser'] = $this->model('User_model')->findUserById($data['main'][$i]['toUser']); 
				}
                $data["nav"] = "user";
                $this->view('admin/report-discover', $data);
                return;
                break;
            case 'post':
                $data['main'] = $this->model('Report_model')->showReportPost();
				for($i = 0; $i < count($data['main']); $i++){
					$data['main'][$i]['forPost'] = $this->model('Post_model')->singlePost($data['main'][$i]['toPost']); 
				}
                $data["nav"] = "post";
                $this->view('admin/report-discover', $data);
                return;
                break;
			case 'system':
                $data['main'] = $this->model('Report_model')->showReportSystem();
                $data["nav"] = "system";
                $this->view('admin/report-discover', $data);
                return;
                break;    
            default:
                $data['main'] = $this->model('Report_model')->showReportSystem();
                $data["nav"] = "system";
                break;
        }

        // search post
		
        $this->view('admin/report', $data);
    }
}
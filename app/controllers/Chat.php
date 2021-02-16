<?php

class Chat extends Controller{
	public function index(){
        $_POST = json_decode(file_get_contents('php://input'), true);
		if(Session::role() != 'User'){
			header('Location:'.BASEURL.'/Auth/register');
		}		
       
        $this->view('chat/index');
	}

    public function aside(){
        $_POST = json_decode(file_get_contents('php://input'), true);
		if(Session::role() != 'User'){
			header('Location:'.BASEURL.'/Auth/register');
		}		
       
        $this->view('chat/aside');
    }

	public function updateOnline(){
		$_POST = json_decode(file_get_contents('php://input'), true);

		if(Session::role() != 'User' || !isset( $_POST["setOnline"])){
			header('Location:'.BASEURL.'/Auth/register');
		}
		

		$this->model('User_model')->setOnline($_SESSION['user']);	
	}
	
	public function getOnlineUsers(){
		$_POST = json_decode(file_get_contents('php://input'), true);

		if(Session::role() != 'User' || !isset( $_POST["getOnline"])){
			header('Location:'.BASEURL.'/Auth/register');
		}
		
		$data['usersOnline'] = $this->model('User_model')->onlineUsers($_SESSION['user']);
		$this->view('chat/usersOnline', $data);	
	}

	public function searchUser(){
		$_POST = json_decode(file_get_contents('php://input'), true);

		if(Session::role() != 'User' || !isset( $_POST["search"])){
			header('Location:'.BASEURL.'/Auth/register');
		}
		
		$data['usersOnline'] = $this->model('User_model')->searchUsers($_POST['keyword']);
		$this->view('chat/usersOnline', $data);	
	}

	public function getChat(){
		if(Session::role() != 'User'){
			header('Location:'.BASEURL.'/Auth/register');
		}

		$user = $this->model('User_model')->findUser($_SESSION['user']);
		$data['chats'] = $this->model('Chat_model')->chat($user['id']);
		$this->view('chat/chats', $data);	
	}

	public function chatCount(){
		$_POST = json_decode(file_get_contents('php://input'), true);

		if(Session::role() != 'User' || !isset( $_POST["chatCount"])){
			header('Location:'.BASEURL.'/Auth/register');
		}

		echo($this->model('Chat_model')->chatCount($_SESSION["user"])['count']);	
	}

	public function toPersonalChat(){
		$_POST = json_decode(file_get_contents('php://input'), true);

		if(Session::role() != 'User'|| !isset( $_POST["personalChat"])){
			header('Location:'.BASEURL.'/Auth/register');
		}

		

		$data['userChat'] =  $this->model('User_model')->findUserById($_POST['user']);	
		$data['chat'] = $this->model('Chat_model')->personalChat($_POST['id']);
		$data['personalChat'] = $data['chat']['chats'];	
		
		$this->view('chat/personalchat', $data);
	}

	public function getPersonalChat(){
		$_POST = json_decode(file_get_contents('php://input'), true);

		if(Session::role() != 'User'|| !isset( $_POST["personalChat"])){
			header('Location:'.BASEURL.'/Auth/register');
		}

		$chat = $this->model('Chat_model')->personalChat($_POST['id']);
		$data['personalChat'] = $chat['chats'];

		if($chat['lastFor'] == $_SESSION['user']){
			$this->model('Chat_model')->unsetLastFor($_POST['id']);
		}
		
		$this->view('chat/personalchats', $data);
	}

	public function sendChat(){
		$_POST = json_decode(file_get_contents('php://input'), true);

		if(Session::role() != 'User'|| !isset( $_POST["sendChat"])){
			header('Location:'.BASEURL.'/Auth/register');
		}

		$user1 = $this->model('User_model')->findUserById($_POST['user1']);
		$user2 = $this->model('User_model')->findUserById($_POST['user2']);

		$sender = $user1['email'] == $_SESSION['user'] ? $user1 : $user2;
		$receiver = $user1['email'] == $_SESSION['user'] ? $user2 : $user1;

		$chatData['from'] = $sender['email'];
		$chatData['to'] = $receiver['email'];
		$chatData['value'] = $_POST['value'];
		
		$this->model('Chat_model')->sendChat($_POST['id'], $chatData);
	}

	public function makeRoomChat(){
		$_POST = json_decode(file_get_contents('php://input'), true);

		if(Session::role() != 'User'|| !isset( $_POST["makeRoomChat"])){
			header('Location:'.BASEURL.'/Auth/register');
		}

		$user = $this->model('User_model')->findUser($_SESSION['user']);

		$isRoomAlready = $this->model('Chat_model')->checkRoom($user['id'], $_POST['toUser']);

		if($isRoomAlready){
			if($isRoomAlready['lastFor'] == $_SESSION['user']){
				$this->model('Chat_model')->unsetLastFor($_POST['id']);
			}

			$data['chat'] = $isRoomAlready;
			$data['personalChat'] = $data['chat']['chats'];	
		}else{
			$makeRoom = $this->model('Chat_model')->makeRoom($user['id'], $_POST['toUser'])['id'];
			
			$newRoom = $this->model('Chat_model')->personalChat($makeRoom);
			$data['chat'] = $newRoom;
			$data['personalChat'] = $data['chat']['chats'];	
		}
		
		$data['userChat'] =  $this->model('User_model')->findUserById($_POST['toUser']);	
		
		
		$this->view('chat/personalchat', $data);
	}

	public function deleteChat($id){
		if(Session::role() != 'User'){
			header('Location:'.BASEURL.'/Auth/register');
		}

		$user = $this->model('User_model')->findUser($_SESSION['user']);
		$delete = $this->model('Chat_model')->deleteChat($id, $user['id']);

		if(!$delete){
			$this->model('Chat_model')->deleteChatPermanent($id, $user['id']);;
		}

		Flasher::setFlash('Chat deleted successfully!', 'success');
		
	}

}
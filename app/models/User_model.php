<?php 

class User_model{
	private $table = "users";
	private $tableRole = "users-roles";
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function findUser($user){
		$this->db->query('SELECT * FROM '.$this->table.' WHERE email=:email');
		 $this->db->bind('email', $user);
		 
 		return $this->db->single();
	}

	public function findUserById($id){
		$this->db->query('SELECT * FROM '.$this->table.' WHERE id=:id');
		 $this->db->bind('id', $id);
		 
 		return $this->db->single();
	}

	public function searchUsers($keyword){
		$this->db->query("SELECT * FROM ".$this->table." WHERE (name LIKE CONCAT('%', :keyword , '%'))");
		 $this->db->bind('keyword', $keyword);
		 
 		return $this->db->resultSet();
	}

	public function allUsers(){
		$this->db->query('SELECT * FROM '.$this->table);
 		
 		return $this->db->resultSet();
	}

	public function usersActive(){
		$this->db->query('SELECT * FROM '.$this->table.' WHERE isActive=:active');
		$this->db->bind('active', 1);
 		
 		return $this->db->resultSet();
	}

	public function usersNonActive(){
		$this->db->query('SELECT * FROM '.$this->table.' WHERE isActive=:active');
		$this->db->bind('active', 0);
 		
 		return $this->db->resultSet();
	}

	public function registerUser($post){
		$query = "INSERT INTO ".$this->table. 
					" (name, email, password, gender, profile, banner, role, isActive, verify, online)
					VALUES(
						:name, :email, :password, :gender, :profile, :banner, 'USR', :active, :verify, NULL)";

		$this->db->query($query);
		$this->db->bind('name', $post['name']);
		$this->db->bind('email', $post['email']);
		$this->db->bind('password', $post['password']);
		$this->db->bind('gender', $post['gender']);
		$this->db->bind('profile', $post['profile']);
		$this->db->bind('banner', $post['banner']);
		$this->db->bind('active', 1);
		$this->db->bind('verify', bin2hex(random_bytes(16)));
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function verifyUser($id, $code){
		$query = "UPDATE " .$this->table."
				SET verify = NULL
				WHERE id = :id AND verify = :code;";
				
		$this->db->query($query);
		$this->db->bind('id', $id);
		$this->db->bind('code', $code);
		$this->db->execute();

		return $this->db->rowCount();
	}
	
	public function editUser($post){
		$query = "UPDATE ".$this->table."
					SET name = :name, gender = :gender, profile = :profile, banner = :banner
					WHERE email = :email;";

		$this->db->query($query);
		$this->db->bind('name', $post['name']);
		$this->db->bind('email', $post['email']);
		$this->db->bind('gender', $post['gender']);
		$this->db->bind('profile', $post['profile-photo']);
		$this->db->bind('banner', $post['banner-photo']);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function resetPassword($post){
		$query = "UPDATE ".$this->table."
					SET password = :password
					WHERE email = :email;";

		$this->db->query($query);
		$this->db->bind('email', $post['email']);
		$this->db->bind('password', $post['password']);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function getRole($user){
		$query = "SELECT `". $this->tableRole ."`.role as role
					FROM `". $this->table ."`
					INNER JOIN `". $this->tableRole ."`
					ON ". $this->table .".role=`". $this->tableRole ."`.id
					WHERE email=:email;";
		$this->db->query($query);
		$this->db->bind('email', $user);

		return $this->db->single();
	}

	public function CountAllUsers(){
		$this->db->query('SELECT COUNT(*) AS allUsers FROM '.$this->table);

 		return $this->db->single();
	}

	public function CountUsersByGender($gender){
		$this->db->query('SELECT COUNT(*) AS users'.$gender.' FROM '.$this->table.' WHERE gender=:gender');
		$this->db->bind('gender', $gender);

 		return $this->db->single();
	}

	public function suspend($id){
		$query = "UPDATE ".$this->table."
					SET isActive = 0
					WHERE id =:id;";
		$this->db->query($query);
		$this->db->bind('id', $id);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function unsuspend($id){
		$query = "UPDATE ".$this->table."
					SET isActive = 1
					WHERE id =:id;";
		$this->db->query($query);
		$this->db->bind('id', $id);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function deleteUser($id){
        $query = "DELETE FROM ". $this->table." WHERE id= :id";

        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        
        return $this->db->rowCount();
    }
	
	public function setOnline($user){
		$query = "UPDATE ".$this->table."
		SET online = :online
		WHERE email = :user";
				 
		date_default_timezone_set("Asia/Singapore");
		$this->db->query($query);
		$this->db->bind('user', $user);
		$this->db->bind('online', date('Y/m/d H:i:s'));
		$this->db->execute();
	}

	public function onlineUsers($user){
		$query = "SELECT id, name, email, profile FROM ".$this->table." 
		WHERE online BETWEEN :mintolerance AND :maxtolerance AND name != 'Admin'
		ORDER BY FIELD(email, :user) DESC;";
				 
		date_default_timezone_set("Asia/Singapore");
		$maxtolerance = date("Y-m-d H:i:s");
		$timestamp = strtotime($maxtolerance);
		$time = $timestamp - 3;
		$mintolerance = date("Y-m-d H:i:s", $time);

		$this->db->query($query);
		$this->db->bind('mintolerance', $mintolerance);
		$this->db->bind('maxtolerance', $maxtolerance);
		$this->db->bind('user', $user);
		$this->db->execute();

		return $this->db->resultSet();
	}
}
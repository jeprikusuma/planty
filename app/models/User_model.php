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
					" VALUES(
						'', :name, :email, :password, :gender, :profile, :banner, 'USR', :active)";

		$this->db->query($query);
		$this->db->bind('name', $post['name']);
		$this->db->bind('email', $post['email']);
		$this->db->bind('password', $post['password']);
		$this->db->bind('gender', $post['gender']);
		$this->db->bind('profile', $post['profile']);
		$this->db->bind('banner', $post['banner']);
		$this->db->bind('active', 1);
		$this->db->execute();

		return $this->db->rowCount();
	}
	
	public function editUser($post){
		$query = "UPDATE ".$this->table."
					SET name = :name, password = :password, gender = :gender, profile = :profile, banner = :banner
					WHERE email = :email;";

		$this->db->query($query);
		$this->db->bind('name', $post['name']);
		$this->db->bind('email', $post['email']);
		$this->db->bind('password', $post['password']);
		$this->db->bind('gender', $post['gender']);
		$this->db->bind('profile', $post['profile-photo']);
		$this->db->bind('banner', $post['banner-photo']);
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
}
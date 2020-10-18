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

	public function registerUser($post){
		$query = "INSERT INTO ".$this->table.
					" VALUES(
						'', :name, :email, :password, :gender, :profile, :banner, 'USR')";

		$this->db->query($query);
		$this->db->bind('name', $post['name']);
		$this->db->bind('email', $post['email']);
		$this->db->bind('password', $post['password']);
		$this->db->bind('gender', $post['gender']);
		$this->db->bind('profile', $post['profile']);
		$this->db->bind('banner', $post['banner']);
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
}
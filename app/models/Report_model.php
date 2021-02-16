<?php

class Report_model{
    private $table = "reports";
    private $tableUser = "users";
	private $db;

	public function __construct(){
		$this->db = new Database;
    }

    public function sendReport($des, $user){
        $query = "INSERT INTO ".$this->table.
                    " (description, sender, sended, target) 
                    VALUES(
                        :des, :user, :sended, :target);";

        date_default_timezone_set("Asia/Singapore");
		$this->db->query($query);
        $this->db->bind('des', $des);
        $this->db->bind('user', $user);
		$this->db->bind('sended', date('Y/m/d H:i:s'));
		$this->db->bind('target', 'system');
        $this->db->execute();
    }

    public function sendReportPost($des, $user, $post){
        $query = "INSERT INTO ".$this->table.
                    " (description, sender, sended, target, toPost) 
                    VALUES(
                        :des, :user, :sended, :target, :post);";

        date_default_timezone_set("Asia/Singapore");
		$this->db->query($query);
        $this->db->bind('des', $des);
        $this->db->bind('user', $user);
		$this->db->bind('sended', date('Y/m/d H:i:s'));
		$this->db->bind('target', 'post');
		$this->db->bind('post', $post);
        $this->db->execute();
    }
    
    public function sendReportUser($des, $user, $toUser){
        $query = "INSERT INTO ".$this->table.
                    " (description, sender, sended, target, toUSer) 
                    VALUES(
                        :des, :user, :sended, :target, :toUser);";

        date_default_timezone_set("Asia/Singapore");
		$this->db->query($query);
        $this->db->bind('des', $des);
        $this->db->bind('user', $user);
		$this->db->bind('sended', date('Y/m/d H:i:s'));
		$this->db->bind('target', 'user');
		$this->db->bind('toUser', $toUser);
        $this->db->execute();
    }

    public function showReportSystem(){
        $query = "SELECT * FROM ".$this->table." WHERE  target = 'system';";
        $query = "SELECT ".$this->tableUser.".name as name, 
                ".$this->tableUser.".id as user, 
                ".$this->tableUser.".profile as profile, 
                ".$this->tableUser.".email as email,
                ".$this->tableUser.".name as name, 
                ".$this->table.".description as description,
                ".$this->table.".sended as sended,
                ".$this->table.".id as id
                    FROM `". $this->table ."`
                    INNER JOIN ".$this->tableUser."
                    ON ". $this->table .".sender=".$this->tableUser.".id
                    WHERE ". $this->table .".target = 'system'
                    ORDER BY ".$this->table.".sended DESC;";

		$this->db->query($query);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function showReportUser(){
        $query = "SELECT ".$this->tableUser.".name as name, 
                ".$this->tableUser.".id as user, 
                ".$this->tableUser.".profile as profile, 
                ".$this->tableUser.".email as email,
                ".$this->tableUser.".name as name, 
                ".$this->table.".description as description,
                ".$this->table.".sended as sended,
                ".$this->table.".toUser as toUser,                
                ".$this->table.".id as id
                    FROM `". $this->table ."`
                    INNER JOIN ".$this->tableUser."
                    ON ". $this->table .".sender=".$this->tableUser.".id
                    WHERE ". $this->table .".target = 'user'
                    ORDER BY ".$this->table.".sended DESC;";

		$this->db->query($query);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function showReportPost(){
        $query = "SELECT ".$this->tableUser.".name as name, 
                ".$this->tableUser.".id as user, 
                ".$this->tableUser.".profile as profile, 
                ".$this->tableUser.".email as email,
                ".$this->tableUser.".name as name, 
                ".$this->table.".description as description,
                ".$this->table.".sended as sended,
                ".$this->table.".toPost as toPost,                
                ".$this->table.".id as id
                    FROM `". $this->table ."`
                    INNER JOIN ".$this->tableUser."
                    ON ". $this->table .".sender=".$this->tableUser.".id
                    WHERE ". $this->table .".target = 'post'
                    ORDER BY ".$this->table.".sended DESC;";

		$this->db->query($query);
        $this->db->execute();
        return $this->db->resultSet();
    }
}
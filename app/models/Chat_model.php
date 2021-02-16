<?php 

class Chat_model{
	private $table = "chat";
    private $usersTable = "users";
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

    public function chat($id){
        $query = "SELECT
        c.id as id
        ,c.lastChat as lastChat
        ,c.lastFor as lastFor
        ,u1.id as idUser1
        ,u1.name as user1
        ,u1.email as email1
        ,u1.profile as profile1
        ,u2.id as idUser2
        ,u2.name as user2
        ,u2.email as email2
        ,u2.profile as profile2
        FROM
        ".$this->table." AS c
        INNER JOIN ".$this->usersTable." as u1 ON c.user1 = u1.id
        INNER JOIN ".$this->usersTable." AS u2 ON c.user2 = u2.id
        WHERE (user1 = :id OR user2 = :id) AND chats != '[]' AND deleted != :id
        ORDER BY lastTime DESC;";

		$this->db->query($query);
		$this->db->bind('id', $id);
 		
 		return $this->db->resultSet();
	}

    public function personalChat($id){
        $this->db->query("SELECT id, user1, user2, deleted, lastFor, chats FROM ".$this->table." WHERE id = :id");
		$this->db->bind('id', $id);
 		
 		return $this->db->single();
    }

    public function sendChat($id, $data){
        $query = "UPDATE ".$this->table." 
                 SET chats = JSON_MERGE(chats, JSON_OBJECT('from', :from, 'value', :value)),
                 lastFor = :to, lastChat = :value, lastTime = :time, deleted = :deleted
                 WHERE id = :id;";
                 
        date_default_timezone_set("Asia/Singapore");
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->bind('from', $data["from"]);
        $this->db->bind('value', $data["value"]);
        $this->db->bind('to', $data["to"]);
        $this->db->bind('time', date('Y/m/d H:i:s'));
        $this->db->bind('deleted', 0);
        $this->db->execute();
         
        return $this->db->rowCount();
    }

    public function unsetLastFor($id){
        $query = "UPDATE ".$this->table." 
                 SET lastFor = NULL 
                 WHERE id = :id;";

        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();
         
        return $this->db->rowCount();
    }


    public function chatCount($id){
        $query = "SELECT count(*) as count
        FROM ".$this->table."
        WHERE lastFor = :id";

        $this->db->query($query);
		$this->db->bind('id', $id);
 		
 		return $this->db->single();
    }

    public function checkRoom($user1, $user2){
        $query = "SELECT id, user1, user2, lastFor, chats, deleted FROM ".$this->table."
        WHERE (user1 = :user1 AND user2 = :user2) OR (user1 = :user2 AND user2 = :user1)";

        $this->db->query($query);
		$this->db->bind('user1', $user1);
		$this->db->bind('user2', $user2);
        
 		return $this->db->single();
    }

    public function makeRoom($user1, $user2){
        $query = "INSERT INTO ".$this->table.
                    " (user1, user2, chats, deleted) 
                    VALUES(
                        :user1, :user2, JSON_ARRAY(), :deleted);";

        $this->db->query($query);
        $this->db->bind('user1', $user1);
        $this->db->bind('user2', $user2);
        $this->db->bind('deleted', 0);
        $this->db->execute();
        
        $this->db->query("SELECT LAST_INSERT_ID() as id;");
        $this->db->execute();

		return $this->db->single();    
    }

    public function deleteChat($id, $user){
        $query = "UPDATE ".$this->table." 
                 SET deleted = :user 
                 WHERE id = :id AND deleted = :delete;";

        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->bind('user', $user);
        $this->db->bind('delete', 0);
        $this->db->execute();
         
        return $this->db->rowCount();
    }

    public function deleteChatPermanent($id, $user){
        $query = "DELETE FROm ".$this->table." 
                 WHERE id = :id AND deleted != :user;";

        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->bind('user', $user);
        $this->db->execute();
         
        return $this->db->rowCount();
    }
}
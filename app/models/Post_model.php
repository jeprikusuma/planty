<?php

class Post_model{
    private $table = "posts";
    private $tableUser = "users";
	private $db;

	public function __construct(){
		$this->db = new Database;
    }
    
    public function postData($id){
        $this->db->query("SELECT * FROM ".$this->table." WHERE id=:id");
        $this->db->bind('id', $id);

 		return $this->db->single();
    }

    public function multiPostsData($arr){
        $query = "SELECT ".$this->tableUser.".name as name, 
                ".$this->tableUser.".id as user, 
                ".$this->tableUser.".profile as profile, 
                ".$this->table.".content as content,
                ".$this->table.".suspended as suspended,
                ".$this->table.".id as id,
                ".$this->table.".likes as likes,
                ".$this->table.".comments as comments,
                ".$this->table.".comments as comments,
                DATE_FORMAT(".$this->table.".upload, '%M %Y, %d %k:%i') as upload
                    FROM `". $this->table ."`
                    INNER JOIN ".$this->tableUser."
                    ON ". $this->table .".user=".$this->tableUser.".id
                    WHERE ". $this->table .".id IN ('$arr')
                    ORDER BY ".$this->table.".upload DESC;";
        $this->db->query($query);

 		return $this->db->resultSet();
    }

    public function allPosts(){
        $query = "SELECT ".$this->tableUser.".name as name, 
                        ".$this->tableUser.".id as user, 
                        ".$this->tableUser.".profile as profile, 
                        ".$this->table.".content as content,
                        ".$this->table.".suspended as suspended,
                        ".$this->table.".id as id,
                        ".$this->table.".likes as likes,
                        ".$this->table.".comments as comments,
                        DATE_FORMAT(".$this->table.".upload, '%M %Y, %d %k:%i') as upload
                            FROM `". $this->table ."`
                            INNER JOIN ".$this->tableUser."
                            ON ". $this->table .".user=".$this->tableUser.".id
                            ORDER BY ".$this->table.".upload DESC;";
		$this->db->query($query);

 		return $this->db->resultSet();
    }

    public function postsIsSuspended($set){
        $query = "SELECT ".$this->tableUser.".name as name, 
                        ".$this->tableUser.".id as user, 
                        ".$this->tableUser.".profile as profile, 
                        ".$this->table.".content as content,
                        ".$this->table.".suspended as suspended,
                        ".$this->table.".id as id,
                        ".$this->table.".likes as likes,
                        ".$this->table.".comments as comments,
                        DATE_FORMAT(".$this->table.".upload, '%M %Y, %d %k:%i') as upload
                            FROM `". $this->table ."`
                            INNER JOIN ".$this->tableUser."
                            ON ". $this->table .".user=".$this->tableUser.".id
                            WHERE suspended=:suspend
                            ORDER BY ".$this->table.".upload DESC;";
		$this->db->query($query);
        $this->db->bind('suspend', $set);

 		return $this->db->resultSet();
    }

    public function searchPosts($keyword){
        $query = "SELECT ".$this->tableUser.".name as name, 
                        ".$this->tableUser.".id as user, 
                        ".$this->tableUser.".profile as profile, 
                        ".$this->table.".content as content,
                        ".$this->table.".suspended as suspended,
                        ".$this->table.".id as id,
                        ".$this->table.".likes as likes,
                        ".$this->table.".comments as comments,
                        DATE_FORMAT(".$this->table.".upload, '%M %Y, %d %k:%i') as upload
                            FROM `". $this->table ."`
                            INNER JOIN ".$this->tableUser."
                            ON ". $this->table .".user=".$this->tableUser.".id
                            WHERE (suspended=:suspend) 
                            AND (name LIKE CONCAT('%', :keyword , '%'))
                            ORDER BY ".$this->table.".upload DESC;";
		$this->db->query($query);
        $this->db->bind('suspend', 0);
        $this->db->bind('keyword', $keyword);

 		return $this->db->resultSet();
    }

    public function searchPostsAll($keyword){
        $query = "SELECT ".$this->tableUser.".name as name, 
                        ".$this->tableUser.".id as user, 
                        ".$this->tableUser.".profile as profile, 
                        ".$this->table.".content as content,
                        ".$this->table.".suspended as suspended,
                        ".$this->table.".id as id,
                        ".$this->table.".likes as likes,
                        ".$this->table.".comments as comments,
                        DATE_FORMAT(".$this->table.".upload, '%M %Y, %d %k:%i') as upload
                            FROM `". $this->table ."`
                            INNER JOIN ".$this->tableUser."
                            ON ". $this->table .".user=".$this->tableUser.".id
                            WHERE (name LIKE CONCAT('%', :keyword , '%'))
                            ORDER BY ".$this->table.".upload DESC;";
		$this->db->query($query);
        $this->db->bind('keyword', $keyword);

 		return $this->db->resultSet();
    }
        
    public function postById($id){
        $query = "SELECT ".$this->table.".id as id,
                        ".$this->tableUser.".name as name, 
                        ".$this->tableUser.".profile as profile, 
                        ".$this->table.".content as content,
                        ".$this->table.".likes as likes,
                        ".$this->table.".comments as comments,
                        DATE_FORMAT(".$this->table.".upload, '%M %Y, %d %k:%i') as upload
                            FROM `". $this->table ."`
                            INNER JOIN ".$this->tableUser."
                            ON ". $this->table .".user=".$this->tableUser.".id
                            WHERE user=:id
                            ORDER BY ".$this->table.".upload DESC;";
		$this->db->query($query);
        $this->db->bind('id', $id);

 		return $this->db->resultSet();
    }

    public function singlePost($id){
        $query = "SELECT ".$this->table.".id as id,
                        ".$this->tableUser.".name as name, 
                        ".$this->tableUser.".profile as profile, 
                        ".$this->table.".content as content,
                        ".$this->table.".likes as likes,
                        ".$this->table.".comments as comments,
                        DATE_FORMAT(".$this->table.".upload, '%M %Y, %d %k:%i') as upload
                            FROM `". $this->table ."`
                            INNER JOIN ".$this->tableUser."
                            ON ". $this->table .".user=".$this->tableUser.".id
                            WHERE ".$this->table.".id=:id
                            ORDER BY ".$this->table.".upload DESC;";
		$this->db->query($query);
        $this->db->bind('id', $id);

 		return $this->db->single();
    }

    public function postingPost($post){
        $query = "INSERT INTO ".$this->table.
					" VALUES(
                        '', :content, :user, :upload, :suspended, JSON_ARRAY(:like), JSON_ARRAY(:like) );";

        date_default_timezone_set("Asia/Singapore");
		$this->db->query($query);
		$this->db->bind('content', $post['content']);
        $this->db->bind('user', $post['user']);
		$this->db->bind('upload', date('Y/m/d H:i'));
        $this->db->bind('suspended', 0);
        $this->db->bind('like', 0);
        $this->db->execute();
        
        $this->db->query("SELECT LAST_INSERT_ID();");
        $this->db->execute();

		return $this->db->single();
    }

    public function deletePost($id){
        $query = "DELETE FROM ". $this->table." WHERE id= :id";

        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        
        return $this->db->rowCount();
    }

    public function deletePostByUser($id){
        $query = "DELETE FROM ". $this->table." WHERE user= :id";

        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        
        return $this->db->rowCount();
    }

    public function CountAllPosts(){
		$this->db->query('SELECT COUNT(*) AS allPosts FROM '.$this->table);

 		return $this->db->single();
	}

	public function CountPostsToday(){
		$this->db->query('SELECT COUNT(*) AS postsToday FROM '.$this->table.' WHERE DATE(upload) = CURDATE()');

 		return $this->db->single();
    }
    
    public function CountPostsSuspended(){
		$this->db->query('SELECT COUNT(*) AS postsSuspended FROM '.$this->table.' WHERE suspended=:suspended');
		$this->db->bind('suspended', 1);

 		return $this->db->single();
    }
    
    public function suspend($id){
		$query = "UPDATE ".$this->table."
					SET suspended = 1
					WHERE id =:id;";
		$this->db->query($query);
		$this->db->bind('id', $id);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function unsuspend($id){
		$query = "UPDATE ".$this->table."
					SET suspended = 0
					WHERE id =:id;";
		$this->db->query($query);
		$this->db->bind('id', $id);
		$this->db->execute();

		return $this->db->rowCount();
    }
    
    public function postLike($id, $user){
        $query = "UPDATE ".$this->table."
                  SET likes = JSON_MERGE(likes, JSON_ARRAY(:user))
                  WHERE id = :id AND JSON_SEARCH(likes, 'one', :user) IS NULL";
                    
		$this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->bind('user', $user);
		$this->db->execute();

		return $this->db->rowCount();
    }

    public function postUnlike($id, $user){
        $query = "UPDATE ".$this->table."
                  SET likes = JSON_REMOVE(
                      likes, JSON_UNQUOTE(JSON_SEARCH(likes, 'one', :user)))
                  WHERE id = :id AND JSON_SEARCH(likes, 'one', :user) IS NOT NULL";
                           
		$this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->bind('user', $user);
		$this->db->execute();

		return $this->db->rowCount();
    }

    public function postComment($id, $data){
        $query = "UPDATE ".$this->table." 
                 SET comments = JSON_MERGE(JSON_OBJECT('name', :name, 'img', :img, 'comment', :comment, 'upload', :upload), comments)
                 WHERE id = :id;";

        date_default_timezone_set("Asia/Singapore");
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->bind('name', $data["name"]);
        $this->db->bind('img', $data["img"]);
        $this->db->bind('comment', $data["comment"]);
        $this->db->bind('upload', date('Y/m/d H:i'));
        $this->db->execute();
         
        return $this->db->rowCount();
    }
}
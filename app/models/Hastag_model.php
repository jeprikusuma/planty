<?php

class Hastag_model{
    private $table = "trending";
    private $db;

    public function __construct(){
		$this->db = new Database;
    }
    
    
    public function checkHastag($hastag){
		$this->db->query('SELECT * FROM '.$this->table.' WHERE BINARY hastag=:hastag');
		$this->db->bind('hastag', $hastag);
        $this->db->execute();

 		return $this->db->single();
    }

    public function newHastag($hastag, $post){
        $query = "INSERT INTO ".$this->table.
					" VALUES(
                        '', :hastag, :popularity, :lastUpdate, JSON_ARRAY(:post));";

        date_default_timezone_set("Asia/Singapore");
		$this->db->query($query);
		$this->db->bind('hastag', $hastag);
        $this->db->bind('popularity', 1);
		$this->db->bind('lastUpdate', date('Y/m/d H:i'));
		$this->db->bind('post', $post);
        $this->db->execute();

        return $this->db->rowCount();
        
    }

    public function updateHastagPopularity($id, $post){
        $query = "UPDATE ".$this->table."
                    SET popularity = :popularity,
                        lastUpdate = :lastUpdate,
                        posts = JSON_MERGE(posts, JSON_ARRAY(:post))                    
                    WHERE id = :id;";
                    
        date_default_timezone_set("Asia/Singapore");
		$this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->bind('popularity', 1);
        $this->db->bind('lastUpdate', date('Y/m/d H:i'));
        $this->db->bind('post', $post);
		$this->db->execute();

		return $this->db->rowCount();
        
    }

    public function updateHastag($id, $post){
        $query = "UPDATE ".$this->table."
                    SET popularity = popularity + :popularity,
                        lastUpdate = :lastUpdate,
                        posts = JSON_MERGE(posts, JSON_ARRAY(:post))                    
                    WHERE id = :id;";
                    
        date_default_timezone_set("Asia/Singapore");
		$this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->bind('popularity', 1);
        $this->db->bind('lastUpdate', date('Y/m/d H:i'));
        $this->db->bind('post', $post);
		$this->db->execute();

		return $this->db->rowCount();
        
    }

    public function deleteHastagPost($post){
        $query = "UPDATE ".$this->table."
                  SET posts = JSON_REMOVE(
                      posts, JSON_UNQUOTE(JSON_SEARCH(posts, 'one', :post)))
                  WHERE JSON_SEARCH(posts, 'one', :post) IS NOT NULL";
                    
		$this->db->query($query);
        $this->db->bind('post', $post);
		$this->db->execute();

		return $this->db->rowCount();
    }

    public function hastagPosts($hastag){
        $query = "SELECT posts FROM ".$this->table."
                 WHERE hastag = :hastag";

        $this->db->query($query);
        $this->db->bind('hastag', $hastag);
        $this->db->execute();

        return $this->db->single();
    }

    public function deleteEmptyHastag(){
        $query = "DELETE FROM " .$this->table. " WHERE posts IS NULL OR posts LIKE '%[]%';";
        
        $this->db->query($query);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
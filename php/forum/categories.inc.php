<?php

class categories {

    private $web_db_connection;
    private $mc_db_connection;

    public function categories_from_db(){
        $sql = "SELECT * FROM categories";
        $stmt = $this->web_db_connection->prepare($sql);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function topics_from_db(){
        $sql = "SELECT * FROM topics";
        $stmt = $this->web_db_connection->prepare($sql);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function topic_count(){
        $num_rows = $this->web_db_connection->query("SELECT count(*) FROM topics")->fetchColumn();
        return $num_rows;
    }

    public function discussions($topic_id){
        $num_rows = $this->web_db_connection->query("SELECT count(*) FROM threads WHERE topic_id='$topic_id'")->fetchColumn();
        return $num_rows;
    }

    public function total_posts($topic_id){
        $num_rows = $this->web_db_connection->query("SELECT count(*) FROM posts INNER JOIN threads ON posts.thread_id=threads.id WHERE threads.topic_id='$topic_id'")->fetchColumn();
        return $num_rows;
    }

    public function latest_post($topic_id){

    }

    public function set_db_connections(){
        $db = new database();

        $db->web_db_connect();
        $this->web_db_connection = $db->web_db_connection;

        $db->minecraft_db_connect();
        $this->mc_db_connection = $db->mc_db_connection;
    }
} 
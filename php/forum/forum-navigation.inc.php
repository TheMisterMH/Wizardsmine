<?php

class forum_nav {

    private $web_db_connection;
    private $mc_db_connection;

    function __construct() {
        $this->set_db_connections();
    }

    public function get_topic($thread_id){
        $sql = "SELECT threads.topic_id,topics.name FROM threads INNER JOIN topics ON threads.topic_id=topics.id WHERE threads.id='$thread_id'";
        $stmt = $this->web_db_connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function get_thread($post_id){
        $sql = "SELECT posts.thread_id,threads.name FROM posts INNER JOIN threads ON threads.id=posts.thread_id WHERE posts.id='$post_id'";
        $stmt = $this->web_db_connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function get_topic_name($topic_id){
        $sql = "SELECT id,name FROM topics WHERE id='$topic_id'";
        $stmt = $this->web_db_connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function get_thread_name($thread_id){
        $sql = "SELECT id,name FROM threads WHERE id='$thread_id'";
        $stmt = $this->web_db_connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function set_db_connections(){
        $db = new database();

        $db->web_db_connect();
        $this->web_db_connection = $db->web_db_connection;

        $db->minecraft_db_connect();
        $this->mc_db_connection = $db->mc_db_connection;
    }
}
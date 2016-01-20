<?php

class topics {

    private $web_db_connection;
    private $mc_db_connection;

    public function get_threads($topic_id){
        //$sql = "SELECT * FROM threads WHERE topic_id='$topic_id' ORDER BY post_date ASC";
        $sql = "SELECT threads.*,users.web_name FROM threads INNER JOIN users ON users.id=threads.user_id WHERE topic_id='$topic_id' ORDER BY post_date DESC";
        $stmt = $this->web_db_connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function get_thread_labels($thread_id){
        $sql = "SELECT id,label_type FROM thread_labels WHERE thread_id='$thread_id'";
        $stmt = $this->web_db_connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function thread_count($topic_id){
        $num_rows = $this->web_db_connection->query("SELECT count(*) FROM threads WHERE topic_id='$topic_id'")->fetchColumn();
        return $num_rows;
    }

    public function thread_label_count($thread_id){
        $num_rows = $this->web_db_connection->query("SELECT count(*) FROM thread_label WHERE thread_id='$thread_id'")->fetchColumn();
        return $num_rows;
    }

    public function topic_validation($topic_id){
        if(isset($topic_id)&& ($topic_id != "false")){
            $num_rows = $this->web_db_connection->query("SELECT count(*) FROM topics WHERE id='$topic_id'")->fetchColumn();
            if($num_rows != 0){
                return true;
            }
        }
        return false;
    }

    public function set_db_connections(){
        $db = new database();

        $db->web_db_connect();
        $this->web_db_connection = $db->web_db_connection;

        $db->minecraft_db_connect();
        $this->mc_db_connection = $db->mc_db_connection;
    }
}
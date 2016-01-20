<?php

class thread {

    private $web_db_connection;
    private $mc_db_connection;

    public function get_posts($thread_id){
        $sql = "SELECT posts.*,users.web_name FROM posts INNER JOIN users ON users.id=posts.user_id WHERE thread_id='$thread_id' ORDER BY date ASC ";
        $stmt = $this->web_db_connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function thread_validation($thread_id){
        if(isset($thread_id)&& ($thread_id != "false")){
            $num_rows = $this->web_db_connection->query("SELECT count(*) FROM threads WHERE id='$thread_id'")->fetchColumn();
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
<?php



class post_handling {

    private $web_db_connection;
    private $mc_db_connection;

    private $session;

    function __construct() {
        $this->session = new session();
    }

    public function insert_post($thread_id, $post){
        $userid = $this->login_check();

        $sql = "INSERT INTO posts (post_text,user_id,thread_id) VALUES ('$post', '$userid', '$thread_id')";
        $stmt = $this->web_db_connection->prepare($sql);
        $stmt->execute();

    }

    public function create_thread($topic_id, $name){
        $user_id = $this->login_check();

        $id_query = $this->web_db_connection->prepare("SELECT id FROM threads ORDER BY id DESC LIMIT 0,1");
        $id_query->execute();
        $thread_id = $id_query->fetchAll()[0][0] + 1;

        $sql = "INSERT INTO threads (topic_id, name, user_id) VALUES ('$topic_id', '$name', '$user_id')";
        $stmt = $this->web_db_connection->prepare($sql);
        $stmt->execute();

        return $thread_id;
    }

    public function load_editor_post($post_id){
        $sql = "SELECT post_text FROM posts WHERE id='$post_id'";
        $stmt = $this->web_db_connection->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll()[0]['post_text'];
        return $result;
    }

    public function upload_editor_post($post_id, $post){
        if(!$this->post_validation($post_id)){
            throw new Exception("Invalid post");
        }

        $sql = "UPDATE posts SET post_text='$post' WHERE id='$post_id'";
        $stmt = $this->web_db_connection->prepare($sql);
        $stmt->execute();
    }

    public function post_owner_validation($post_id){
        if(!$this->session->check_session()){
            throw new Exception("Not logged in");
        }
        $user_id = $this->session->get_user_id();

        $num_rows = $this->web_db_connection->query("SELECT count(*) FROM posts WHERE user_id='$user_id' AND id='$post_id'")->fetchColumn();

        if($num_rows == 0){
            return false;
        }
        return true;
    }

    public function post_validation($post_id){
        if(isset($post_id)&& ($post_id != "false")){
            $num_rows = $this->web_db_connection->query("SELECT count(*) FROM posts WHERE id='$post_id'")->fetchColumn();
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

    private function login_check(){
        if(!$this->session->check_session()){
            throw new Exception("Not logged in");
        }
        return $this->session->get_user_id();
    }
}
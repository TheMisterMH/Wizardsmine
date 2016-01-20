<?php
require_once 'inc/db.inc.php';
include_once 'session.php';
require 'forum/categories.inc.php';
require 'forum/topics.inc.php';
require 'forum/thread.inc.php';
require 'forum/post-handling.inc.php';
require 'forum/forum-navigation.inc.php';

class forum {

    function __construct(){
        if (isset($_POST['type']) && $_POST['type']) {
            $type = $_POST['type'];

            switch ($type){

                case "categories":
                    $this->show_catagories();
                    break;

                case "topics":
                    $this->show_topic();
                    break;

                case "thread":
                    $this->show_thread();
                    break;

                case "new_post":
                    $this->new_forum_post();
                    break;

                case "new_thread":
                    $this->new_thread();
                    break;

                case "load_editor_post":
                    $this->load_editor_post();
                    break;

                case "update_editor_post":
                    $this->insert_edited_post();
                    break;

                case "navigation":
                    $this->navigation();
                    break;
            }
        }
    }

    public function show_catagories(){
        $cat = new categories();
        $cat->set_db_connections();

        $numbers = array('disucssions' => array(), 'posts' => array());

        $top_count = $cat->topic_count();
        for ($i = 1; $i <= $top_count; $i++){
            $numbers['discussions'][$i - 1] = $cat->discussions($i);
            $numbers['posts'][$i - 1] = $cat->total_posts($i);
        }

        $arr = array('categories' => $cat->categories_from_db(), 'topics' => $cat->topics_from_db(), 'topic_count' => $numbers);

        echo json_encode($arr);
    }

    public function show_topic(){
        $topic_id = $_POST['topic_id'];
        try {

            $topic = new topics();
            $topic->set_db_connections();

            if(!$topic->topic_validation($topic_id)){
                throw new Exception("No valid topic");
            }

            $threads = $topic->get_threads($topic_id);

            $thr_count = $topic->thread_count($topic_id);

            for($i = 0; $i < $thr_count; $i++) {

                @$thread_id = $threads[$i]['id'];

                if ($topic->thread_label_count($thread_id) != "0") {

                    $thread_labels = $topic->get_thread_labels($thread_id);

                    $labels[$i] = array('got_label' => 'true', $i => $thread_labels);

                } else {

                    $labels[$i] = array('got_label' => 'false');

                }
            }

            $arr = array('status' => 'true', 'threads' => $threads, 'labels' => $labels);

            echo json_encode($arr);

        } catch (Exception $e){

            $arr = array( 'status' => 'false', 'error' => $e->getMessage());
            echo json_encode($arr);
        }


    }

    public function show_thread(){
        $thread_id = $_POST['thread_id'];

        try {
            $thread = new threads();
            $thread->set_db_connections();

            if(!$thread->thread_validation($thread_id)){
                throw new Exception("No valid thread");
            }

            $navigation = new forum_nav();
            $topic = $navigation->get_topic($thread_id);

            $sess = new session();
            if(!$sess->check_session()){
                $user_id = -1;
            } else {
                $user_id = $sess->get_user_id();
            }

            $arr = array('posts' => $thread->get_posts($thread_id), 'user_id' => $user_id, 'topic' => $topic);

            echo json_encode($arr);

        } catch (Exception $e){

            $arr = array( 'status' => 'false', 'error' => $e->getMessage());
            echo json_encode($arr);

        }


    }

    public function new_forum_post(){
        $thread_id = $_POST['thread_id'];
        $post = $_POST['post'];

        try {

            $thread = new threads();
            $thread->set_db_connections();
            if(!$thread->thread_validation($thread_id)){
                throw new Exception("Invalid thread");
            }

            $thread_post = new post_handling();
            $thread_post->set_db_connections();

            $thread_post->insert_post($thread_id, $post);

            $arr = array( 'status' => 'true' );
            echo json_encode($arr);


        } catch (Exception $e ){
            $arr = array( 'status' => 'false', 'error' => $e->getMessage());
            echo json_encode($arr);
        }


    }

    public function load_editor_post(){
        $post_id = $_POST['post_id'];

        try {

            $post_handling = new post_handling();
            $post_handling->set_db_connections();
            if(!$post_handling->post_validation($post_id)){
                throw new Exception("Invalid post");
            }

            if(!$post_handling->post_owner_validation($post_id)){
                throw new Exception("You dont own this post");
            }

            $navigation = new forum_nav();
            $threads = $navigation->get_thread($post_id);

            $thread_id = $threads[0]['thread_id'];

            $topic = $navigation->get_topic($thread_id);

            $post = $post_handling->load_editor_post($post_id);
            $arr = array( 'status' => 'true', 'post' => $post, 'thread' => $threads, 'topic' => $topic);
            echo json_encode($arr);

        } catch (Exception $e){
            $arr = array( 'status' => 'false', 'error' => $e->getMessage());
            echo json_encode($arr);
        }


    }

    public function insert_edited_post(){
        $post_id = $_POST['post_id'];
        $post = $_POST['post'];

        try {

            $post_handling = new post_handling();
            $post_handling->set_db_connections();

            $post_handling->upload_editor_post($post_id, $post);

            $arr = array( 'status' => 'true');
            echo json_encode($arr);

        } catch (Exception $e) {
            $arr = array( 'status' => 'false', 'error' => $e->getMessage());
            echo json_encode($arr);
        }
    }

    public function new_thread(){
        $topic_id = $_POST['topic_id'];
        $post = $_POST['post'];
        $thread_name = $_POST['name'];

        try {
            $topic = new topics();
            $topic->set_db_connections();

            if(!$topic->topic_validation($topic_id)){
                throw new Exception("Invalid topic");
            }

            $new_thread = new post_handling();
            $new_thread->set_db_connections();
            $thread_id = $new_thread->create_thread($topic_id, $thread_name);

            $new_thread->insert_post($thread_id, $post);

            $arr = array( 'status' => 'true', 'thread_id' => $thread_id);
            echo json_encode($arr);

        } catch (Exception $e) {
            $arr = array( 'status' => 'false', 'error' => $e->getMessage());
            echo json_encode($arr);
        }
    }

    public function navigation(){
        $topic_id = $_POST['topic_id'];
        $thread_id = $_POST['thread_id'];

        $navigation = new forum_nav();

        if($topic_id != "false"){
            //get shit from db
            $topic = $navigation->get_topic_name($topic_id);

            $arr = array('topic' => $topic, 'thread' => "false");
        } else if ($thread_id != "false") {
            //get shit from db
            $topic = $navigation->get_topic($thread_id);
            $thread_name = $navigation->get_thread_name($thread_id);

            $arr = array('topic' => "false", 'thread' => array('thread' =>$thread_name, 'topic' => $topic));
        } else {
            $arr = array('topic' => "false", 'thread' => "false");
        }

        echo json_encode($arr);
    }
}

new forum();



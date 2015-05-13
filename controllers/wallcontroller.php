<?php

class Wallcontroller{

    public function showAction(){

        $db = new PDO("mysql:host=localhost;dbname=why", "root", "root");

        $postStm = $db->prepare('SELECT * FROM posts AS P JOIN users AS U ON (P.user_id = U.user_id) JOIN followers AS F ON (F.followee = U.user_id) WHERE F.follower = :currentUser ORDER BY P.post_id DESC');

        $postStm->bindParam(":currentUser", $_SESSION['user']->user_id, PDO::PARAM_STR);
        $postStm->execute();

        $posts = $postStm->fetchAll();
        $comments = array();

        foreach($posts as $post){
            $commentStm = $db->prepare('SELECT * FROM comments JOIN users AS U ON (U.user_id = comments.user_id) WHERE post_id = :post_id ORDER BY comment_id');
            $commentStm->bindParam(':post_id', $post["post_id"]);
            $commentStm->execute();
            while($comment = $commentStm->fetch()){
                array_push($comments, $comment);
            }
        }

        require_once "views/wall.php";
    }

    public function getCommentsAction(){

        $db = new PDO("mysql:host=localhost;dbname=why", "root", "root");

        if(isset($_POST["post_id"])){
            $commentStm = $db->prepare('SELECT * FROM comments AS CO JOIN users AS U ON (U.user_id = CO.user_id) WHERE post_id = :post_id ORDER BY CO.comment_id DESC');
            $commentStm->bindParam(':post_id', $_POST["post_id"], PDO::PARAM_INT);
            $commentStm->execute();
            $comments = $commentStm->fetchAll();
            $return = json_encode($comments);
            echo($return);
        }
    }

    public function commentAction(){
        $db = new PDO("mysql:host=localhost;dbname=why", "root", "root");


        $insertCommentStm = $db->prepare('INSERT INTO comments (content, post_id, user_id) VALUES (:content, :post_id, :user_id)');
        $insertCommentStm->bindParam(':content', $_POST['content'], PDO::PARAM_STR);
        $insertCommentStm->bindParam(':post_id', $_POST['hidden_post_id'], PDO::PARAM_INT);
        $insertCommentStm->bindParam(':user_id', $_SESSION['user']->user_id, PDO::PARAM_INT);
        $insertCommentStm->execute();

        echo($_POST['content'] ." " . $_POST['hidden_post_id'] ." ". $_SESSION['user']->user_id);
    }

}
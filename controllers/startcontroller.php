<?php

class StartController{
    public function indexAction(){

        require_once 'views/start_view.php';
    }

    public function loginAction(){

        if(isset($_POST["submit_login"])){
            $db = new PDO("mysql:host=localhost;dbname=why", "root", "root");
            $stm = $db->prepare("SELECT id FROM users WHERE username = :username AND password = :password");
            $stm->bindParam(":username", $_POST["username"], PDO:: PARAM_STR);
            $stm->bindParam(":password", $_POST["password"], PDO:: PARAM_STR);
            $stm->execute();

            if($stm->rowCount() == 1){
                $row = $stm->fetchColumn();


                session_start();
                $_SESSION['status'] = "LoggedIn";
                $_SESSION["username"] = $_POST["username"];
                $_SESSION["id"] = $row;


                header("location:../user/member");


            }
            else{
                echo "There is no such user or pass";
            }
        }
    }
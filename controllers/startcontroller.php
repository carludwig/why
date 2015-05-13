<?php

error_reporting(E_ALL);

class Startcontroller{

    public $errors;

    public function indexAction(){

        if(isset($_SESSION["error"])){
            $error = $_SESSION["error"];
        }
        require_once "views/startview.php";
    }

    public function registerAction(){

        $db = new PDO("mysql:host=localhost;dbname=why", "root", "root");
        if($this->validator($_POST["email"], $_POST["password"], $_POST["rep_password"], $_POST["first_name"], $_POST["last_name"])) {
            $registerStm = $db->prepare('INSERT INTO users (first_name, last_name, email, password, gender) VALUES (:first_name, :last_name, :email, :password, :gender)');
            $registerStm->bindParam(":first_name", $_POST["first_name"], PDO::PARAM_STR);
            $registerStm->bindParam(":last_name", $_POST["last_name"], PDO::PARAM_STR);
            $registerStm->bindParam(":email", $_POST["email"], PDO::PARAM_STR);
            $registerStm->bindParam(":password", $_POST["password"], PDO::PARAM_STR);
            $registerStm->bindParam(":gender", $_POST["gender"], PDO::PARAM_STR);

            if($registerStm->execute()){
                $this->loginAction();
            }
        }
        else{
            $_SESSION["error"] = $this->errors;
            header("location:../");
        }

    }

    public function loginAction(){

        $db = new PDO("mysql:host=localhost;dbname=why", "root", "root");

        $loginStm = $db->prepare('SELECT * FROM users WHERE email = :email AND password = :password');
        $loginStm->bindParam(":email", $_POST["email"], PDO::PARAM_STR);
        $loginStm->bindParam(":password", $_POST["password"], PDO::PARAM_STR);
        $loginStm->execute();

        if($loginStm->rowCount() == 1){
            $_SESSION["auth"] = 'loggedin';
            $_SESSION["user"] = $loginStm->fetchObject();

            header("location:../wall/show");
        }
        else{
            header("location:/why");
        }
    }

    public function logoutAction(){
        session_unset();
        session_destroy();
        header("location:../");
    }

    private function validator ($email, $pass1, $pass2, $first_name, $last_name){
        if(empty($first_name) || empty($last_name) || empty($email) || empty($pass1) || empty($pass2)){
            $this->errors = "You have to fill in all fields";
            return false;
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->errors = "Invalid email";
            return false;
        }
        if(strlen($pass1) < 6) {
            $this->errors = " Your password has to be at least six characters long";
            return false;
        }
        if(($pass1 != $pass2)) {
            $this->errors = "Your password need to match";
            return false;
        }
        else{
            return true;
        }
    }
}



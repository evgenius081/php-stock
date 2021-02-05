<?php

namespace core\Controller;

class User extends \core\Controller{
    
    public function index(){
        $user = new \core\Models\User();
        if(isset($_POST["signup"])){
            $password = $user->getUserInfo($_POST['userlogin']);
            if($password != 'no_login'){
                if(password_verify($_POST['password'], $password['password'])){
                   $user->login($password);
                    header('location: \\');
                }else{
                    $this->view('login');
                    echo "<div class='modal'><p>Wrong password, hacker)</p><i class='fal fa-times fa-2x'></i></div>";
                }
            }else{
                $this->view('login');
                echo "<div class='modal'><p>This login doesn`t exist!</p><i class='fal fa-times fa-2x'></i></div>";
            }
        }else{
            $this->view('login');
        }
    }

    public function cabinet(){
        $stock = new \core\Models\Stock();
        $images = [];
        if(isset($_POST['deleteChosen'])){
            foreach($_POST as $var=>$name){
                if($var != 'deleteChosen'){
                    unset($_SESSION[$name]);
                }
            }
            header('location: \cabinet');
        }
        foreach($_SESSION as $img => $name){
            if($img != 'uid' && $img != 'creator' && $img != 'token' && $img != 'admin' && $img != 'cart' ){
                $images[$img] = $stock->getImageByID($name)[0];
            }
        }
        $this->view('cabinet', ['images' => $images]);
    }

    public function logout(){
        $user = new \core\Models\User();
        $user->logout();
        header('location: \\');
    }

    public function register(){
        $person = new \core\Models\User();
        if(isset($_POST["signin"])){
            $respond = $person->checkUserName($_POST['userlogin']);
            if($respond == 0){
                $userName = $_POST['userlogin'];
                $userEmail = $_POST['email'];
                $userPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $user=[
                    'login' => $userName, 
                    'email' => $userEmail,
                    'password' => $userPassword 
                ];
                $person->register($user);
                $info = $person->getUserInfo($_POST['userlogin']);
                $person->login($info);
                header("location: \\");
            }else{
                $this->view('register');
                echo "<div class='modal'><p>This login is engaged. Try another one</p><i class='fal fa-times fa-2x'></i></div>";
                die();
            }
        }else{
            $this->view('register');
        }
    }
}
<?php

namespace core\Models;

class User extends \core\Model{

    const USER_NAME_CAN_BE_USED = 0;
    const USER_NAME_IS_ENGAED = 1;

    public function getUserInfo($login){
        $db = $this->getDb();
        $results = $db->users->find(['login'=> $login])->toArray();
        if(count($results) == 0){
            return 'no_login';
        }else{
            $results = $results[0];
            $password = $results['password'];
            return $results;
        }
    }

    public function login($password){
        $_SESSION['token'] = $this->generateToken($password['_id']);
        $_SESSION['uid'] = $password['_id'];
        $_SESSION['creator'] = $password['login'];
    }

    private function generateToken($userID){
        return  md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'].$userID);
    }

    public function logout(){
        session_unset();
    }

    public function checkUserName($userLogin){
        $db = $this->getDb();
        $results = $db->users->find(["login"=> $userLogin])->toArray();
        if(empty($results)){
            return self::USER_NAME_CAN_BE_USED;
        }else{
            return self::USER_NAME_IS_ENGAED;
        }
    }

    public function register($person){
        $db = $this->getDb();
        $db->users->insertOne($person);
    }
}
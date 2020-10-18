<?php

class Session{
    public function __construct(){
        session_start();
    }

    public function make($user, $key){
        $_SESSION["user"] = $user;
        $_SESSION["key"] = $key;
    }

    public function remember($user, $key){
        setcookie("user", $user, time() + (86400 * 30), "/"); 
        setcookie("key", $key, time() + (86400 * 30), "/"); 
    }

    public function find(){
        if(isset($_SESSION["user"]) && isset($_SESSION["key"])){
            return true;
        }else if(isset($_COOKIE["user"]) && isset($_COOKIE["key"])){
            $_SESSION["user"] = $_COOKIE["user"];
            $_SESSION["key"] = $_COOKIE["key"];
            return true;
        }else{
            return false;
        }
    }    
    public function role($role = false){
        if($role){
            $_SESSION["role"] = $role;
        }else{
            if(isset($_SESSION["role"])){
                return $_SESSION["role"];
            }
            return false;
        }
    }
    public function remove(){
        session_destroy();
        // cookie unset
        setcookie("user", "", 1, '/');
        setcookie("key", "", 1, '/');
    }
}
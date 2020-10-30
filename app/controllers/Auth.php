<?php

class Auth extends Controller{

    public function index(){
        // apakah user sudah login
        if(Session::find()){
            // mengambil data user
            $user = $this->model("User_model")->findUser($_SESSION["user"]);
            // validasi session dengan data di database
            if($user['email'] == $_SESSION["user"] && $user["password"] == $_SESSION["key"]){

                
                $role = $this->model('User_model')->getRole($_SESSION["user"]);
                
                // menyaiapkan session role
                Session::role($role["role"]);
                switch ($role["role"]) {
                    case 'Admin':
                        header('Location:'.BASEURL.'/Admin');
                        break;
                    
                    default:
                        header('Location:'.BASEURL.'/Home');
                        break;
                }
               
            }else{
                header('Location:'.BASEURL.'/Auth/register');
            }
        }else{
            header('Location:'.BASEURL.'/Auth/register');
        }
        
    }

    public function register(){
        
        if(isset($_POST["register"])){
            // validasi data
            if(isset($_POST["name"]) && 
                isset($_POST["email"]) && 
                isset($_POST["password"]) && 
                isset($_POST["confirm-password"])
                ){
                // validasi password dan confirm password
                if($_POST["password"] == $_POST["confirm-password"]){
                    //cek ketersediaan email
                    if(!$this->model("User_model")->findUser($_POST["email"])){
                        // hash password
                        $_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);

                        // menyiapkan image default
                        $_POST["banner"] = 'banner.png';

                        if($_POST["gender"] == 'male'){
                            $_POST["profile"] = 'default-male.png';
                        }else{
                            $_POST["profile"] = 'default-famale.png';
                        }
                        // cek input ke database dengan model
                        if($this->model("User_model")->registerUser($_POST) > 0){
                            Session::make($_POST["email"], $_POST["password"]);
                            header('Location:'.BASEURL.'/Auth');
                        }else{
                            Flasher::setFlash('Error inserting data!', 'danger');
                        };

                    }else{
                        Flasher::setFlash('Email has been taken!', 'danger');
                    }

                }else{
                    Flasher::setFlash('Password not match!', 'danger');
                }

            }else{
                Flasher::setFlash('Failed to register!', 'danger');
            }
            
        }

        $data['header'] = 'Register';
        $this->view('tamplates/header', $data);
        $this->view('auth/index');
        $this->view('tamplates/footer');
    }

    public function login(){
        if(isset($_POST["login"])){
            // validasi data
            if( isset($_POST["email"]) && 
                isset($_POST["password"])
                ){

                    //cek email
                    if($this->model("User_model")->findUser($_POST["email"])){
                        // mengambil password user
                        $user = $this->model("User_model")->findUser($_POST["email"]);

                        // cek password
                        if(password_verify($_POST["password"], $user["password"])){
                            
                            if($user["isActive"] == 1){
                                // jika semua kondisi terpenuhi
                                // jika ada remember me
                                if(isset($_POST["remember"])){
                                    Session::remember($_POST["email"], $user["password"]);
                                }
                                Session::make($_POST["email"], $user["password"]);
                                header('Location:'.BASEURL.'/Auth');
                            }else{
                                Flasher::setFlash('Account has been suspended!', 'danger');
                            }

                        }else{
                            Flasher::setFlash('Wrong password!', 'danger');
                        };

                    }else{
                        Flasher::setFlash('Email not registered!', 'danger');
                    }


            }else{
                Flasher::setFlash('Failed to login!', 'danger');
            }
            
        }

        $data['header'] = 'Login';
        $this->view('tamplates/header', $data);
        $this->view('auth/login');
        $this->view('tamplates/footer');
    }

    public function logout(){
        Session::remove();
        header('Location:'.BASEURL.'/Auth');
    }
}
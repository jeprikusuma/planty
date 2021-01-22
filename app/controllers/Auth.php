<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Auth extends Controller{

    public function index(){
        // apakah user sudah login
        if(Session::find()){
            // mengambil data user
            $user = $this->model("User_model")->findUser($_SESSION["user"]);
            // validasi session dengan data di database
            if($user['email'] == $_SESSION["user"] && $user["password"] == $_SESSION["key"]){
                // cek verifikasi akun
                if($user["verify"] == NULL){
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
                }else{// Jika user belum verifikasi akun
                    $id  = 'v';
                    $id .= bin2hex(random_bytes(3));
                    $id .= $user["id"];
                    header('Location:'.BASEURL.'/Auth/verify/'.$id);
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
                            $this->sendVerification();
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

    public function verify($id = null, $code = null){   
        $linkId = $id;
        if($id != null){
            $id = substr($id, 7);
            $user = $this->model("User_model")->findUserById($id);
            if(!$user){
                $this->logout();
            }else if($_SESSION['user'] != $user['email']){
                $this->logout();
            }
        }else{
            $this->logout();
        }

        if($code == "resend"){
            $this->sendVerification();
            header('Location:'.BASEURL.'/Auth');
        }

        if($code != null){
            $this->model("User_model")->verifyUser($id, $code);
            header('Location:'.BASEURL.'/Auth');
        }else{
                $data['header'] = 'Verification';
                $data['id'] = $linkId;
                $this->view('tamplates/header', $data);
                $this->view('auth/verify', $data);
                $this->view('tamplates/footer');
            }  
    }

    public function logout(){
        Session::remove();
        header('Location:'.BASEURL.'/Auth');
    }

    private function sendVerification(){
        $user = $this->model("User_model")->findUser($_SESSION["user"]);
        $id  = 'v';
        $id .= bin2hex(random_bytes(3));
        $id .= $user["id"];
        $code = $user["verify"];

		$mail = new PHPMailer(true);
		$mail->IsSMTP();
		$mail->Mailer = "smtp";

		$mail->SMTPDebug  = 0;  
		$mail->SMTPAuth   = TRUE;
		$mail->SMTPSecure = "tls";
		$mail->Port       = 587;
		$mail->Host       = "smtp.gmail.com";
		$mail->Username   = "nineblog11@gmail.com";
		$mail->Password   = "jeprik01";

		$mail->IsHTML(true);
		$mail->AddAddress($user["email"], $user["name"]);
		$mail->SetFrom("admin@planty.com", "Planty");
		$mail->AddReplyTo("no-reply@gmail.com", "no-reply");
		$mail->Subject = "Planty: Verify Account";
		$content = '
		<html>
			<body>
				<p>Hello, <strong>'.$user["name"].'</strong></p>
				<br>
				<h2 style = "color: #0275d8;">Welcome to Plant Comunity</h2>
				<p>Please click the verification button below to activate your account.</p>
				<br>
				<a href="'.BASEURL.'/Auth/verify/'.$id.'/'.$code.'" style="
						padding: .8rem 1rem;
						text-align: center;
						background-color: : #77cad3;
						text-decoration: none;
						color: white;
						border-radius: 0.5rem;
				"
				>Verify Account</a>
				<br><br>
			</body>
		</html>
		';

        $mail->MsgHTML($content); 
        $mail->Send();
    }
}
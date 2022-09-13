<?php
class Connect extends PDO{
    public function __construct(){
        parent::__construct("mysql:host=localhost;dbname=ecom_store", 'root', '',
		array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
}
class Controller {
    // check if user is logged in
    function checkUserStatus($id, $sess){
        $db = new Connect;
        $user = $db -> prepare("SELECT * FROM users WHERE email=:email'");
        $userInfo = mysqli_fetch_assoc($result);
        $token = $userInfo['token'];
        $userInfo = $user -> fetch(PDO::FETCH_ASSOC);
        if(!$userInfo["id"]){
            return FALSE;
        }else{
            return TRUE;
        }
    }
    
    function insertData($data){
        $db = new Connect;
        $checkUser = $db -> prepare("SELECT * FROM users WHERE email=:email");
        $checkUser -> execute(array(
            'email' => $data['email']
        ));
        $info = $checkUser -> fetch(PDO::FETCH_ASSOC);
        
        if(!$info["id"]){
            $session = $this -> generateCode(10);
            $insertNewUser = $db -> prepare("INSERT INTO users (email, first_name, last_name, gender, full_name, picture, verifiedEmail, token) VALUES (:email, :first_name, :last_name, :gender, :full_name, :picture, :verifiedEmail, :token)");
            $insertNewUser -> execute([
                ':email' => $data ['email'],
                ':first_name' => $data['givenName'],
                ':last_name' => $data['familyName'],
                ':gender' => $data['gender'],
                ':full_name' => $data['name'],
                ':picture' => $data['picture'],
                ':verifiedEmail' => $data['verifiedEmail'],
                ':token' => $data['id'],
            ]);
            if($insertNewUser){
                setcookie("id", $db->lastInsertId(), time()+60*60*24*30, "/", NULL);
                header('Location: login.php');
                exit();
            }else{
                return "Error inserting user!";
            }
        }else{
            setcookie("id", $info['id'], time()+60*60*24*30, "/", NULL);
            header('Location: login.php');
            exit();
        }
    }
}
?>
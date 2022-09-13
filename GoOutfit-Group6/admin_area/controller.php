<?php
require_once "config.php";
require_once "controller.Class.php";

if (isset($_GET['code'])) {
    $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
}else{
    header('Location: login.php');
    exit();
}

if(isset($token["error"]) && ($token["error"] != "invalid_grant")){
    // get data from google
    $oAuth = new Google_Service_Oauth2($gClient);
    $userData = $oAuth->userinfo_v2_me->get();

    //insert data in the database
    $Controller = new Controller;
    echo $Controller -> insertData(
        array(
    'email' => $userData['email'],
    'first_name' => $userData['givenName'],
    'last_name' => $userData['familyName'],
    'gender' => $userData['gender'],
    'full_name' => $userData['name'],
    'picture' => $userData['picture'],
    'verifiedEmail' => $userData['verifiedEmail'],
    'token' => $userData['id'],
        )
    );
}else{
    header('Location: login.php');
    exit();
}
?>

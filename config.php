<?php
require_once "google-api/vendor/autoload.php";
$gClient = new Google_Client();
$gClient->setClientId("1011122221876-jjrekvdrg9kev70cbkqhhp91mlommo1n.apps.googleusercontent.com");
$gClient->setClientSecret("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");
$gClient->setApplicationName("GoOutfit - authentication");
$gClient->setRedirectUri("http://localhost/GoOutfit/controller.php");
$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");

// login URL
$login_url = $gClient->createAuthUrl();
?>
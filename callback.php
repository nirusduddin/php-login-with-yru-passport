<?php
session_start();
require_once('YRUPassport.php');

$passport = new YRUPassport();

$code  = $_GET['code'];
$state = $_GET['state'];
$token = $passport->token($code, $state);

if ($token->access_token) {
    if ($profile = $passport->profile($token->access_token)) {
        $_SESSION["PASSPORT_PROFILE"] = $profile;
        header('location: index.php');
    } else {
        echo 'error: profile not found!';
    }
}
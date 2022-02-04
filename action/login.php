<?php


$kizaruLogin = 'test';
$kizaruPass = 'test';


$login = isset($_POST['login']) ? trim(strip_tags($_POST['login'])) : null;
$login = preg_replace("/[^a-zA-Z0-9\s]/", '', $login);
$password = isset($_POST['password']) ? trim(strip_tags($_POST['password'])) : null;
$password = preg_replace("/[^a-zA-Z0-9\s]/", '', $password);

if($login != $kizaruLogin || $password != $kizaruPass){
    header('Location: /');
}else{
    session_start();
    $_SESSION["login"] = $login;
    $_SESSION["password"] = $password;
    header('Location: /dashboard.php');
}
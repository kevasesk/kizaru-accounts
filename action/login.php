<?php


$kizaruLogin = 'test';
$kizaruPass = 'test';


$login = isset($_POST['login']) ? trim(strip_tags($_POST['login'])) : null;
$password = isset($_POST['password']) ? trim(strip_tags($_POST['password'])) : null;

if($login != $kizaruLogin || $password != $kizaruPass){
    header('Location: /');
}else{
    session_start();
    $_SESSION["login"] = $login;
    $_SESSION["password"] = $password;
    header('Location: /dashboard.php');
}
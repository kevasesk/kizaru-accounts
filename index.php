<?php
session_start();

if(isset($_SESSION["login"]) && isset($_SESSION["password"])){
    header("location: /dashboard.php");
    exit;
}
?>
<?php  include_once 'templates/head.php'; ?>
<form action="action/login.php" method="post">
    <input type="text" name="login">
    <input type="text" name="password">

    <button type="submit">Login</button>
</form>
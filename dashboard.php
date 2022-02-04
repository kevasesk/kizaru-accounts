<?php

session_start();

if(!isset($_SESSION["login"]) || !isset($_SESSION["password"])){
    header("location: /");
    exit;
}
?>
<html>
    <head>
        <?php  include_once 'templates/head.php'; ?>
    </head>
<body>
    <?php  include_once 'templates/logout.php'; ?>
    <?php  include_once 'templates/accountsGrid.php'; ?>
</body>
</html>








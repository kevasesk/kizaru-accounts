<?php

$id = isset($_POST['id']) ? trim(strip_tags($_POST['id'])) : null;
$login = isset($_POST['login']) ? trim(strip_tags($_POST['login'])) : null;
$password = isset($_POST['password']) ? trim(strip_tags($_POST['password'])) : null;
$active = isset($_POST['active']) ? trim(strip_tags($_POST['active'])) : null;
$isActionEdit = isset($_POST['action']) ? trim(strip_tags($_POST['action'])) : null;

$accounts = file_get_contents('../accounts.json') ? json_decode(file_get_contents('../accounts.json'), true) : [];

if($isActionEdit){
    //edit
    foreach ($accounts as $key => $account) {
        if ($account['id'] == $id) {
            $accounts[$key] = [
                'id' => $account['id'],
                'login' => $login,
                'password' => $password,
                'active' => (boolean)$active,
            ];
        }
    }
}else{
    //create
    $accounts[] = [
        'id' => end($accounts)['id'] + 1,
        'login' => $login,
        'password' => $password,
        'active' => (boolean)$active,
    ];
}


if(file_put_contents('../accounts.json', json_encode($accounts))){
    echo json_encode([
        'success' => true
    ]);exit;
}else{
    echo json_encode([
        'success' => false,
        'message' => 'Something going wrong while editing account'
    ]);exit;
}
<?php

try{
    $login = isset($_GET['login']) ? trim(strip_tags($_GET['login'])) : null;
    $password = isset($_GET['password']) ? trim(strip_tags($_GET['password'])) : null;

    if(!$login || !$password){
        echo json_encode([
            'success' => false
        ]);
        exit;
    }

    $accounts = file_get_contents('accounts.json') ? json_decode(file_get_contents('accounts.json'), true) : [];
    foreach ($accounts as $account){
        if($account['login'] == $login && $account['password'] == $password && $account['active']){
            echo json_encode([
                'success' => true
            ]);
            exit;
        }
    }

    echo json_encode([
        'success' => false
    ]);
    exit;
}catch (\Exception $e){
    echo json_encode([
        'success' => false
    ]);
    exit;
}


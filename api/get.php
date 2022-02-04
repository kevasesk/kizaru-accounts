<?php

try{
    $login = isset($_GET['username']) ? trim(strip_tags($_GET['username'])) : null;
    $login = preg_replace("/[^a-zA-Z0-9\s]/", '', $login);
    $password = isset($_GET['password']) ? trim(strip_tags($_GET['password'])) : null;
    $login = preg_replace("/[^a-zA-Z0-9\s]/", '', $password);

    if(!$login || !$password){
        echo json_encode([
            'success' => false
        ]);
        exit;
    }

    $accounts = file_get_contents('../accounts.json') ? json_decode(file_get_contents('../accounts.json'), true) : [];
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


<?php

$id = isset($_POST['id']) ? trim(strip_tags($_POST['id'])) : null;
$currentStatus = isset($_POST['currentStatus']) ? trim(strip_tags($_POST['currentStatus'])) : null;

$accounts = file_get_contents('../accounts.json') ? json_decode(file_get_contents('../accounts.json'), true) : [];
foreach ($accounts as $key => $account){
    if($account['id'] == $id){
        $accounts[$key]['active'] = !$currentStatus;
    }
}

if(file_put_contents('../accounts.json', json_encode($accounts))){
    echo json_encode([
        'success' => true
    ]);exit;
}else{
    echo json_encode([
        'success' => false,
        'message' => 'Something going wrong while editing status of account'
    ]);exit;
}
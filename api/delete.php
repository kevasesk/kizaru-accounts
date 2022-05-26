<?php

$id = isset($_POST['id']) ? trim(strip_tags($_POST['id'])) : null;
$accounts = file_get_contents('../accounts.json') ? json_decode(file_get_contents('../accounts.json'), true) : [];
if(count($accounts) == 1){
    echo json_encode([
        'success' => false,
        'message' => 'You cant delete last account. Create new one and then delete this.'
    ]);exit;
}
foreach ($accounts as $key => $account){
    if($account['id'] == $id){
        unset($accounts[$key]);
    }
}

if(file_put_contents('../accounts.json', json_encode($accounts))){
    echo json_encode([
        'success' => true
    ]);exit;
}else{
    echo json_encode([
        'success' => false,
        'message' => 'Something going wrong while deleting account'
    ]);exit;
}
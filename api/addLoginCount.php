<?php
$login = isset($_POST['login']) ? trim(strip_tags($_POST['login'])) : null;
$machine = isset($_POST['machine']) ? trim(strip_tags($_POST['machine'])) : null;
if(!$login || !$machine){
     echo json_encode([
        'success' => false,
        'message' => 'No login specified'
    ]);exit;
}
$accounts = file_get_contents('../accounts.json') ? json_decode(file_get_contents('../accounts.json'), true) : [];
 foreach ($accounts as $key => $account) {
    if ($account['login'] == $login) {
        if(!in_array($machine, $accounts[$key]['machine'])){
           $accounts[$key]['machine'][] = $machine; 
        }
    }
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
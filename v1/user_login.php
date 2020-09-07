<?php

require "../includes/DbOperations.php";

$result = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) 
    {
        $db = new DbOperations();
        $user = $db->log_in($_POST['username'], $_POST['password']);
        if (!empty($user)) {
            $result['error'] = false;
            $result['message'] = "You Are Login";
        }else {
            $result['error'] = true;
            $result['message'] = "You Are Not Login";
        }
    }else {
        $result['error'] = true;
        $result['message'] = "Required Fields Are Missing";
    }
}else {
    $result['error'] = true;
    $result['message'] = "You Do Not Have Permission";
}

echo json_encode($result);
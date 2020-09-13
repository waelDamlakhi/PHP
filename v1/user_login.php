<?php

require "../includes/DbOperations.php";

$result = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['username']) && isset($_POST['password'])) 
    {
        $db = new DbOperations();
        $user = $db->log_in($_POST['username'], $_POST['password']);
        if (!empty($user))
        {
            // $_SESSION['user_id'] = $user['Account_id'];
            $result['error'] = false;
            $result['id'] = $user['Account_id'];
            $result['username'] = $user['username'];
            $result['email'] = $user['email'];
            $result['password'] = $user['Password'];
            $result['phone'] = $user['phone'];
            $result['fullname'] = $user['fullname'];
            
        }
        else
        {
            $result['error'] = true;
            $result['message'] =  1;        //Access Deny
        }
    }
}
else
{
    $result['error'] = true;
    $result['message'] = 2;                  //You Do Not Have Permission
}

echo json_encode($result);
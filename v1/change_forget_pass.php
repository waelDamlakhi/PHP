<?php

require "../includes/DbOperations.php";

$result = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['email']) && isset($_POST['password'])) 
    {
        $db = new DbOperations();
        $db->Change_Pass($_POST['email'], $_POST['password']);
        $result['error'] = false;
        $result['message'] = 'Password Has Changed';
        
    }
}
else
{
    $result['error'] = true;
    $result['message'] = 2;             //You Do Not Have Permission
}

echo json_encode($result);
<?php

require "../includes/DbOperations.php";

$result = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['username']) && isset($_POST['password'])) 
    {
        $db = new DbOperations();
        $result = $db->log_in($_POST['username'], $_POST['password']);
        
    }
}
else
{
    $result['error'] = true;
    $result['message'] = 2;                  //You Do Not Have Permission
}

echo json_encode($result);
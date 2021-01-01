<?php

require "../includes/DbOperations.php";

$result = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['email'])) 
{
    
        $db = new DbOperations();
        $result = $db->email_validation($_GET['email']);
}
else
{
    $result['error'] = true;
    $result['message'] = 2;                  //You Do Not Have Permission
}

echo json_encode($result);
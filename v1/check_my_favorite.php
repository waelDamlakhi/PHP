<?php

require "../includes/DbOperations.php";

$result = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) 
{
    
        $db = new DbOperations();
        $result = $db->my_favorite($_GET['id']);
}
else
{
    $result['error'] = true;
    $result['message'] = 2;                  //You Do Not Have Permission
}

echo json_encode($result);
<?php

require "../includes/DbOperations.php";

$result = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && isset($_GET['myfavoritestatus']) && isset($_GET['Re_id'])) 
{
    
        $db = new DbOperations();
        $result = $db->check_favorite_status($_GET['id'], $_GET['myfavoritestatus'], $_GET['Re_id']);
}
else
{
    $result['error'] = true;
    $result['message'] = 2;                  //You Do Not Have Permission
}

echo json_encode($result);
<?php

require "../includes/DbOperations.php";

$result = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['Re_id']) && isset($_GET['property_type'])) 
{
    
        $db = new DbOperations();
        $result = $db->details_post($_GET['Re_id'], $_GET['property_type']);
}
else
{
    $result['error'] = true;
    $result['message'] = 2;                  //You Do Not Have Permission
}

echo json_encode($result);
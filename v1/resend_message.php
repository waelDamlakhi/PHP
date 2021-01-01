<?php

require "../includes/DbOperations.php";

$result = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['email']) && isset($_GET['message'])) 
{
        $db = new DbOperations();
        $db->send_email($_GET['email'], $_GET['message']);
        $result = $db->update_check_code_and_date($_GET['message'], $_GET['email']);
}
else
{
    $result['error'] = true;
    $result['message'] = 2;                  //You Do Not Have Permission
}
echo json_encode($result);

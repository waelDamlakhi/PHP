<?php

require "../includes/DbOperations.php";

$result = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['verify_code']) && isset($_POST['id']) && isset($_POST['date'])) 
{
        $db = new DbOperations();
        $result = $db->verify_code($_POST['verify_code'], $_POST['id'], $_POST['date']);
}
else
{
    $result['error'] = true;
    $result['message'] = 2;                  //You Do Not Have Permission
}

echo json_encode($result);
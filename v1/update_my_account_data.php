<?php

require "../includes/DbOperations.php";

$result = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['fullname']) && isset($_POST['password']) && isset($_POST['phone']) && isset($_POST['id'])) 
{
        $db = new DbOperations();
        $result = $db->update_my_account($_POST['fullname'], $_POST['password'], $_POST['phone'], $_POST['id']);
}
else
{
    $result['error'] = true;
    $result['message'] = 2;                  //You Do Not Have Permission
}

echo json_encode($result);
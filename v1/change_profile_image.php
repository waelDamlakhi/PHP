<?php

require "../includes/DbOperations.php";

$result = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image']['name']) && isset($_POST['id'])) 
{
        $db = new DbOperations();
        $result['pro_image'] = $db->change_profile_image($_FILES['image']['name'], $_POST['id'], $_FILES['image']['tmp_name']);
}
else
{
    $result['error'] = true;
    $result['message'] = 2;                  //You Do Not Have Permission
}

echo json_encode($result);
<?php

require "../includes/DbOperations.php";

$result = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['password'])) 
    {
        $db = new DbOperations();
        $bool = $db->sign_up($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['password'], $_POST['message']);
        if ($bool == "true") {
            $db->send_email($_POST['email'], $_POST['message']);
            $result = $db->checkuserexist($_POST['email']);
            mkdir("../images/" . $result['Account_id']);
        }
        else {
            $result = $bool;
        }
    }
}
else
{
    $result['error'] = true;
    $result['message'] = 2;                  //You Do Not Have Permission
}

echo json_encode($result);
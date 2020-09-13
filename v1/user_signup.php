<?php

require "../includes/DbOperations.php";

$result = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['password'])) 
    {
        $db = new DbOperations();
        $db->sign_up($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['password']);
        $headers = array
            (
                'From' => 'aqar.sy.info@gmail.com',
                'Reply-To' => 'aqar.sy.info@gmail.com',
                'X-Mailer' => 'PHP/' . phpversion()
            );
        mail($_POST['email'], 'passcode', $_POST['message'], $headers);
        $result['error'] = false;
        
    }
}
else
{
    $result['error'] = true;
    $result['message'] = 2;                  //You Do Not Have Permission
}

echo json_encode($result);
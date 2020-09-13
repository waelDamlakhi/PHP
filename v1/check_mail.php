<?php

require "../includes/DbOperations.php";

$result = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['email'])) 
    {
        $db = new DbOperations();
        $user = $db->forget_Pass($_POST['email']);
        if ($user > 0)
        {
            $headers = array
            (
                'From' => 'mr.wael.mwd@gmail.com',
                'Reply-To' => 'mr.wael.mwd@gmail.com',
                'X-Mailer' => 'PHP/' . phpversion()
            );
            mail($_POST['email'], 'passcode', $_POST['message'], $headers);
            $result['error'] = false;
        }
        else
        {
            $result['error'] = true;
            $result['message'] = 1;               //Wrong Email
        }
    }
}
else
{
    $result['error'] = true;
    $result['message'] = 2;                       //You Do Not Have Permission
}

echo json_encode($result);
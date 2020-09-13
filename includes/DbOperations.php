<?php
class DbOperations
{
    private $con;

    // Construct For Create Connect To DataBase
    function __construct()
    {
        require 'DbConnect.php';
        $db = new DbConnect();
        $this->con = $db->connect();
        
    }

    // Check Log In Function
    public function log_in(string $account, string $pass)
    {
        $stamt = $this->con->prepare("SELECT * FROM user_account WHERE password = ? AND username = ? OR email = ?");
        $stamt->execute(array( $pass, $account, $account));
        return $stamt->fetch();
    }

    // Forget Password Function To Check Email Exsit
    public function forget_Pass(string $email)
    {
        $stamt = $this->con->prepare("SELECT * FROM user_account WHERE email = ?");
        $stamt->execute(array($email));
        return $stamt->rowCount();
    }

    // Change Forget Password Function 
    public function Change_Pass(string $email, string $pass)
    {
        $stamt = $this->con->prepare("UPDATE user_account SET password = ? WHERE email = ?");
        $stamt->execute(array($pass, $email));
    }

    // Change Forget Password Function 
    public function sign_up(string $fname, string $lname, string $email, string $pass)
    {
        $fullname = $fname . ' ' . $lname;
        $stamt = $this->con->prepare("INSERT INTO user_account(fullname, email, password) VALUES(:zfull, :zemail, :zpass)");
        $stamt->execute(array(
            'zfull' => $fullname,
            'zemail' => $email,
            'zpass' => $pass
        ));
    }
}
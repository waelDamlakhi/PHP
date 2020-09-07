<?php
class DbOperations
{
    private $con;
    function __construct()
    {
        require 'DbConnect.php';
        $db = new DbConnect();
        $this->con = $db->connect();
        
    }

    public function log_in(string $account, string $pass)
    {
        $stamt = $this->con->prepare("SELECT * FROM user_account WHERE password = ? AND username = ? OR email = ?");
        $stamt->execute(array( $pass, $account, $account));
        return $stamt->fetch();
    }
}
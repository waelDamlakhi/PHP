<?php
class  DbConnect
{
    private $con;
    private $dsn;
	private $user;
	private $pass;
	private $option = array();
    function __construct()
    {
        $this->dsn = 'mysql:host=localhost;dbname=real_estate_store';
        $this->user ='root';
        $this->pass = '';
        $this->option = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    }

    function connect()
    {
        try {
            $this->con = new PDO($this->dsn, $this->user, $this->pass, $this->option);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    
        catch(PDOException $e) {
            echo 'Failed To Connect' . $e->getMessage();
        }
        return $this->con;
    }
}
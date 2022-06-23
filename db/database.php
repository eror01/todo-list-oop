<?php 

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_DATABASE','todo_oop');

class Database 
{

  public function __construct()
  {
    $connect = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)    ;

    if($connect->connect_error) 
    {
      die("<h1>Database Connection Failed</h1>");
    }
    return $this->connect = $connect;
  }

}


?>
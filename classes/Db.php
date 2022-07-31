<?php 

class Db
{

  private $dbhost = "localhost"; 
  private $dbuser = "root"; 
  private $dbpass = ""; 
  private $dbname = "todo_oop"; 

  public function __construct()
  {
    try {
      $dbh = new PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname, $this->dbuser, $this->dbpass);
      return $dbh;
    } catch (PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";
      die();
    }
  }

  // public function connect()
  // {
  //   try {
  //     $username = 'root';
  //     $password = '';
  //     $dbh = new PDO('mysql:host=localhost;dbname=todo_oop;', $username, $password);
  //     return $dbh;
  //   } catch (PDOException $e) {
  //     print "Error!: " . $e->getMessage() . "<br/>";
  //     die();
  //   }
  // }
}
<?php

class LoginController extends Login
{

  private $username;
  private $password;

  public function __construct($username, $password)
  {
    $this->username = $username;
    $this->password = $password;
  }

  public function loginUser()
  {
    $this->getUser($this->username, $this->password);
    header("Location: index.php");
  }

  
  private function emptyInput()
  {
    if(empty($this->username) || empty($this->password)) {
      $this->errors[] = 'Input is empty!';
    } 
    return $this->errors;
  }
}
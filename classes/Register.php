<?php

class Register extends Db
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db;  
  }

  protected function registerUser($username, $email, $role, $password)
  {
    $stmt = $this->connect()->prepare('INSERT INTO users(user_name, user_password, user_email, user_role ) VALUES(?, ?, ?, ?);');

    // hashed password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if(!$stmt->execute(array($username, $hashedPassword, $email, $role))) {
      $stmt = null;
      header("Location: ../registration.php?error=stmtfailed");
      exit();
    }
    $stmt = null;
  }

  protected function checkIfUserExists($username, $email)
  {
    $stmt = $this->connect()->prepare('SELECT user_name FROM users WHERE user_name = ? OR user_email = ?;');

    if(!$stmt->execute(array($username, $email))) {
      $stmt = null;
      header("Location: ../index.php?error=stmtfailed");
      exit();
    }

    $resultCheck = false;
    if($stmt->rowCount() > 0) {
      $resultCheck;
    } else {
      $resultCheck = true;
    }
    return $resultCheck;
  }

}
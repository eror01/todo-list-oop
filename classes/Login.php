<?php

class Login extends Db
{

  protected function getUser($username, $password)
  {
    $stmt = $this->connect()->prepare('SELECT user_password FROM users WHERE user_name = ? OR user_email = ?;');

    if(!$stmt->execute(array($username, $password))) {
      $stmt = null;
      header("Location: login.php?error=stmtfailed");
      exit();
    }

    if($stmt->rowCount() == 0) {
      $stmt = null;
      header("Location: login.php?error=user_not_found");
      exit();
    }
    
    $passwordHash = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $checkPassword = password_verify($password, $passwordHash[0]['user_password']);

    if($checkPassword == false) {
      $stmt = null;
      header("Location: login.php?error=wrong_password");
      exit();
    } elseif($checkPassword == true) {
      $stmt = $this->connect()->prepare('SELECT * FROM users WHERE user_name = ? OR user_email = ? AND user_password = ?;');

      if(!$stmt->execute(array($username, $username, $password))) {
        $stmt = null;
        header("Location: login.php?error=stmtfailed");
        exit();
      }

      if($stmt->rowCount() == 0) {
        $stmt = null;
        header("Location: login.php?error=user_not_found");
        exit();
      }

      $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

      session_start();
      $_SESSION['userID'] = $user[0]['user_id'];
      $_SESSION['username'] = $user[0]['user_name'];
      $_SESSION['userRole'] = $user[0]['user_role'];
      $_SESSION['loggedIn'] = true;
      $stmt = null;
    }

  }

}
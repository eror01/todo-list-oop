<?php

class RegisterController extends Register
{

  private $username;
  private $email;
  private $role;
  private $password;
  private $cpassword;
  private $errors = array();

  public function __construct($username, $email, $role, $password, $cpassword)
  {
    $this->username = $username;
    $this->email = $email;
    $this->role = $role;
    $this->password = $password;
    $this->cpassword = $cpassword;
  }

  public function validateUser()
  {
    if($this->emptyInput() == false) {}
    if($this->invalidUsername() == false) {}
    if($this->invalidEmail() == false) {}
    if($this->passwordMatch() == false) {}
    if($this->passwordValid() == false) {}
    if($this->usernameAlreadyTaken() == false) {}
    if(count($this->errors) > 0) {
      foreach($this->errors as $error) {
        echo '<div class="alert alert-danger mb-0" role="alert">'
          . $error . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      }
    } else {
      $this->registerUser($this->username, $this->email, $this->role, $this->password);
      header("Location: login.php?registration=success");
    }
  }
  
  private function emptyInput()
  {
    if(empty($this->username) || empty($this->email) || empty($this->password) || empty($this->cpassword)) {
      $this->errors[] = 'Input is empty!';
    } 
    return $this->errors;
  }

  private function invalidUsername()
  {
    if(!preg_match("/^[a-zA-z]*$/", $this->username)) {
      $this->errors[] = 'Only alphabets and whitespace are allowed.';
    }
    return $this->errors;
  }

  private function invalidEmail()
  {
    if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
      $this->errors[] = 'Email invalid. Please enter a valid email!';
    }
    return $this->errors;
  }

  private function passwordMatch()
  {
    if($this->password !== $this->cpassword)  {
      $this->errors[] = 'Passwords do not match!';
    }
    return $this->errors;
  }

  private function passwordValid()
  {
    $uppercase = preg_match('@[A-Z]@', $this->password);
    $lowercase = preg_match('@[a-z]@', $this->password);
    $number    = preg_match('@[0-9]@', $this->password);
    $specialChars = preg_match('@[^\w]@', $this->password);
    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($this->password) < 8) {
      $this->errors[] = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
    }
    return $this->errors;
  }

  private function usernameAlreadyTaken()
  {
    if(!$this->checkIfUserExists($this->username, $this->email))  {
      $this->errors[] = 'Username is already taken. Please try another username!';
    }
    return $this->errors;
  }

}
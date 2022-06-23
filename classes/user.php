<?php  

class User 
{

  private $errors = array();

  public function register($POST)
  {

    var_dump($POST);
    print_r($POST);

    // save to database
    if(count($this->errors) == 0 )  {
      // only save to the database if no errors
    }
    return $this->errors;

  }

}


?>
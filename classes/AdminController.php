<?php

include "Admin.php";

class AdminController extends Admin
{

  public function displayFourUsersAndItemCount()
  {
    $this->getFourUsersAndItemCount();
  }

  public function displayFourTodoItems()
  {
    $this->getFourTodoItems();
  }

  public function displayAllUserInfo()
  {
    $this->getAllUserInfo();
  }

}
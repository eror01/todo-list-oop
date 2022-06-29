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

  public function deleteUser($user_id)
  {
    $this->deleteUserWithID($user_id);
  }

  public function editUser($user_id)
  {
    $this->getUserInfo($user_id);
  }

  public function displayUpdatedUsernameAndRole($username, $user_id, $role)
  {
    $this->updateUsernameAndRole($username, $user_id, $role);
  }

  public function displayAllUserTodos($user_id)
  {
    $this->getAllUserTodos($user_id);
  }

  public function displayUsername($user_id)
  {
    $this->getUsername($user_id);
  }

  public function displayAllTodosWithPagination($per_page, $page_1)
  {
    $this->getAllTodosAndPaginate($per_page, $page_1);
  }

}
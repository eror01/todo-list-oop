<?php
include "Db.php";

class Admin extends Db 
{
  public $username;
  public $user_email;
  public $user_role;
  public $user_todo_count;
  public $user_id;

  protected function getFourUsersAndItemCount()
  {
    $stmt = $this->connect()->query('SELECT * FROM users WHERE NOT user_role = "admin" ORDER BY user_list_count DESC LIMIT 4;');
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row) {
      $username = $row['user_name'];
      $user_list_count = $row['user_list_count'];
      $username = ucfirst($username);
      echo "<li class='list-group-item d-flex justify-content-between'><span>{$username}</span> <span class='text-info'>Todo Item Count: {$user_list_count}</span></li>";
    }
  }

  protected function getFourTodoItems()
  {
    $stmt = $this->connect()->query('SELECT * FROM todos LIMIT 4');
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row) {
      $todo_content = $row['todo_content'];
      $todo_content = ucfirst($todo_content);
      echo "<li class='list-group-item'>{$todo_content}</li>";
    }
  }

  protected function setFieldValues($username, $email, $role, $count, $userId)
  {
    $this->username = $username;
    $this->user_email = $email;
    $this->user_role = $role;
    $this->user_todo_count = $count;
    $this->user_id = $userId;
  }

  protected function getAllUserInfo()
  {
    $stmt = $this->connect()->query('SELECT * FROM users WHERE NOT user_role = "admin";');
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $userArr[] = $row;
      
      // $username = $row['user_name'];
      // $user_id = $row['user_id'];
      // $user_email = $row['user_email'];
      // $user_role = $row['user_role'];
      // $user_todo_count = $row['user_list_count'];
      // $this->setFieldValues($username, $user_email, $user_role, $user_todo_count, $user_id );
    }
  }

}
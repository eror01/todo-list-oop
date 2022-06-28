<?php
include "Db.php";

class Admin extends Db 
{
  public $userArr;

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

  protected function setArray($row)
  {
    $this->userArr = array($row);
  }

  protected function getAllUserInfo()
  {
    $stmt = $this->connect()->query('SELECT * FROM users WHERE NOT user_role = "admin";');
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $this->userArr[] = $row;
    }
  }

}
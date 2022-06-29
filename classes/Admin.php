<?php
include "Db.php";

class Admin extends Db 
{
  public $userAllArr;
  public $userSingleArr; 
  public $userTodoArr;
  public $username;
  public $todoCount;
  public $userAllTodosArr;

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

  protected function setUserAllArray($row)
  {
    $this->userAllArr = array($row);
  }

  protected function setUserSingleArray($row)
  {
    $this->userSingleArr = array($row);
  }

  protected function setUserTodoArray($row)
  {
    $this->userTodoArr = array($row);
  }

  protected function setUsername($username) 
  {
    $this->username = $username;
  }

  protected function setCount($count)
  {
    $this->todoCount = $count;
  }

  protected function setAllTodosArr($row)
  {
    $this->userAllTodosArr = array($row);
  }

  protected function getAllUserInfo()
  {
    $stmt = $this->connect()->query('SELECT * FROM users WHERE NOT user_role = "admin";');
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $this->userAllArr[] = $row;
    }
  }

  protected function deleteUserWithID($user_id)
  {
    $stmt = $this->connect()->prepare('DELETE FROM users WHERE user_id = ?;');
    $stmt->execute(array($user_id));
    header("Location: all_users.php");
  }

  protected function getUserInfo($user_id)
  {
    $stmt = $this->connect()->prepare('SELECT * FROM users WHERE user_id = ?;');
    $stmt->execute(array($user_id));
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $this->userSingleArr[] = $row;
    }
  }

  protected function updateUsernameAndRole($username, $user_id, $role)
  {
    $stmt = $this->connect()->prepare('UPDATE users SET user_name = ?,  user_role = ? WHERE user_id = ?;');
    $stmt->execute(array($username, $role, $user_id));
    header("Location: all_users.php");
  }

  protected function getUsername($user_id)
  {
    $stmt = $this->connect()->prepare('SELECT user_name FROM users WHERE user_id = ?;');
    $stmt->execute(array($user_id));
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $this->setUsername($row['user_name']);
    }
  }

  protected function getAllUserTodos($user_id)
  {
    $stmt = $this->connect()->prepare('SELECT * FROM todos WHERE todo_user_id = ?;');
    $stmt->execute(array($user_id));
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $this->userTodoArr[] = $row;
    }
  }

  protected function getAllTodosAndPaginate($per_page, $page_1)
  {
    $stmt = $this->connect()->prepare('SELECT * FROM todos');
    $stmt->execute();
    if($stmt->rowCount() > 0) {
      $result = $stmt->rowCount();
      $result = ceil($result / $per_page);
      $this->setCount($result);
    }

    $stmt = $this->connect()->prepare('SELECT * FROM todos LIMIT ?, ?');
    $stmt->bindParam(1, $page_1, PDO::PARAM_INT);
    $stmt->bindParam(2, $per_page, PDO::PARAM_INT);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $this->userAllTodosArr[] = $row;
    }
  }

}
<?php 
include "Db.php";

class Todo extends Db
{

  public $todoContent;
  public $todoItemCount; 
  public $todoNotCompleteArr;
  public $todoIsCompleteArr;


  protected function setTodoContent($todoContent)
  {
    $this->todoContent = $todoContent;
  }

  protected function setTodoItemCount($count)
  {
    $this->todoItemCount = $count;
  }

  protected function setTodoNotCompleteArray($row)
  {
    $this->todoNotCompleteArr = array($row);
  }

  protected function setTodoIsCompleteArray($row)
  {
    $this->todoIsCompleteArr = array($row);
  }

  protected function createTodo($todo_content, $todo_author, $todo_user_id) 
  {
    $stmt = $this->connect()->prepare('INSERT INTO todos(todo_content, todo_author, todo_user_id) VALUES(?, ?, ?);');
    $stmt->execute(array($todo_content, $todo_author, $todo_user_id));
  }

  protected function getTodosNotCompleted($session_id, $isCompleted = false)
  {
    $stmt = $this->connect()->prepare('SELECT * FROM todos WHERE todo_user_id = ? AND todo_is_completed = ?;');

    $stmt->execute(array($session_id, $isCompleted));

    if($stmt->rowCount() == 0) {
      echo "<h2 class='text-center'>No Todo Items!</h2>";
    } else {
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $this->todoNotCompleteArr[] = $row;
      }
    }
  }

  protected function getTodoContent($todo_edit_id, $session_id)
  {
    $stmt = $this->connect()->prepare('SELECT * FROM todos WHERE todo_id = ? AND todo_user_id = ?;');
    $stmt->execute(array($todo_edit_id, $session_id));
    $results = $todo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($results as $row) {
      $todo_content = $row['todo_content'];
      $this->setTodoContent($todo_content);
    }
  }

  protected function updateTodo($todo_id, $todo_content_updated)
  {
    $stmt = $this->connect()->prepare('UPDATE todos SET todo_content = ? WHERE todo_id = ?;');
    $stmt->execute(array($todo_content_updated, $todo_id));
    header("Location: index.php");
  }

  protected function removeTodoItem($todo_id, $user_id)
  {
    $stmt = $this->connect()->prepare('DELETE FROM todos WHERE todo_id = ? AND todo_user_id = ?');
    $stmt->execute(array($todo_id, $user_id));
    header("Location: index.php");
  }

  protected function updateTodoIsCompleted($is_completed, $todo_is_completed = 0)
  {
    $stmt = $this->connect()->prepare('UPDATE todos SET todo_is_completed = ? WHERE todo_id = ?');
    $stmt->execute(array($todo_is_completed = 1, $is_completed));
    header("Location: index.php");
  }

  protected function undoTodoIsCompleted($user_id, $todo_is_completed = 0)
  {
    $stmt = $this->connect()->prepare('UPDATE todos SET todo_is_completed = ? WHERE todo_id = ?;');
    $stmt->execute(array($todo_is_completed, $user_id));
    header("Location: index.php");
  }

  protected function getTodosIsCompleted($session_id, $todo_is_completed = 1) 
  {
    $stmt = $this->connect()->prepare('SELECT * FROM todos WHERE todo_user_id = ? AND todo_is_completed = ? ');
    $stmt->execute(array($session_id, $todo_is_completed));
    if($stmt->rowCount() == 0) {
      echo "<h2 class='text-center'>No completed todos</h2>";
    } else {
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $this->todoIsCompleteArr[] = $row;
      }
    }
  }

  protected function getTodoItemCount($user_id)
  {
    $stmt = $this->connect()->prepare('SELECT COUNT(*) FROM todos WHERE todo_user_id = ?;');
    $stmt->execute(array($user_id));
    $counter = $stmt->fetchColumn();
    $this->setTodoItemCount($counter);
  }

  protected function updateUserListItemCount($user_id)
  {
    $this->getTodoItemCount($user_id);
    $count = $this->todoItemCount;
    $stmt = $this->connect()->prepare('UPDATE users SET user_list_count = ?WHERE user_id = ?;');
    $stmt->execute(array($count, $user_id));
  }
}
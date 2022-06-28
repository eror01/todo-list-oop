<?php 
include "Db.php";

class TodoController extends Db
{

  public $todoContent;
  public $todoItemCount; 

  // function createTodo(todo_content, $todo_author, $todo_user_id)
  public function createTodo($todo_content, $todo_author, $todo_user_id) 
  {
    $stmt = $this->connect()->prepare('INSERT INTO todos(todo_content, todo_author, todo_user_id) VALUES(?, ?, ?);');
    $stmt->execute(array($todo_content, $todo_author, $todo_user_id));
  }
  // function showTodoNotComplete($current_session_user_id, iscompleted)
  public function showTodoNotCompleted($session_id, $isCompleted = false)
  {
    $stmt = $this->connect()->prepare('SELECT * FROM todos WHERE todo_user_id = ? AND todo_is_completed = ?;');

    $stmt->execute(array($session_id, $isCompleted));

    if($stmt->rowCount() == 0) {
      echo "<h2 class='text-center'>No Todo Items!</h2>";
    } else {
      $results = $todos = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($results as $row) {
        $todo_content = $row['todo_content'];
        $todo_id = $row['todo_id'];
        echo "<ul class='todo-list_list'>";
        echo "<li class='todo-list_item'>";
        echo "<p class='todo-list_title'>{$todo_content}</p>";
        echo "<a class='todo-list_link edit' href='index.php?edit={$todo_id}' data-bs-toggle='tooltip' data-bs-placement='top' title='Edit Todo'><i class='fa-solid fa-file-pen'></i></a>";
        echo "<a class='todo-list_link delete' href='index.php?delete={$todo_id}' data-bs-toggle='tooltip' data-bs-placement='top' title='Delete Todo'><i class='fa-solid fa-xmark'></i></a>";
        echo "<a class='todo-list_link completed' href='index.php?is_completed={$todo_id}' data-bs-toggle='tooltip' data-bs-placement='top' title='Completed'><i class='fa-solid fa-check'></i></a>";
        echo "</li>";
        echo "</ul>";
      }
    }
  }
  
  // set Todo Content to display it in input
  public function setTodoContent($todoContent)
  {
    $this->todoContent = $todoContent;
  }

  // get Todo Content from database and loop over it and setTodoContent
  public function getTodoContent($todo_edit_id, $session_id)
  {
    $stmt = $this->connect()->prepare('SELECT * FROM todos WHERE todo_id = ? AND todo_user_id = ?;');
    $stmt->execute(array($todo_edit_id, $session_id));
    $results = $todo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($results as $row) {
      $todo_content = $row['todo_content'];
      $this->setTodoContent($todo_content);
    }
  }
 
  // update Todo
  public function updateTodo($todo_id, $todo_content_updated)
  {
    $stmt = $this->connect()->prepare('UPDATE todos SET todo_content = ? WHERE todo_id = ?;');
    $stmt->execute(array($todo_content_updated, $todo_id));
    header("Location: index.php");
  }

  // delete Todo
  public function deleteTodo($todo_id, $user_id)
  {
    $stmt = $this->connect()->prepare('DELETE FROM todos WHERE todo_id = ? AND todo_user_id = ?');
    $stmt->execute(array($todo_id, $user_id));
    header("Location: index.php");
  }

  // update Todo to completed
  public function updateTodoIsCompleted($is_completed, $todo_is_completed = 0)
  {
    $stmt = $this->connect()->prepare('UPDATE todos SET todo_is_completed = ? WHERE todo_id = ?');
    $stmt->execute(array($todo_is_completed = 1, $is_completed));
    header("Location: index.php");
  }

  // undo Todo that is Completed
  public function undoIsCompleted($user_id, $todo_is_completed = 0)
  {
    $stmt = $this->connect()->prepare('UPDATE todos SET todo_is_completed = ? WHERE todo_id = ?;');
    $stmt->execute(array($todo_is_completed, $user_id));
    header("Location: index.php");
  }

  // show Todos which are completed
  public function showTodoIsComplete($session_id, $todo_is_completed = 1) 
  {
    $stmt = $this->connect()->prepare('SELECT * FROM todos WHERE todo_user_id = ? AND todo_is_completed = ? ');
    $stmt->execute(array($session_id, $todo_is_completed));
    if($stmt->rowCount() == 0) {
      echo "<h2 class='text-center'>No completed todos</h2>";
    } else {
      $results = $todoCompleted = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($results as $row) {
        $todo_id = $row['todo_id'];
        $todo_content = $row['todo_content'];
        $todo_content = ucfirst($todo_content);
        echo "<ul class='todo-list_list'>";
        echo "<li class='todo-list_item' style='background-color: #DCDCDC;'>";
        echo "<p class='todo-list_title text-decoration-line-through'>{$todo_content}</p>";
        echo "<a class='todo-list_link undo' href='index.php?is_completed_undo={$todo_id}' data-bs-toggle='tooltip' data-bs-placement='top' title='Undo'><i class='fa-solid fa-rotate-left'></i></a>";
        echo "</li>";
        echo "</ul>";
      }
    }
  }

  public function setTodoItemCount($count)
  {
    $this->todoItemCount = $count;
  }

  public function getTodoItemCount($user_id)
  {
    $stmt = $this->connect()->prepare('SELECT COUNT(*) FROM todos WHERE todo_user_id = ?;');
    $stmt->execute(array($user_id));
    $counter = $stmt->fetchColumn();
    $this->setTodoItemCount($counter);
  }

  public function updateUserListItemCount($user_id)
  {
    $this->getTodoItemCount($user_id);
    $count = $this->todoItemCount;
    $stmt = $this->connect()->prepare('UPDATE users SET user_list_count = ?WHERE user_id = ?;');
    $stmt->execute(array($count, $user_id));
  }

}
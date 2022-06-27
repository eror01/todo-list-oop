<?php 
include "Db.php";

class TodoController extends Db
{

  public $todoContent;
  // #### CRUD ####
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
  public function setTodoContent($todoContent)
  {
    $this->todoContent = $todoContent;
  }
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
  // function updateTodo($_GET[id], $_Session[id], todo-content_updated)
  public function updateTodo($todo_id, $session_id, $todo_content_updated)
  {

  }
  // function deleteTodo($_GET[id], $_Session[id])
  // function updateTodoIsCompleted($_GET[id], todo_is_completed, $_Session[id])
  // function showTodoIsComplete($_SESSION[id])
  // function undoIsCompleted($_GET[id], $_SESSION[id]);
  


}
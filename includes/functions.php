<?php
include "classes/TodoController.php";



function createTodo() 
{   
  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $userID = $_SESSION['userID'];
  }
    if (isset($_POST['create_todo'])) {
      $todo_content = $_POST['todo-content'];
      $todo_author = $username;
      $todo_content = stripslashes($todo_content);
      $todoCreate = new TodoController();
      $todoCreate->createTodo($todo_content, $todo_author, $userID);
    }
}

function deleteTodo()
{
  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $userID = $_SESSION['userID'];
  }
  if(isset($_GET['delete'])) {
    $todo_id = $_GET['delete'];
    $todoDelete = new TodoController();
    $todoDelete->deleteTodo($todo_id, $userID);
  }
}

function updateTodoIsCompleted()
{
  if(isset($_GET['is_completed'])) {
    $is_completed = $_GET['is_completed'];
    $todoIsCompleted = new TodoController();
    $todoIsCompleted->updateTodoIsCompleted($is_completed);
  }
}

function showTodoNotComplete()
{
  if (isset($_SESSION['username'])) {
    $userID = $_SESSION['userID'];
    $todoNotComplete = new TodoController();
    $todoNotComplete->showTodoNotCompleted($userID);
  }
}

function showTodosComplete()
{
  if (isset($_SESSION['username'])) {
    $userID = $_SESSION['userID'];
    $todoCompleted = new TodoController();
    $todoCompleted->showTodoIsComplete($userID);
  }
}

function undoIsCompleted()
{
  if(isset($_GET['is_completed_undo'])) {
    $is_completed_undo = $_GET['is_completed_undo'];
    $todoUndoComplete = new TodoController();
    $todoUndoComplete->undoIsCompleted($is_completed_undo);
  }
}


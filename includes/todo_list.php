<?php
include "classes/TodoController.php";
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  $userID = $_SESSION['userID'];
  if (isset($_POST['create_todo'])) {
    $todo_content = $_POST['todo-content'];
    $todo_author = $username;
    $todo_content = stripslashes($todo_content);
    $todo = new TodoController();
    $todo->createTodo($todo_content, $todo_author, $userID);
  }
}
?>
<section class="todo-list" id="todo">
  <div class="row  justify-content-center mb-4">
    <div class="col-12">
      <h1 class="todo-list_user">
        <?php
        if ($username) {
          echo ucfirst($username) . "'s" . " Todo List";
        } ?>
        <p>Todo Item Count: <span class="badge bg-primary"><?php // echo $counter; ?></span></p>
      </h1>
    </div>
    <div class="col-10">
      <?php if (isset($_GET['edit'])) :
        $todo_edit_id = $_GET['edit']; 
        $todo = new TodoController(); 
        $todo->setTodoContent($todo_edit_id, $userID)?>
        <form action="" method="POST">
          <div class="input-group">
            <input type="text" class="form-control todo-input" value="<?php echo $todo->todoContent; ?>" name="todo-content_updated" id="todo-content" placeholder="Update your todo" required>
            <span class="input-group-btn">
              <button class="btn btn-dark" name="update_todo" type="submit">Update Todo</button>
            </span>
          </div>
        </form>
      <?php else : ?>
        <form action="" method="POST">
          <div class="input-group">
            <input type="text" class="form-control todo-input" name="todo-content" id="todo-content" placeholder="Create your todo item" required>
            <span class="input-group-btn">
              <button class="btn btn-dark" name="create_todo" type="submit">Add Todo</button>
            </span>
          </div>
        </form>
      <?php endif; ?>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-10">
      <?php

      if (isset($userID)) {
        $todoNotComplete = new TodoController();
        $todoNotComplete->showTodoNotCompleted($userID);
      }

      ?>
    </div>
  </div>
  <div class="row justify-content-center py-4 d-none">
    <div class="col-12">
      <h1 class="todo-list_user">Completed Todos</h1>
    </div>
    <div class="col-10">
    </div>
  </div>
</section>
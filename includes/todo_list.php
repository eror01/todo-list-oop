<?php
include "functions.php";
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  $userID = $_SESSION['userID'];
}
createTodo(); ?>
<section class="todo-list" id="todo">
  <div class="row  justify-content-center mb-4">
    <div class="col-12">
      <h1 class="todo-list_user">
        <?php
        if ($username) {
          echo ucfirst($username) . "'s" . " Todo List";
        } ?>
        <p>Todo Item Count: <span class="badge bg-primary">
          <?php 
          if(isset($userID)) {
            $userItemCount = new TodoController();
            $userItemCount->updateUserListItemCount($userID);
            echo $userItemCount->todoItemCount;
          } else {
            echo '0';
          }
          ?></span></p>
      </h1>
    </div>
    <div class="col-10">
      <?php if (isset($_GET['edit'])) :
        $todo_edit_id = $_GET['edit']; 
        $todoEdit = new TodoController(); 
        $todoEdit->getTodoContent($todo_edit_id, $userID); 

        if(isset($_POST['update_todo']))  {
          $todo_content_updated = $_POST['todo-content_updated'];
          $todoEdit->updateTodo($todo_edit_id, $todo_content_updated);
        }
        ?>
        <form action="" method="POST">
          <div class="input-group">
            <input type="text" class="form-control todo-input" value="<?php echo $todoEdit->todoContent; ?>" name="todo-content_updated" id="todo-content" placeholder="Update your todo" required>
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
      updateTodoIsCompleted();
      showTodoNotComplete(); ?>
    </div>
  </div>
  <div class="row justify-content-center py-4">
    <div class="col-12">
      <h1 class="todo-list_user">Completed Todos</h1>
    </div>
    <div class="col-10">
      <?php 
      showTodosComplete();     
      undoIsCompleted(); 
      deleteTodo(); ?>
    </div>
  </div>
</section>
<?php
  require_once 'todo.php';
  require_once 'check_string.php';
  require_once 'snackbar.php';
?>

<?php include 'header.php' ?>

<?php
  if(isset($_POST['submit'])) {
    $name = check_string($_POST['name']);
    $detail = check_string($_POST['detail']);

    try {
      $model = ToDo::create($name, $detail);
      mmm_snacks("TODO", "# " . $model->id . " created");
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage(). "<br/>";
      die();
    }
    
}
?>

  <h1>Create TODO</h1>
  <form action="create.php" method="POST">
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="Enter your TODO" >
      <small id="nameHelp" class="form-text text-muted">What do you need to get done?</small>
    </div>
    <div class="form-group">
      <label for="detail">Detail</label>
      <textarea class="form-control" id="detail" name="detail" rows="3"></textarea>
    </div>
    <button type="submit" name="submit" value="submit" class="btn btn-primary">Add</button>
  </form>

<?php include 'footer.php' ?>

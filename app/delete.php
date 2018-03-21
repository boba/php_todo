<?php
  require_once "todo.php";
  require_once "check_string.php";
  require_once "snackbar.php";
?>

<?php include "header.php" ?>

<?php

  if(isset($_GET['id'])){
    $id = check_string($_GET['id']);
  
    try {
      ToDo::delete($id);
      treatYoSelf("TODO", "Deleted");
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage(). "<br/>";
      die();
    }
    
  }
?>

<div class="row text-center">
  <div class="col-md-10 offset-md-1">
    <p class="text-center">You may be done, but there are always more cats!</p> 
  </div>
</div>
<div class="row text-center">
  <div class="col-md-10 offset-md-1">
    <a href="http://thecatapi.com"><img src="http://thecatapi.com/api/images/get?format=src&type=gif&size=med" class="center-block img-responsive"></a>
  </div>
</div>

<?php include "footer.php" ?>

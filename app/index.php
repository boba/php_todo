<?php require_once("todo.php"); ?>

<?php include 'header.php' ?>

<?php
  try {
    
    $models = Todo::all();
    
    foreach ($models as $model) {
      $id = $model->id;
      $name = $model->name;
      $detail = $model->detail;
      $created = $model->created;
      $modified = $model->modified;
      
      echo "<div class=\"row\">";
      echo "  <div class=\"col-sm-10\"><a href=\"detail.php?id=$model->id\">$model->name</a></div>";
      echo "  <div class=\"col-sm-1\"><button type=\"button\"><a href=\"edit.php?id=$model->id\">Edit</a></button></div>";
      echo "  <div class=\"col-sm-1\"><button type=\"button\"><a href=\"delete.php?id=$model->id\">Delete</a></button></div>";
      echo "</div>";
    }
    
  } catch (Exception $e) {
    echo "Error: " . $e->getMessage(). "<br/>";
    die();
  }
  
?>

<?php include 'footer.php' ?>

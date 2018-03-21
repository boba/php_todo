<?php

function db(){
  $dbh = new PDO('mysql:host=localhost;dbname=db_todo', "todo_user", "todo_password");
  return $dbh;
}
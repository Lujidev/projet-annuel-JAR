<?php
require "../lib.php";
require "libTodo.php";

$id_todo = $_POST["id"];

removeTodo($id_todo);

?>
<?php
require "../lib.php";
require "libTodo.php";

$id_todo = $_POST["id"];

doneTodoBdd($id_todo);

$db = dbConnect();
$query = $db->prepare("SELECT content FROM TODO WHERE id_todo = :id_todo");
$query->execute([
    "id_todo"=>$id_todo
]);
$res = $query->fetch();

echo $res['content'];

?>
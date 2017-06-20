<?php
require "../lib.php";
require "libTodo.php";

header("Content-Type: application/json");

$content = $_POST["todo"];
$team = $_POST["team"];

addTodoBdd($team,$content);
/*
$db = dbConnect();
$query = $db->prepare("SELECT id_todo FROM TODO ORDER BY id_todo DESC LIMIT 1");
$query->execute([
]);
$last_id = $query->fetch();*/
$last_id = getSqlLast("id_todo", "TODO");

//echo '<li title="'.$last_id.'" onclick="finishTodo('.$last_id.')" id="todo_'.$last_id.'">'.$content.'</li>';

$data = [
    "id"=>$last_id,
    "value"=>$content
];

echo json_encode($data);

?>
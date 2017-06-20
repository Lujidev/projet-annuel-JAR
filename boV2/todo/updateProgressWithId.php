<?php
require "../lib.php";
require "libTodo.php";

header("Content-Type: application/json");

$id = $_POST['id'];

$db = dbConnect();
$query = $db->prepare("SELECT team FROM TODO WHERE id_todo = :id_todo");
$query->execute([
    "id_todo"=>$id
]);
$team = $query->fetch();

$id_team = $team["team"];

$percent = calculPercentage($id_team);

echo json_encode($percent);



?>
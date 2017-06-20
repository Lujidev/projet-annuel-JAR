<?php
require "../lib.php";
require "libTodo.php";

header("Content-Type: application/json");

$id_team = $_POST['team'];

$percent = calculPercentage($id_team);

echo json_encode($percent);

?>
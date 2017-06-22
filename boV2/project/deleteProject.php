<?php
require "../lib.php";

$projectId = $_GET['id'];
$db = dbConnect();

$query1 = $db->prepare("DELETE FROM PROJETS WHERE id_projet=:id");
$query1->execute([
    "id"=>$projectId
]);

header("location: ../listProject.php");

?>
<?php
require "../lib.php";
require "libTeam.php";

$id_team = $_GET["id"];

$db = dbConnect();

$query = $db->prepare("DELETE FROM PROJETS WHERE id_team=:id");
$query->execute([
    "id"=>$id_team
]);


$query1 = $db->prepare("DELETE FROM EQUIPES WHERE id=:id");
$query1->execute([
    "id"=>$id_team
]);

header("location: ../manageTeam.php");
?>
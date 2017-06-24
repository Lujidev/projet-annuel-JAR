<?php
require "../lib.php";

$projectId = $_GET['projectId'];
$teamId = $_GET['teamId'];
$userId = $_GET['userId'];
$userRole = $_GET['userRole'];

$db = dbConnect();

$queryCheckCreator = $db->prepare("SELECT id FROM EQUIPES WHERE id = :id AND createur = :createur");
$queryCheckCreator->execute([
    "id"=>$teamId,
    "createur"=>$userId
]);

$isCreator = $queryCheckCreator->fetch();

if (!empty($isCreator) || $userRole == 3){
    $query1 = $db->prepare("DELETE FROM PROJETS WHERE id_projet=:id");
    $query1->execute([
        "id"=>$projectId
    ]);

    header("location: ../listProject.php");
}else{
    header("location: ../listProject.php");
}



?>
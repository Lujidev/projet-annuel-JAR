<?php
require "../lib.php";
require "libTeam.php";

$id_team = $_GET["id"];
$id_user = $_GET['userId'];

$db = dbConnect();

$queryCheck = $db->prepare("SELECT id FROM EQUIPES WHERE id=:id AND createur=:userId");

$queryCheck->execute([
    "id"=>$id_team,
    "userId"=>$id_user
]);

$ifUserIsCreator = $queryCheck->fetch();

if (!empty($ifUserIsCreator)){

    $query = $db->prepare("DELETE FROM PROJETS WHERE id_team=:id");
    $query->execute([
        "id"=>$id_team
    ]);

    $query2 = $db->prepare("DELETE FROM TEAMMATES WHERE id_team=:id");
    $query2->execute([
        "id"=>$id_team
    ]);

    $query1 = $db->prepare("DELETE FROM EQUIPES WHERE id=:id");
    $query1->execute([
        "id"=>$id_team
    ]);

    header("location: ../manageTeam.php");

}else{

    $query2 = $db->prepare("DELETE FROM TEAMMATES WHERE id_user=:id_user AND id_team = :id_team");
    $query2->execute([
        "id_user"=>$id_user,
        "id_team"=>$id_team
    ]);

    header("location: ../manageTeam.php");

}


?>
<?php
session_start();
require "../lib.php";
require "../project/libProject.php";
$user = isConnected();

$promot = $_GET['upgradeId'];
$teamId = $_GET['teamId'];

$isCreator = isCreatorOfTeam($teamId, $user['id_utilisateur']);

if (!empty($isCreator) || $user['droit']){

    $db = dbConnect();
    $query = $db->prepare("UPDATE EQUIPES SET createur = :createur WHERE id = :id");
    $query->execute([
        "id"=>$teamId,
        "createur"=>$promot
    ]);

}

header('Location: ../team.php?id='.$teamId);


?>
<?php
session_start();
require "lib.php";

$user = isConnected();

if (isset($_GET['upgradeId'])){
    $modifyId = $_GET['upgradeId'];
    $droit = 3;
}elseif (isset($_GET['downgradeId'])){
    $modifyId = $_GET['downgradeId'];
    $droit = 2;
}

if ($user['droit'] == 3){

    $db = dbConnect();
    $query = $db->prepare("UPDATE UTILISATEURS SET droit = :droit WHERE id_utilisateur = :id");
    $query->execute([
        "id"=>$modifyId,
        "droit"=>$droit
    ]);
}

header('Location: manageUser.php');

?>
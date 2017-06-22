<?php
require "../lib.php";
require "chatLib.php";

$db = dbConnect();

$query = $db->prepare("SELECT new_nb FROM CHATNOTIF WHERE id_user=:id_user AND id_team = :id_team");

$query->execute([
    "id_user"=>$_POST['userId'],
    "id_team"=>$_POST['teamId']
]);

$nb = $query->fetch();


$query1 = $db->prepare("UPDATE CHATNOTIF SET old_nb = :old_nb WHERE id_user=:id_user AND id_team = :id_team");

$query1->execute([
    "old_nb"=> $nb["new_nb"],
    "id_user"=>$_POST['userId'],
    "id_team"=>$_POST['teamId']
]);

?>
<?php
require "mpLib.php";
require "../lib.php";

$id = $_POST['id_mp'];
$sender_id = $_POST['id_sender'];

$db = dbConnect();

$query = $db->prepare("SELECT * FROM MESSAGESP WHERE id_mp = :id_mp");
$query->execute([
    "id_mp"=>$id
]);

$res = $query->fetch();


if ($res['destinataire_mp'] == $sender_id){
    $receiverId = $res['auteur_mp'];
}else{
    $receiverId = $res['destinataire_mp'];
}

$query2 = $db->prepare("SELECT pseudo FROM UTILISATEURS WHERE id_utilisateur = :id_utilisateur");

$query2->execute([
    "id_utilisateur"=>$receiverId
]);

$receiver = $query2->fetch();

//$data = $res;

$data = [
    "id_mp"=>$id,
    "subject"=>$res['sujet'],
    "content"=>$res['contenu_mp'],
    "receiver"=>$receiver['pseudo']
];

echo json_encode($data);


?>


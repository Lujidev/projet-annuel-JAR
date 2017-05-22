<?php
$user = isConnected();
$role = $user['droit']

$id = intval($_GET['id_mp']);

$db = dbConnect();

if ($role != '3'){
    $query = $db->prepare("SELECT * FROM MESSAGESP WHERE auteur_mp = :auteur");
    $query->execute([
        "auteur"=>$user['id_utilisateur']
    ]);
}
if ($role == '3'){
    $query = $db->prepare("SELECT * FROM MESSAGESP");
    $query->execute([
    ]);

}

$res = $query->fetchAll();

print_r($res);

?>

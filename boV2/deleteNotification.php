<?php
require "lib.php";

$id_notif = $_POST['id_notif'];

$db = dbConnect();

$query = $db->prepare("DELETE FROM NOTIFICATIONS WHERE id_notif=:id_notif");

$query->execute([
    "id_notif"=>$id_notif
]);

?>
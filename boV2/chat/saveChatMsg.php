<?php
require "../lib.php";
require "chatLib.php";

$db = dbConnect();

$query = $db->prepare(
    "INSERT INTO CHAT(msg_content, id_user, id_team) VALUES(:msg_content, :id_user, :id_team)"
);

$query->execute([
    "msg_content"=>$_POST['content'],
    "id_user"=>$_POST['userId'],
    "id_team"=>$_POST['teamId']
]);

?>
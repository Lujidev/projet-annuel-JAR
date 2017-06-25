<?php
require "../headerWeb.php";

    $id = $_GET["id"];

    $db = dbConnect();

    $query = $db->prepare("INSERT INTO LIKES (id_article, id_user) VALUES (?, ?)");
    $query->execute([
        $id,
        $user["id_utilisateur"]
    ]);
    $res = $query->fetch();


    $req = $db->prepare("UPDATE ARTICLES SET is_liked = is_liked + 1 WHERE id_article = id");
    $req->execute([$id]);






<?php


/**
 * @author: Jing LIN
 * @return: Retourne tous les Pc en options
 */
function displayAllPcAsOption(){

    $db = dbConnect();
    $query = $db->prepare("SELECT * FROM COMPUTER");
    $query->execute([
    ]);

    $res = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($res as $value){
        echo '<option id="'.$value["id_pc"].'">'.$value["name_pc"].'</option>';
    }

}

?>
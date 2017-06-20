<?php

function getMessages($user){
    $db = dbConnect();

    $query = $db->prepare("SELECT * FROM MESSAGESP WHERE destinataire_mp = :destinataire_mp AND is_deleted_destinataire = '0' ORDER BY date_publication_mp DESC");
    $query->execute([
        "destinataire_mp"=>$user
    ]);

    $res = $query->fetchAll();

    return $res;
}

function getSendedMessages($user){
    $db = dbConnect();

    $query = $db->prepare("SELECT * FROM MESSAGESP WHERE auteur_mp = :auteur_mp AND is_deleted_auteur = '0' ORDER BY date_publication_mp DESC");
    $query->execute([
        "auteur_mp"=>$user
    ]);

    $res = $query->fetchAll();

    return $res;
}

/**
 * @author: Jing LIN
 * @return: Affiche la list des messages privés.
 */

function messagesList($data, $id_user){

    $db = dbConnect();

    foreach ($data as $value){

        if ($value['auteur_mp'] == $id_user){
            $id = $value['destinataire_mp'];
        }else{
            $id = $value['auteur_mp'];
        }


        $query = $db->prepare("SELECT pseudo FROM UTILISATEURS WHERE id_utilisateur = :id_utilisateur");
        $query->execute([
            "id_utilisateur"=>$id
        ]);
        $user = $query->fetch();

        if ($value['is_read_mp'] == '1'){
            echo '<a href="#" onclick="getMP('.$value["id_mp"].','.$id_user.')">
                          <div class="mail_list">
                            <div class="left">
                              <i class="fa fa-envelope-o"></i>
                            </div> 
                            <div class="right">
                              <h3>'.$user["pseudo"].' <small>'.$value["date_publication_mp"].'</small></h3>
                              <p>'.substr($value['sujet'], 0, 75).'</p>
                            </div>
                          </div>
                        </a>';
        }else{
            echo '<a href="#" onclick="getMP('.$value["id_mp"].','.$id_user.')">
                          <div class="mail_list">
                            <div class="left">
                              <i class="fa fa-envelope"></i>
                            </div>
                            <div class="right">
                              <h3>'.$user["pseudo"].' <small>'.$value["date_publication_mp"].'</small></h3>
                              <p>'.substr($value['sujet'], 0, 75).'</p>
                            </div>
                          </div>
                        </a>';
        }


    }

}

/**
 * @author: Jing LIN
 * @return: Fonction qui update la colonne is_read_mp des messages privés.
 */

function is_read($msg ,$is_read){
    if ($is_read == '1'){
        $db = dbConnect();

        $query = $db->prepare(
            "UPDATE MESSAGESP SET is_read_mp ='1' WHERE id_mp=:id_mp"
        );

        $query->execute([
            "id_mp"=>$msg
        ]);

    }

}


?>



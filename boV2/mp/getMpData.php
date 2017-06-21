<?php
require "mpLib.php";
require "../lib.php";
/*$user = isConnected();
$role = $user['droit'];
*/
$id = intval($_POST['id_mp']);
$id_user = $_POST['id_user'];

// on Select toutes les données du message
$db = dbConnect();

    $query = $db->prepare("SELECT * FROM MESSAGESP WHERE id_mp = :id_mp");
    $query->execute([
        "id_mp"=>$id
    ]);

$res = $query->fetch();


if ($id_user == $res['auteur_mp']){

    // on select le pseudo de l'utilisateur auteur
    $id_destinataire = $res["destinataire_mp"];

    $query = $db->prepare("SELECT pseudo FROM UTILISATEURS WHERE id_utilisateur = :id_utilisateur");
    $query->execute([
        "id_utilisateur"=>$id_destinataire
    ]);
    $user = $query->fetch();


    $str_content = strval($res["contenu_mp"]);
    $str_subject = strval($res["sujet"]);

    $params = [
        $id_user,
        $res["destinataire_mp"],
        $id,
        true
    ];
    $anwser_params = "'".implode( "','",$params)."'";

    $transferParams = [
        $id_user,
        $res["destinataire_mp"],
        $id,
        false
    ];
    $transfer_params = "'".implode( "','",$transferParams)."'";

  echo '                  <div class="mail_heading row">
                            <div class="col-md-8 print_button">
                              <div class="btn-group">
                                <a class="fa fa-reply btn btn-sm btn-default" onclick="anwser('.$anwser_params.')" > Répondre</a>
                                <a class="fa fa-trash-o btn btn-sm btn-default" href="mp/deleteMp.php?id_mp='.$res['id_mp'].'&id='.$id_user.'"></a>
                                <a class="fa fa-print btn btn-sm btn-default" onclick="printMsg()"></a>
                                <a class="fa fa-share btn btn-sm btn-default" onclick="anwser('.$transfer_params.')"> Transférer</a>
                              </div>
                            </div>
                            <div class="col-md-4 text-right">
                              <p class="date">'.$res["date_publication_mp"].'</p>
                            </div>
                            <div class="col-md-12">
                              <h4>'.$res["sujet"].'</h4>
                            </div>
                          </div>
                          <div class="sender-info">
                            <div class="row">
                              <div class="col-md-12">
                                <strong>moi</strong>
                                 à
                                <strong>'.$user["pseudo"].'</strong>
                                <a class="sender-dropdown"><i class="fa fa-chevron-down"></i></a>
                              </div>
                            </div>
                          </div>
                          <div class="view-mail">
                           '.$res["contenu_mp"].'
                          </div>
                          ';
}else{

    //on met le mp comme étant lu
    is_read($res['id_mp'], $_POST['is_read_mp']);

    // on select le pseudo de l'utilisateur auteur
    $id_auteur = $res['auteur_mp'];

    $query = $db->prepare("SELECT pseudo FROM UTILISATEURS WHERE id_utilisateur = :id_utilisateur");
    $query->execute([
        "id_utilisateur"=>$id_auteur
    ]);
    $user = $query->fetch();

    $str_content = strval($res["contenu_mp"]);
    $str_subject = strval($res["sujet"]);

    $params = [
        $id_user,
        $res["auteur_mp"],
        $id,
        true
    ];
    $anwser_params = "'".implode( "','",$params)."'";

    $transferParams = [
        $id_user,
        $res["auteur_mp"],
        $id,
        false
    ];
    $transfer_params = "'".implode( "','",$transferParams)."'";



    echo '                  <div class="mail_heading row">
                            <div class="col-md-8 print_button">
                              <div class="btn-group">
                                <a class="fa fa-reply btn btn-sm btn-default" onclick="anwser('.$anwser_params.')"> Répondre</a>
                                <a class="fa fa-trash-o btn btn-sm btn-default" href="mp/deleteMp.php?id_mp='.$res['id_mp'].'&id='.$id_user.'"></a>
                                <a class="fa fa-print btn btn-sm btn-default" onclick="printMsg()"></a>
                                <a class="fa fa-share btn btn-sm btn-default" onclick="anwser('.$transfer_params.')"> Transférer</a>
                              </div>
                            </div>
                            <div class="col-md-4 text-right">
                              <p class="date">'.$res["date_publication_mp"].'</p>
                            </div>
                            <div class="col-md-12">
                              <h4>'.$res["sujet"].'</h4>
                            </div>
                          </div>
                          <div class="sender-info">
                            <div class="row">
                              <div class="col-md-12">
                                <strong>'.$user["pseudo"].'</strong>
                                 à
                                <strong>moi</strong>
                                <a class="sender-dropdown"><i class="fa fa-chevron-down"></i></a>
                              </div>
                            </div>
                          </div>
                          <div class="view-mail">
                           '.$res["contenu_mp"].'
                          </div>
                          ';

}





?>

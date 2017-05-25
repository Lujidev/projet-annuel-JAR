<?php
require "lib.php";
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


  echo '                  <div class="mail_heading row">
                            <div class="col-md-8">
                              <div class="btn-group">
                                <a class="fa fa-reply btn btn-sm btn-default" onclick="anwser('.$id_user.','.$res["destinataire_mp"].','.$res["contenu_mp"].','.$res["sujet"].')" > Répondre</a>
                                <a class="fa fa-trash-o btn btn-sm btn-default" href="deleteMp.php?id_mp='.$res['id_mp'].'&id='.$id_user.'"></a>
                                <a class="fa fa-print btn btn-sm btn-default" href="#"></a>
                                <a class="fa fa-share btn btn-sm btn-default" href="#"> Transférer</a>
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
                          <div class="attachment">
                            <p>
                              <span><i class="fa fa-paperclip"></i> Les pièces joints (pas encore fait) — </span>
                              <a href="#">Télécharger les pjs</a> |
                              <a href="#">regarder les images</a>
                            </p>
                            <ul>
                              <li>
                                <a href="#" class="atch-thumb">
                                  <img src="images/inbox.png" alt="img" />
                                </a>

                                <div class="file-name">
                                  image-name.jpg
                                </div>
                                <span>12KB</span>


                                <div class="links">
                                  <a href="#">View</a> -
                                  <a href="#">Download</a>
                                </div>
                              </li>

                            </ul>
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


    echo '                  <div class="mail_heading row">
                            <div class="col-md-8">
                              <div class="btn-group">
                                <a class="fa fa-reply btn btn-sm btn-default" "anwser('.$id_user.','.$res["auteur_mp"].','.$res["contenu_mp"].','.$res["sujet"].')"> Répondre</a>
                                <a class="fa fa-trash-o btn btn-sm btn-default" href="deleteMp.php?id_mp='.$res['id_mp'].'&id='.$id_user.'"></a>
                                <a class="fa fa-print btn btn-sm btn-default" href="#"></a>
                                <a class="fa fa-share btn btn-sm btn-default" href="#"> Transférer</a>
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
                          <div class="attachment">
                            <p>
                              <span><i class="fa fa-paperclip"></i> Les pièces joints (pas encore fait) — </span>
                              <a href="#">Télécharger les pjs</a> |
                              <a href="#">regarder les images</a>
                            </p>
                            <ul>
                              <li>
                                <a href="#" class="atch-thumb">
                                  <img src="images/inbox.png" alt="img" />
                                </a>

                                <div class="file-name">
                                  image-name.jpg
                                </div>
                                <span>12KB</span>


                                <div class="links">
                                  <a href="#">View</a> -
                                  <a href="#">Download</a>
                                </div>
                              </li>

                            </ul>
                          </div>
                          ';

}





?>

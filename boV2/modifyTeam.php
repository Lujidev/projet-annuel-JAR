<?php
/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 21/06/2017
 * Time: 23:53
 */

require "header.php";

if(!empty($_GET["id"])){
//Récupérer l'id en GET
    $db = dbConnect();
//Récupérer l'utilisateur en BDD
    $query = $db->prepare("SELECT * FROM EQUIPES WHERE id = :id" );
    $query->execute($_GET);
    $res_data = $query->fetch();

//Remplir la variable $form avec les données de la base
    if(!empty($res_data)){
//$form = $result;
        $form = [
            "id"=>$res_data["id"],
            "nom_equipe"=>$res_data["nom_equipe"],
            "description_equipe" => $res_data["description_equipe"]
        ];
    }
}

?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Modifier une Equipe</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <form role="form" method="POST" action="saveTeam.php?id=<?php echo (isset($form["id"]))?$form["id"]:""; ?>" enctype="multipart/form-data" class="form-horizontal form-label-left" novalidate>

                            <p>Veuillez remplir ce formulaire pour créer un Projet</p>
                            <span class="section">Info nécessaire</span>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nom de votre Equipe</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" name="nom_equipe" placeholder="Plus de 2 lettres" type="text"
                                           value="<?php echo(isset($form["nom_equipe"]) ? $form["nom_equipe"] : ""); ?>">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Description</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="textarea" name="description_equipe" class="form-control col-md-7 col-xs-12"><?php echo(isset($form["description_equipe"]) ? $form["description_equipe"] : ""); ?></textarea>
                                </div>
                            </div>
                            <!--<input type="hidden" name="from" value="modifierEquipe">-->
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="reset" class="btn btn-primary">Reset</button>
                                    <button id="send" type="submit" class="btn btn-success">Envoyer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->




<?php
include "footer.php";
?>

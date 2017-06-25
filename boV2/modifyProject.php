<?php
require "header.php";

if(!empty($_GET["id"])){
//Récupérer l'id en GET
    $db = dbConnect();
//Récupérer l'utilisateur en BDD
    $query = $db->prepare("SELECT * FROM PROJETS WHERE id_projet = :id" );
    $query->execute($_GET);
    $res_data = $query->fetch();

//Remplir la variable $form avec les données de la base
    if(!empty($res_data)){
//$form = $result;
        $form = [
            "id_projet"=>$res_data["id_projet"],
            "nom_projet"=>$res_data["nom_projet"],
            "img_projet" => $res_data["img_projet"],
            "description_projet"=>$res_data["description_projet"]
        ];
    }
}

?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Modifier un Projet</h3>
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

                        <form role="form" method="POST" action="saveProject.php?id=<?php echo (isset($form["id_projet"]))?$form["id_projet"]:""; ?>" enctype="multipart/form-data" class="form-horizontal form-label-left" novalidate>

                            <p>Veuillez remplir ce formulaire pour créer un Projet</p>
                            <span class="section">Info nécessaire</span>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nom de votre Projet</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" name="nom_projet" placeholder="Plus de 2 lettres" type="text"
                                           value="<?php echo(isset($form["nom_projet"]) ? $form["nom_projet"] : ""); ?>">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Votre image</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" name="image" required="required">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Description</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="textarea" name="description_projet" class="form-control col-md-7 col-xs-12"><?php echo(isset($form["description_projet"]) ? $form["description_projet"] : ""); ?></textarea>
                                </div>
                            </div>
                            <input type="hidden" name="from" value="modifierProjet">
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

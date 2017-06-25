<?php
require "header.php";

if(!empty($_GET["id"])){
//Récupérer l'id en GET
    $db = dbConnect();
//Récupérer l'utilisateur en BDD
    $query = $db->prepare("SELECT * FROM CATEGORIES WHERE id_categorie = :id_categorie");
    $query -> execute($_GET);
    $res_data = $query->fetch();

//Remplir la variable $form avec les données de la base
    if(!empty($res_data)){

        $form = [
            "id_categorie"=>$res_data["id_categorie"],
            "nom_categorie"=>$res_data["nom_categorie"],
            "description_categorie"=>$res_data["description_categorie"],
            "filer"=>$res_data["filer"]

        ];
    }
}

?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Modifier une catégorie</h3>
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

                        <form role="form" method="POST" action="saveCategory.php?id=<?php echo (isset($form["id_categorie"]))?$form["id_categorie"]:""; ?>" enctype="multipart/form-data" class="form-horizontal form-label-left" novalidate>

                            <p>Veuillez remplir ce formulaire pour publier un article
                            </p>
                            <span class="section">Info nécessaire</span>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nom <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" name="nom_categorie" placeholder="Plus de 2 lettres" type="text"
                                           value="<?php echo (isset($form["nom_categorie"]) ? $form["nom_categorie"] : ""); ?>">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Filtre: </label>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <select class="form-control" name="filter">
                                        <option value="a">article</option>
                                        <option value="p">projet / équipe</option>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Description categorie <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="textarea" name="description_categorie" class="form-control col-md-7 col-xs-12"><?php echo (isset($form["description_categorie"]) ? $form["description_categorie"] : ""); ?></textarea>
                                </div>
                            </div>
                            <input type="hidden" name="from" value="modifierCategorie">
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

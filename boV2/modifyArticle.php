<?php
require "header.php";

if(!empty($_GET["id"])){
//Récupérer l'id en GET
$db = dbConnect();
//Récupérer l'utilisateur en BDD
$query = $db->prepare("SELECT * FROM ARTICLES WHERE id_article = :id" );
$query->execute($_GET);
$res_data = $query->fetch();

//Remplir la variable $form avec les données de la base
if(!empty($res_data)){
//$form = $result;
$form = [
    "id_article"=>$res_data["id_article"],
    "nom_article"=>$res_data["nom_article"],
    "description_article"=>$res_data["description_article"],
    "contenu_article"=>$res_data["contenu_article"]

];
}
}

?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Modifier un Article</h3>
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

                        <form role="form" method="POST" action="saveArticle.php?id=<?php echo (isset($form["id_article"]))?$form["id_article"]:""; ?>" enctype="multipart/form-data" class="form-horizontal form-label-left" novalidate>

                            <p>Veuillez remplir ce formulaire pour publier un article</p>
                            <span class="section">Info nécessaire</span>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Titre <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" name="nom_article" placeholder="Plus de 2 lettres" type="text"
                                           value="<?php echo (isset($form["nom_article"]) ? $form["nom_article"] : ""); ?>">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Description article <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="textarea" name="description_article" class="form-control col-md-7 col-xs-12"><?php echo (isset($form["description_article"]) ? $form["description_article"] : ""); ?></textarea>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Contenu article</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="textarea" name="contenu_article" class="form-control col-md-7 col-xs-12"><?php echo (isset($form["contenu_article"]) ? $form["contenu_article"] : ""); ?></textarea>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Votre image</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" name="image" required="required">
                                </div>
                            </div>
                            <input type="hidden" name="from" value="modifierArticle">
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

<?php

require "conf.inc.php";
include "header.php";

isConnected();

if(!empty($_GET["id"])){
    //Récupérer l'id en GET
    $db = dbConnect();
    //Récupérer l'utilisateur en BDD
    $query = $db->prepare("SELECT * FROM UTILISATEURS WHERE id_utilisateur = :id" );
    $query->execute($_GET);
    $res_data = $query->fetch();

    //Remplir la variable $form avec les données de la base
    if(!empty($res_data)){
        //$form = $result;
        $form = [
            "id_utilisateur"=>$res_data["id_utilisateur"],
            "email"=>$res_data["email"],
            "pseudo"=>$res_data["pseudo"],
            "avatar"=>$res_data["avatar"],
            "mdp"=>$res_data["mdp"],
            "presentation"=>$res_data["presentation"]
        ];
    }
}

?>

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Modifier un Utilisateur</h3>
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

                            <form role="form" method="POST" action="saveUser.php?id=<?php echo (isset($form["id_utilisateur"]))?$form["id_utilisateur"]:""; ?>" enctype="multipart/form-data" class="form-horizontal form-label-left" novalidate>

                                <p>Veuillez remplir ce formulaire pour modifier vos informations</p>
                                <span class="section">Info Personnelles</span>

                                <div class="item form-group">
                                    <center><div class="g-recaptcha" data-sitekey="6LePgyIUAAAAAHLk0tRDD-vKvSEWBQc4AVCz5sPB"></div></center>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Votre Pseudo</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="pseudo" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" placeholder="Plus de 2 lettres""
                                        value="<?php echo(isset($form["pseudo"]) ? $form["pseudo"] : ""); ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="email" class="form-control col-md-7 col-xs-12" placeholder="Votre email"
                                        value="<?php echo(isset($form["email"]) ? $form["email"] : ""); ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label for="password" class="control-label col-md-3">Password</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="password" name="pwd" class="form-control col-md-7 col-xs-12" data-validate-length="6,8"
                                               placeholder="Votre mot de passe" value="<?php //echo(isset($form["mdp"]) ? $form["mdp"] : ""); ?>">
                                    </div>
                                </div>
                               <div class="item form-group">
                                    <label for="password" class="control-label col-md-3">Repeat Password</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="password" name="pwd2" class="form-control col-md-7 col-xs-12" data-validate-length="6,8"
                                               placeholder="Votre mot de passe" value="<?php //echo(isset($form["mdp"]) ? $form["mdp"] : ""); ?>">
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
                                    <textarea id="textarea" name="presentation" class="form-control col-md-7 col-xs-12"><?php echo(isset($form["presentation"]) ? $form["presentation"] : ""); ?>
                                    </textarea>
                                    </div>
                                </div>
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

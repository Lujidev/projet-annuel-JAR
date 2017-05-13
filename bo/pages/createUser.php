<?php
	session_start();

	require "conf.inc.php";
	require "lib.php";
	include "header.php";
	include "footer.php";


	$db = dbConnect();
	$query = $db->prepare("SELECT id_categorie, nom_categorie FROM categories WHERE filter = :filter");
    $query->execute( [ "filter" => 'p' ] );
	$res = $query->fetchAll();
	
	// Si sauvegardeProjet trouve des erreurs alors on est renvoyé sur ce formulaire avec les messages d'erreur suivant
	if (!empty($_GET) && isset($_GET["errors"]))
		printErrorMsg($_GET["errors"], $messageErreur);
?>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Créer un utilisateur</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

<section>
	
	<form role="form" method="POST" action="saveUser.php">

        <div class="form-group">
        <input type="text" name="pseudo" class="form-control" placeholder="votre pseudo" required="requried">
		</div>
		<div class="form-group">
		<input type="email" name="email" class="form-control" placeholder="Votre email" required="requried">
		</div>
		<div class="form-group">
		<input type="password" name="pwd" class="form-control" placeholder="Votre mot de passe" required="requried"><br>
		<input type="password" name="pwd2" class="form-control" placeholder="Confirmation de votre mot de passe" required="requried">
		</div>
		<div class="form-group">
		<textarea name="presentation" class="form-control" rows="10" placeholder="votre presentation"></textarea>
		</div>

        <div class="form-group">
            <label>Captcha</label>
            <img src="captchaSimple.php">
            <input type="text" name="captcha" class="form-control" placeholder="vérification du captcha" required="required">
        </div>

		<input type="hidden" name="from" value="creerUtilisateur">
        <button type="submit" class="btn btn-default">Envoyer</button>
        <button type="reset" class="btn btn-default">Reset</button>

	</form>

</section>



                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>



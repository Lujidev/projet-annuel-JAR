<?php
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
                        <h1 class="page-header">Créer un Projet</h1>
                    </div>
                    <!-- /.col-lg-12 -->
        </div>

<section>
	
	<form method="POST" action="sauvegardeProjet.php">

		<div class="form-group">
		<input type="text" name="nom_projet" class="form-control" placeholder="nom de votre projet" required="requried">
		</div>
		<?php SkinDisplayCategories ($res); ?>

		<div class="form-group">
		<textarea name="description_projet" class="form-control" rows="10" placeholder="la description de votre projet"></textarea>
		</div>
		
		<input type="hidden" name="from"  value="creerProjet">
        <button type="submit" class="btn btn-default">Envoyer</button>
        <button type="reset" class="btn btn-default">Reset</button>

	</form>

</section>




                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
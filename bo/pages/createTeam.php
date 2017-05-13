<?php
	require "conf.inc.php";
	require "lib.php";
	include "header.php";
	include "footer.php";


	$db = dbConnect();
	$query = $db->prepare("SELECT id_categorie, nom_categorie FROM categories WHERE filter = :filter");
	$query->execute( [ "filter" => 'e' ] );
	$res = $query->fetchAll();

	// Si sauvegardeProjet trouve des erreurs alors on est renvoyé sur ce formulaire avec les messages d'erreur suivant
	if (!empty($_GET) && isset($_GET["errors"]))
		printErrorMsg($_GET["errors"], $messageErreur);
?>



<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Créer une équipe</h1>
                    </div>
                    <!-- /.col-lg-12 -->
        </div>

        <section>
	
	<form method="POST" action="saveTeams.php">
		<div class="form-group">
		<input type="text" name="nom_equipe" class="form-control" placeholder="nom de votre equipe" required="requried">
		</div>

        <div class="form-group">
 			<?php skinDisplayCategories($res); ?>
        </div>
        <div class="form-group">
		<textarea name="description_equipe" class="form-control" rows="10" placeholder="la description de votre Equipe"></textarea>
		</div>
		<input type="hidden" name="from"  value="creerEquipe">
        <button type="submit" class="btn btn-default">Envoyer</button>
        <button type="reset" class="btn btn-default">Reset</button>
	</form>

		</section>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
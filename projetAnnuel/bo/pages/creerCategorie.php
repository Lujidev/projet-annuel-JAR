<?php
	require "conf.inc.php";
	require "lib.php";
	include "header.php";
	include "footer.php";
 		
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Créer une Catégorie</h1>
                    </div>
                    <!-- /.col-lg-12 -->
        </div>

<section>
	
	<form method="POST" action="sauvegardeCategorie.php">

		<div class="form-group">
		<input type="text" name="nom_categorie" class="form-control" placeholder="nom de la Catégorie" required="requried">
		</div>
		<div class="form-group">
		<textarea name="description_categorie" class="form-control" rows="10" placeholder="la description de la Catégorie"></textarea>
		</div>
        <div class="form-group">
            <label>filtre</label>
                <select class="form-control" name="filter">
                    <option value="a">article</option>
                    <option value="p">projet / équipe</option>
                </select>
            </div>

        <input type="hidden" name="from"  value="creerCategorie">
        <button type="submit" class="btn btn-default">Envoyer</button>
        <button type="reset" class="btn btn-default">Reset</button>

	</form>

</section>




                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
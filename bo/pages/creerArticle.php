<?php
require "conf.inc.php";
require "lib.php";
include "header.php";
include "footer.php";


$db = dbConnect();
$query = $db->prepare("SELECT id_categorie, nom_categorie FROM categories WHERE filter = :filter");
$query->execute( [ "filter" => 'a' ] );
$res = $query->fetchAll();


?>


<div id="page-wrapper">
    <div class="container-fluid">
    <div class="row">
    <div class="col-lg-12">
    <h1> class="page-header">Créer un Article</h1>
    </div>
    <!-- /.col-lg-12 -->
    </div>

    <section>
	
	<form method="POST" action="saveArticle.php" enctype="multipart/form-data">
    <div class="form-group">
    <input type="text" name="nom_article" class="form-control" placeholder="nom de votre article" required="requried">
    </div>
    <?php SkinDisplayCategories ($res); ?>
    <div class="form-group">
    <textarea name="description_article" class="form-control" placeholder="description de votre article" required="requried"></textarea>
    </div>
    <div class="form-group">
    <textarea name="contenu_article" class="form-control" placeholder="contenu de votre article"></textarea>
    </div>

    <input type="hidden" name="from" value="creerArticle">
    <button type="submit" class="btn btn-default">Envoyer</button>
    <button type="reset" class="btn btn-default">Reset</button>

	</form>

    </section>



    <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    </div>
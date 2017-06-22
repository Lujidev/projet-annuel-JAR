<?php
require "header.php";
require "team/libTeam.php";

$id_team = $_GET["id"];
$team = getTeam($id_team);

$db = dbConnect();
$query = $db->prepare("SELECT id_categorie, nom_categorie FROM categories WHERE filter = :filter");
$query->execute( [ "filter" => 'p' ] );
$res = $query->fetchAll();

?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php echo $team['nom_equipe'] ?></h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-xs-12">
                <p><b>Qui voulez vous ajouter?</b></p>
                <div>
                  <ul id="user" class="list-inline"></ul>
                </div>
                <br>

                Pseudo: <input type="text" class="form-control" id="search" onkeyup="showSuggest(<?php echo $id_team ?>)")" placeholder="rechercher">

                <p>Suggestions: <span id="suggest"></span></p>
                <input type="button" onclick="submitAdd(<?php echo $_GET['id']; ?>);" value="Ajouter">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <form role="form" method="POST" action="saveProject.php" enctype="multipart/form-data" class="form-horizontal form-label-left" novalidate>

                            <p>Veuillez remplir ce formulaire pour créer un Projet
                            </p>
                            <span class="section">Créer un nouveau Projet</span>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nom de votre Projet <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" name="nom_projet" placeholder="Plus de 2 lettres" required="required" type="text">
                                </div>
                            </div>

                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Catégorie: </label>
                            <p style="padding: 5px;">

                                <?php  skinDisplayCategories($res);?>

                            </p>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Votre image
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" name="image" required="required">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Description
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="textarea" required="required" name="description_projet" class="form-control col-md-7 col-xs-12"></textarea>
                                </div>
                            </div>

                            <input type="hidden" name="from" value="creerProjet">
                            <input type="hidden" name="id_team" value="<?php echo $_GET["id"]; ?>">
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

<!-- footer content -->
<footer>
    <div class="pull-right">
        Dumb IT
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>

<script src="team/team.jing.js"></script>
<script src="build/js/jing.custom.js"></script>

<!-- jQuery -->
<script src="vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="vendors/nprogress/nprogress.js"></script>
<!-- bootstrap-progressbar -->
<script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="vendors/iCheck/icheck.min.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="vendors/moment/min/moment.min.js"></script>
<script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap-wysiwyg -->
<script src="vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
<script src="vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
<script src="vendors/google-code-prettify/src/prettify.js"></script>
<!-- jQuery Tags Input -->
<script src="vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<!-- Switchery -->
<script src="vendors/switchery/dist/switchery.min.js"></script>
<!-- Select2 -->
<script src="vendors/select2/dist/js/select2.full.min.js"></script>
<!-- Parsley -->
<script src="vendors/parsleyjs/dist/parsley.min.js"></script>
<!-- Autosize -->
<script src="vendors/autosize/dist/autosize.min.js"></script>
<!-- jQuery autocomplete -->
<script src="vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
<!-- starrr -->
<script src="vendors/starrr/dist/starrr.js"></script>
<!-- Custom Theme Scripts -->
<script src="build/js/custom.min.js"></script>

</body>
</html>

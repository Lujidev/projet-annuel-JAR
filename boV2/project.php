<?php
require "header.php";
require "/todo/libTodo.php";
?>


<!-- page content -->

<div class="right_col" role="main" id="mainContent" title="<?php echo $_GET['id']; ?>">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="title_left">
                    <h3>La progression du projet</h3>
                </div>
                <div id="custom_progress_bar">
                    <div id="bar" class="bar_class" style="width:<?php echo calculPercentage($_GET['id'])."%";?>"></div>
                </div>
            </div>
        </div>
    </br>
    </br>
        <div class="page-title">
            <div class="title_left">
                <h3>Création un Projet</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="x_panel">
                    <div class="x_content">

                        <form role="form" class="form-horizontal form-label-left" novalidate>

                            <p>Avancement du Projet</p>
                            <span class="section">To Do</span>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Tâche <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="todo" class="form-control col-md-7 col-xs-12" placeholder="Plus de 2 lettres" type="text" required>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <input type="button" onclick="addTodo(<?php echo $_GET['id']; ?>)" class="btn btn-success" value="Ajouter"/>
                                    <!--<button id="send" onclick="hello()" class="btn btn-success">Envoyer</button>-->
                                </div>
                            </div>

                            <ul id="todoList">
                                <?php displayTodo($_GET["id"]) ?>
                            </ul>


                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="x_panel">
                    <div class="x_content">
                        <span class="section">Tâche(s) Fini(s)</span>
                        <ul id="finishedTodo">
                            <?php finishedTodo($_GET["id"])?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="build/js/todo.jing.js"></script>



<?php
include "footer.php";
?>


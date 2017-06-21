<?php
require "header.php";
require "team/libTeam.php";
$token = $_GET['token'];
$team = getTeamInfoWithToken($token);
$concatToken = "'".$token."'";
?>
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Invitation</h3>
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
                <div class="col-md-12">
                    <?php
                        if ($team ==""){
                            echo "<p>Aucune équipe vous a invité</p>";
                        }else{
                            echo '<p>'.$team["nom_equipe"].' Vous a invité</p>
                            <button type="button" class="btn btn-info btn-lg" onclick="acceptInvit('.$concatToken.')">Accepter</button>
                             <button type="button" class="btn btn-danger btn-lg" onclick="declineInvit('.$concatToken.')">Refuser</button>
                            ';
                        }

                    ?>

                </div>
                <script src="team/team.jing.js"></script>
            </div>
        </div>
    </div>











<?php require "footer.php"?>
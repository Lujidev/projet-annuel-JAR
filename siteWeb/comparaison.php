<?php
include "headerWeb.php";
require "comparaison/libComparaison.php";
require "lib.php";
?>

    <link rel="stylesheet" href="comparaison/comparaiso.css">
    <br/><br/><br/>

    <!-- Plans -->
    <section id="plans">
        <div class="container">
            <div class="row">

                <!-- item -->
                <div class="col-md-4 text-center" >
                    <div class="panel panel-danger panel-pricing">
                        <div class="panel-heading">
                            <select id="mySelect_1" onchange="getPcData(1, 1)">
                                <?php displayAllPcAsOption(); ?>
                            </select>
                        </div>

                        <ul class="list-group text-center" id="container_1">

                        </ul>
                    </div>
                </div>
                <!-- /item -->

                <!-- item -->
                <div class="col-md-4 text-center">
                    <div class="panel panel-warning panel-pricing">
                        <div class="panel-heading">
                            <select id="mySelect_2" onchange="getPcData(2, 2)">
                                <?php displayAllPcAsOption(); ?>
                            </select>
                        </div>
                        <ul class="list-group text-center" id="container_2">

                        </ul>
                    </div>
                </div>
                <!-- /item -->

                <!-- item -->
                <div class="col-md-4 text-center">
                    <div class="panel panel-warning panel-pricing">
                        <div class="panel-heading">
                            <select id="mySelect_3" onchange="getPcData(3, 3)">
                                <?php displayAllPcAsOption(); ?>
                            </select>
                        </div>

                        <ul class="list-group text-center" id="container_3">

                        </ul>
                    </div>
                </div>
                <!-- /item -->

            </div>
        </div>
        <script src="comparaison/comparator.jing.js" ></script>
    </section>
    <!-- /Plans -->

<?php

require "footerWeb.php";

?>
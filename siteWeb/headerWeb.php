<?php
    require "libIndex.php";
    require "lib.php";
    session_start();
    $user = isConnected();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Projet Annuel - DumbIT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Coffee Break Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/style-like.css">
    <link rel="stylesheet" href="css/style-table.css">
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    <script src="js/jquery.min.js"></script>
    <!---- start-smoth-scrolling---->
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
        });
    </script>
</head>

<body>

<div class="header">
    <div class="container">
        <div class="head">
            <div class="navigation">
                <span class="menu"></span>
                <ul class="navig">
                    <li style="margin-right: 30px   "><img src="images/logo.png" alt="logo" width="70px" /></li>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="../bov2/index.php">Back-Office</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="comparaison.php">Comparateur</a></li>
                    <li><a href="config-o-matik/configO.php">Configo' !</a></li>
                </ul>
            </div>
            <?php

                if (!isset($user["id_utilisateur"])){
                    echo "<div class=\"header-right\">
                <span><a href=\"../boV2/login.php#signup\">Créer un compte</a></span>
                <span style=\"margin-left: 30px\"><a href=\"login.php\">Se connecter</a></span>
            </div>";
                }else{
                    echo "<div class=\"header-right\">
                <span>Bonjour, ".$user['pseudo']."</span>
                <span style=\"margin-left: 30px\"><a href=\"../boV2/disconnect.php\">Se déconnecter</a></span>
            </div>";
                }

            ?>
            <!--<div class="header-right">
                <div class="search-bar">
                    <input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
                    <input type="submit" value="">
                </div>
            </div>-->
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- script-for-menu -->

<script>
    $("span.menu").click(function(){
        $(" ul.navig").slideToggle("slow" , function(){
        });
    });
</script>

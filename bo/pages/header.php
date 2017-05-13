<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Back Office - Dumb IT</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

<a class="navbar-brand" href="index.php">Dumb IT</a>

<!-- bouton utilisateur barre de navigation -->
<ul class="nav navbar-top-links navbar-right">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Profile de l'utilisateur</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Réglage</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Déconnecter</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>

</ul>

<!-- Sidebar gauche -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">

            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                     <input type="text" class="form-control" placeholder="Recherche - placebo pour l'instant">
                     <span class="input-group-btn">
                     <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                    </button>
                    </span>
                </div>
             </li>
    <li>
        <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Tableau de bord</a>
    </li>
    <li>
        <a href="#"><i class="fa fa-user fa-fw"></i> Utilisateurs<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a href="gererUtilisateur.php">Gérer les utilisateur</a>
            </li>
            <li>
                <a href="creerUtilisateur.php">Créer un utilisateur</a>
            </li>
        </ul>
    </li>

    <li>
        <a href="#"><i class="fa fa-users fa-fw"></i> Équipes <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a href="gererEquipe.php">Gérer les équipes</a>
            </li>
            <li>
                <a href="creerEquipe.php">Créer une équipe</a>
            </li>
        </ul>
    </li>

    <li>
        <a href="#"><i class="fa fa-file fa-fw"></i> Articles<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a href="gererArticle.php">Gérer les articles</a>
            </li>
            <li>
                <a href="creerArticle.php">Créer un articles</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#"><i class="fa fa-folder-open fa-fw"></i> Projets<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a href="gererProjet.php">Gérer les projets</a>
            </li>
            <li>
                <a href="creerProjet.php">Créer un projet</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#"><i class="fa fa-archive fa-fw"></i> Catégories<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a href="gererCategorie.php">Gérer les catégories</a>
            </li>
            <li>
                <a href="creerCategorie.php">Créer une catégorie</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="gererCommentaire.php"><i class="fa fa-comments fa-fw"></i> Gérer les commentaires</a>
    </li>
        </ul>
    </div>
</div>

</nav>
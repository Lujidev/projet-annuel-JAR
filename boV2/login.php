  <!DOCTYPE html>
<html lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dumb IT - Espace Perso </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">

      <script src='https://www.google.com/recaptcha/api.js'></script>
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="POST" action="connect.php">
              <h1>Login</h1>
              <div>
                <input type="email" class="form-control" placeholder="email" name ="email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Mot de passe" name="mdp" required="" />
              </div>
              <div>
                <!--<a class="btn btn-default submit" href="connect.php">Connexion</a>-->
                  <button id="send" type="submit" class="btn btn-success">Envoyer</button>
                <a class="reset_pass" href="#">mot de passe perdu?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Nouveau sur le site?
                  <a href="#signup" class="to_register"> Créer un compte </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i>Dumb IT</h1>
                  <p>©2016 All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form method="POST" action="saveUser.php" enctype="multipart/form-data">
              <h1>Créer un compte</h1>
                <div class="item form-group">
                    <div class="g-recaptcha" data-sitekey="6LePgyIUAAAAAHLk0tRDD-vKvSEWBQc4AVCz5sPB"></div>
                </div>
                <div class="item form-group">
                    <div>
                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" name="pseudo" placeholder="Votre Pseudo" required="required" type="text">
                    </div>
                </div>
                <div class="item form-group">
                    <div>
                        <input type="email" id="email" name="email" placeholder="Votre Email" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="item form-group">
                    <div>
                        <input id="password" type="password" name="pwd" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" placeholder="Mot de passe" required="required">
                    </div>
                </div>
                <div class="item form-group">
                    <div>
                        <input id="password2" type="password" name="pwd2" data-validate-linked="pwd" class="form-control col-md-7 col-xs-12" placeholder="Confirmation mot de passe" required="required">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Votre image
                    </label>
                    <div>
                        <input type="file" name="image" required="required">
                    </div>
                </div>
                <div class="item form-group">
                    <div>
                        <textarea id="textarea" required="required" name="presentation" placeholder="votre présentation" class="form-control col-md-7 col-xs-12"></textarea>
                    </div>
                </div>
                <input type="hidden" name="from" value="creerUtilisateur">
              <div class="item form-group">
                  <button id="send" type="submit" class="btn btn-success">Envoyer</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Déjà membre ?
                  <a href="#signin" class="to_register"> Connexion </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i>Dumb IT</h1>
                  <p>©2016 All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>

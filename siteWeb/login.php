<?php

require "headerWeb.php";

?>
    <br>

    <!--team-starts-->
    <div class="team">
        <div class="container">
            <div class="team-top heading">
                <h3>PRODUITS</h3>
            </div>
            <div class="team-bottom">

                <form method="post" action="../boV2/connect.php">
                    <input type="email" placeholder="email" name="email">
                    <input type="password" placeholder="mot de passe" name="mdp">
                    <button id="send" type="submit">Envoyer</button>
                </form>

            </div>
        </div>
    </div>
    <script src="product-system/product.js"></script>
        <!--team-end-->


<?php

require "footerWeb.php";

?>
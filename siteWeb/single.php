<?php

require "headerWeb.php";

?>
<br>



    <!--team-starts-->
    <div class="team">
        <div class="container">
            <div class="team-top heading">
                <h3>ARTICLE</h3>
            </div>
            <div class="team-bottom">
                <?php

                $form = displaySingleArticle();
                $img = $form['image'];
                $id = $_GET["id"];

                ?>
            </div>

            <div class="team-bottom">
                <?php
                echo "
                    <h1>".$form['nom_article']."</h1>
                    ";
                ?>
            </div>
            <div class="team-bottom">
                <?php
                    echo "
                    <img id='widthImg' src='../boV2/upload/article/".$img."'>
                    ";
                ?>
            </div>
            <div class="team-bottom">
                <?php
                echo "
                    <h3>".$form['description_article']."</h3>
                    ";
                ?>
            </div>
            <div class="team-bottom">
                <?php
                echo "
                    <p>".$form['contenu_article']."</p>
                    ";
                ?>
            </div>

        </div>
    </div>
    <script src="like-system/code-anthony.js"></script>
    <!--team-end-->






<?php

require "footerWeb.php";

?>
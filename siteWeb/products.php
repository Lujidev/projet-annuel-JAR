<?php

include "headerWeb.php";

?>
    <br>

    <div class="team">
        <div class="container">
            <div class="team-top heading">
                <h3>AJOUTER UN ORDINATEUR</h3>
            </div>
            <div class="team-bottom">

                <form method="post">
                    <input type="text" id="name_id"
                           placeholder="Nom">
                    <input type="text" id="cpu_id"
                           placeholder="CPU">
                    <input type="text" id="gpu_id"
                           placeholder="GPU">
                    <input type="text" id="ram_id"
                           placeholder="RAM">
                    <input type="text" id="brand_id"
                           placeholder="Marque">
                    <input type="button" onclick="addComputer()"
                           value="ADD">
                </form>

            </div>
        </div>
    </div>
    <!--team-starts-->
    <div class="team">
        <div class="container">
            <div class="team-top heading">
                <h3>LISTE DES ORDINATEURS</h3>
            </div>
            <div class="team-bottom">

                <table>
                    <tr>
                        <th>MODELE</th>
                        <th>CPU</th>
                        <th>GPU</th>
                        <th>RAM</th>
                    </tr>
                    <?php
                        displayComputer(dbComputer());
                    ?>
                </table>

            </div>
        </div>
    </div>
    <!--team-end-->


<?php

require "footerWeb.php";

?>
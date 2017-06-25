<?php

require "headerWeb.php";

?>
<br>

<!--team-starts-->
	<div class="team">
		<div class="container">
            <div class="team-top heading">
                <h3>NEWEST ARTICLE</h3>
            </div>
			<div class="team-bottom">
				<?php
					 displayNewestArticle(indexGetNewestArticle());
				?>
            </div>
        </div>
    </div>
<!--team-end-->




<?php

    require "footerWeb.php";

?>
<?php
/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 12/06/2017
 * Time: 14:11
 */

require "header.php";

?>



   <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Settings</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                 </div>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">

                    <form role="form" method="POST" enctype="multipart/form-data" class="form-horizontal form-label-left" novalidate>

                      <span class="section">Informations Personnelles</span>


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Votre Pseudo <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?php echo $user['pseudo']?><span class="required"></span>
                            </label>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required"></span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?php echo $user['email']?><span class="required"></span>
                            </label>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Votre image</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div>
                                <img src="upload/user/<?php echo $user['avatar']?>" id="prof_pic" class="img-circle profile_img">
                            </div>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Description
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?php echo $user['presentation']?><span class="required"></span>
                            </label>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

              <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="x_panel">
                          <div class="x_content">
                              <?php

                              //$user = getIdUser();

                              echo "<button><a href=modifyUser.php?id=".$user["id_utilisateur"].">Modifier mes Informations</a></button>"
                              ?>
                          </div>
                      </div>
                  </div>
              </div>

          </div>
        </div>
        <!-- /page content -->


<?php
include "footer.php";
?>


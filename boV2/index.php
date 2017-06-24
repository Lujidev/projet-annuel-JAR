<?php 
include "header.php";
require "chat/chatLib.php";
require "statLib.php";

$userId = $user['id_utilisateur'];
?>
<link href="chat/chat.css" rel="stylesheet">
        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-envelope-o"></i> Message(s) Privé(s)</span>
              <div class="count"><?php echo nbMsgNotRead($user['id_utilisateur']);?></div>
              <span class="count_bottom"><i class="green">non lu(s) </i></span>
            </div>
            <!--<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Average Time</span>
              <div class="count">123.50</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
            </div>-->
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Membres totaux </span>
              <div class="count green"><?php echo countAllUsers(); ?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i> <?php echo weeklyUpdateMembers(); ?> </i> de cette semaine</span>
            </div><!--
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
              <div class="count">4,567</div>
              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
              <div class="count">2,315</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
              <div class="count">7,325</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>-->
          </div>
          <!-- /top tiles -->

          <br />


<!--ChatBox-->
            <script src="https://use.fontawesome.com/45e03a14ce.js"></script>
            <div class="main_section">
                <div class="container">
                    <div class="chat_container">
                        <div class="col-sm-3 chat_sidebar">
                            <div class="row">
                                <div id="custom-search-input">
                                    <div class="input-group col-md-12">
                                        <input type="text" class="  search-query form-control" placeholder="Conversation" />
                                        <button class="btn btn-danger" type="button">
                                            <span class=" glyphicon glyphicon-search"></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="dropdown all_conversation">
                                    <button class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-weixin" aria-hidden="true"></i>
                                        All Conversations
                                        <span class="caret pull-right"></span>
                                    </button>
                                </div>
                                <div class="member_list">
                                    <ul class="list-unstyled">
                                        <?php displayTeamChatBox($userId); ?>
                                    </ul>
                                </div></div>
                        </div>
                        <!--chat_sidebar-->


                        <div class="col-sm-9 message_section">
                            <div class="row">
                                <div class="new_message_head">
                                    <div id="teamName" class="pull-left">Nom de l'équipe</div>
                                </div><!--new_message_head-->

                                <div class="chat_area" id="msgWindow">
                                    <ul class="list-unstyled" id="chatBox">
                                    </ul>
                                </div><!--chat_area-->
                                <div class="message_write">
                                    <textarea title="msg" id="typingBox" class="form-control"></textarea>
                                    <div class="clearfix"></div>
                                    <div class="chat_bottom">
                                        <button id="sendButton" class="pull-right btn btn-success">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div> <!--message_section-->
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
<script src="chat/chat.js"></script>
<?php
include "footer.php";
?>

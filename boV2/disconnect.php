<?php
	session_start();
    require "lib.php";
    disconnect();
    header("location: login.php");

?>
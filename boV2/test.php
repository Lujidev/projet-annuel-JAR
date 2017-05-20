<?php
session_start();

include "lib.php";

$res1 = isConnected();

print_r($res1);
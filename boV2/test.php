<?php

require "lib.php";

$user = isConnected();

$res = getMessages($user['id_utilisateur'], $user['droit']);

print_r(key($res));




?>
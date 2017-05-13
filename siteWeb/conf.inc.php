<?php

define("DB_DRIVER", "mysql");
define("DB_NAME", "projetannuel");
define("DB_HOST", "localhost");
define("DB_PORT", 3306);
define("DB_USER", "root");
define("DB_PWD", "");

$messageErreur = [
	"Le nom de projet doit être entre 3 et 50 caractères.",
	"La description comprend un maximum de 5000 caractères.",
	"Le nom existe déjà dans la base de donnée.",
	"Le nom de l'équipe doit être entre 3 et 50 caractères.",
	"La description comprend un maximum de 250 caractères.",
	"Le nom de l'article doit être entre 3 et 50 caractères.",
	"La description comprend un maximum de 100 caractères.",
	"L'email est incorrect.",
	"Le pseudo doit être entre 3 et 50 caractères.",
	"Le mot de passe doit être entre 8 et 16 caractères.",
	"Le mot de passe de confimation est different du mot de passe.",
	"Le captcha est incorrect."
];
<?php

require_once("cabecalho.php");
require_once("db.php");

println(password_hash($_POST['senha'], PASSWORD_DEFAULT));

<?php

require_once("cabecalho.php");
require_once(__DIR__ . "/../plancont_modelos/usuario.php");

adicionar_usuario($dbh, $_POST['nome'], $_POST['email'], $_POST['senha']);

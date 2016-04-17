<?php
require_once("util.php");
require_once(__DIR__ . "/../config_secreto.php");  // arquivo com informações de conexão 

$dsn = "mysql:host=$dbhost;dbname=$dbname;charset=utf8";

try {
  $dbh = new PDO($dsn, $dbuser, $dbpassword);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $dbh->exec("set character set 'utf8'");
} catch (PDOException $e) {
  die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

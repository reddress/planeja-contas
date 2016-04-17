<?php
require_once("cabecalho.php");
require_once(__DIR__ . "/../plancont_modelos/usuario.php");

$nome_do_usuario = nome_do_usuario($dbh);

if ($nome_do_usuario) {
  echo $nome_do_usuario;
?>
  | <a href="sair.php">Sair</a>
  
  <?php
} else {
?>
  <a href="login_form.php">Fazer login</a>
<?php
}
?>
<div>
Página Principal
</div>

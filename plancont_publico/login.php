<?php

session_start();

require_once(__DIR__ . "/../plancont_modelos/usuario.php");

$login_status = login($dbh, $_POST['nome'], $_POST['senha']);

require_once("cabecalho.php");

if ($login_status) {
?>
  Bem-vindo(a)!<br>

  <?php
} else {
?>  
    Senha incorreta ou usuário não encontrado.<br>
    <a href="login_form.php">Tentar novamente</a>
<?php
}
?>



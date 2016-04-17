<?php

require_once(__DIR__ . "/../plancont_modelos/usuario.php");

$login_status = login($dbh, $_POST['nome'], $_POST['senha']);

if ($login_status) {
?>
  Bem-vindo!<br>
  <a href="index.php">Página principal</a><?php
} else {
?>  
    Senha incorreta ou usuário não encontrado.<br>
    <a href="login_form.php">Tentar novamente</a>
<?php
}
?>



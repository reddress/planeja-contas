<?php

require_once(__DIR__ . "/../plancont_config/db.php");

function adicionar_usuario($dbh, $nome, $email, $senha) {
  $find_sql = "select nome from plancont_usuario where nome = :nome";
  try {
    $stmt = $dbh->prepare($find_sql);
    $stmt->execute([":nome" => $nome]);
  } catch (PDOException $e) {
    die($e->getMessage());
  }

  if ($stmt->rowCount() > 0) {
    return false;
  } else {
  
    $insert_sql = "insert into plancont_usuario (nome, email, senha)
    values (:nome, :email, :senha)";

    try { 
      $stmt = $dbh->prepare($insert_sql);
      $stmt->execute([":nome" => $nome,
                      ":email" => $email,
                      ":senha" => password_hash($senha, PASSWORD_DEFAULT)]);
      
    } catch (PDOException $e) {
      die($e->getMessage());
    }

    // fazer login automático
    $select_sql = "select id from plancont_usuario where nome = :nome";
    try {
      $stmt = $dbh->prepare($select_sql);
      $stmt->execute([":nome" => $nome]);
      $row = $stmt->fetch();
      $_SESSION['id_usuario'] = $row['id'];
    } catch (PDOException $e) {
      die($e->getMessage());
    }

    return true;
  }
}

function login($dbh, $nome, $senha) {
  $select_sql = "select id, senha from plancont_usuario where nome = :nome";

  try {
    $stmt = $dbh->prepare($select_sql);
    $stmt->execute([":nome" => $nome]);
    $row = $stmt->fetch();

    if ($row) {
      if (password_verify($senha, $row['senha'])) {
        $_SESSION['id_usuario'] = $row['id'];
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    } 
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

function sair() {
  unset($_SESSION['id_usuario']);
}

function nome_do_usuario($dbh) {
  if (isset($_SESSION['id_usuario'])) {
    $select_sql = "select nome from plancont_usuario where id = :id";
    $stmt = $dbh->prepare($select_sql);
    $stmt->execute([":id" => $_SESSION['id_usuario']]);
    $row = $stmt->fetch();
    if ($row) {
      return $row['nome'];
    } else {
      return false;
    }
  } else {
    return false;
  }
}

function validar_usuario() {
  if (isset($_SESSION["id_usuario"])) {
    return true;
  } else {
    return false;
  }
}

?>

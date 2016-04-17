<?php

require_once("db.php");

require_once(__DIR__ . "/../plancont_publico/cabecalho.php");

session_start();

function adicionar_transacao($dbh, $valor, $data_criada, $debito, $credito, $descricao) {
  if (isset($_SESSION["id_usuario"])) {
    $insert_sql = "insert into plancont_transacao (id_usuario, valor, data_criada, debito, credito, descricao)
    values (:id_usuario, :valor, :data_criada, :debito, :credito, :descricao)";
  
    try { 
      $stmt = $dbh->prepare($insert_sql);
      $stmt->execute([":id_usuario" => $_SESSION['id_usuario'],
                      ":valor" => $valor,
                      ":data_criada" => $data_criada,
                      ":debito" => $debito,
                      ":credito" => $credito,
                      ":descricao" => $descricao]);
                      
      echo "Adicionada transação $descricao.";
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  } else {
    echo "Operação não autorizada.";
  }
}

?>

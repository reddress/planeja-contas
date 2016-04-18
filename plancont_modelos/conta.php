<?php

require_once(__DIR__ . "/../plancont_config/db.php");

if (!validar_usuario()) {  
  die("Contas: Operação não autorizada.");
}

function adicionar_conta($dbh, $id_tipo, $nome) {
  $insert_sql = "insert into plancont_conta (id_usuario, id_tipo_de_conta, nome)
    values (:id_usuario, :id_tipo_de_conta, :nome)";
  
  try { 
    $stmt = $dbh->prepare($insert_sql);
    $stmt->execute([":id_usuario" => $_SESSION['id_usuario'],
                    ":id_tipo_de_conta" => $id_tipo,
                    ":nome" => $nome]);
    echo "Adicionada conta $nome.";
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

function lista_todas_contas($dbh) {
  $select_sql = "select id, nome from plancont_conta
where id_usuario = :id_usuario
order by nome";
  try {
    $stmt = $dbh->prepare($select_sql);
    $stmt->execute([":id_usuario" => $_SESSION["id_usuario"]]);

    return $stmt->fetchAll();
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

function nome_da_conta($dbh, $id_conta) {
  $select_sql = "select nome from plancont_conta
    where id_usuario = :id_usuario
and id = :id";
  try {
    $stmt = $dbh->prepare($select_sql);
    $stmt->execute([":id_usuario" => $_SESSION["id_usuario"],
                    ":id" => $id_conta]);
    return $stmt->fetch()['nome'];
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

function sinal_da_conta($dbh, $id_conta) {
  $select_sql = "select t.sinal from plancont_tipo_de_conta t
inner join plancont_conta c on c.id_tipo_de_conta = t.id
where c.id_usuario = :id_usuario
and c.id = :id_conta";
  try {
    $stmt = $dbh->prepare($select_sql);
    $stmt->execute([":id_usuario" => $_SESSION["id_usuario"],
                    ":id_conta" => $id_conta]);
    $row = $stmt->fetch();
    return $row['sinal'];
  } catch (PDOException $e) {
    echo "Erro obtendo sinal da conta.";
    die($e->getMessage());
  }
}


function debitar($dbh, $id_conta, $valor) {
  $sinal = sinal_da_conta($dbh, $id_conta);
  $valor_balanceado = $sinal * $valor;
  $update_sql = "update plancont_conta set saldo = saldo + :valor
  where id_usuario = :id_usuario
and id = :id_conta";

  try {
    $stmt = $dbh->prepare($update_sql);
    $stmt->execute([":id_usuario" => $_SESSION["id_usuario"],
                    ":id_conta" => $id_conta,
                    ":valor" => $valor_balanceado]);
  } catch (PDOException $e) {
    echo "Erro debitando/creditando conta.";
    die($e->getMessage());
  }
}

function creditar($dbh, $id_conta, $valor) {
  debitar($dbh, $id_conta, -$valor);
}

?>

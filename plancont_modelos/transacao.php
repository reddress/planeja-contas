<?php

require_once(__DIR__ . "/../plancont_config/db.php");
require_once("conta.php");

if (!validar_usuario()) {  
  die("Transações: Operação não autorizada.");
}

function adicionar_transacao($dbh, $valor, $data_criada, $debito, $credito, $descricao) {
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

    // atualizar saldo das contas de débito e crédito
    debitar($dbh, $debito, $valor);
    creditar($dbh, $credito, $valor);
    
    echo "Adicionada transação $descricao.";
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

function lista_ultimas_transacoes($dbh, $quantidade = 30) {
  $select_sql = "select date_format(t.data_criada, '%Y-%m-%d %H:%i') as data_criada, t.valor, t.descricao, debito.nome as debito, credito.nome as credito
from plancont_transacao t
inner join plancont_conta debito on t.debito = debito.id
inner join plancont_conta credito on t.credito = credito.id
inner join plancont_usuario u on t.id_usuario = u.id
where t.id_usuario = :id_usuario
order by data_criada desc, valor desc limit :quantidade";

  try {
    $stmt = $dbh->prepare($select_sql);
    $stmt->execute([":id_usuario" => $_SESSION['id_usuario'],
                    ":quantidade" => $quantidade]);
    return $stmt->fetchAll();
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

function lista_transacoes_da_conta($dbh, $id_conta, $quantidade = 30, $data_inicial = "2000-01-01", $data_final = "2100-01-01") {
  $select_sql = "select date_format(t.data_criada, '%Y-%m-%d %H:%i') as data_criada, t.valor, t.descricao, debito.nome as debito, credito.nome as credito
from plancont_transacao t
inner join plancont_conta debito on t.debito = debito.id
inner join plancont_conta credito on t.credito = credito.id
inner join plancont_usuario u on t.id_usuario = u.id
where t.id_usuario = :id_usuario
and (t.debito = :debito or t.credito = :credito)
and t.data_criada >= :data_inicial
and t.data_criada < :data_final
order by data_criada desc, valor desc limit :quantidade";
  try {
    $stmt = $dbh->prepare($select_sql);
    $stmt->execute([":id_usuario" => $_SESSION['id_usuario'],
                    ":quantidade" => $quantidade,
                    ":debito" => $id_conta,
                    ":credito" => $id_conta,
                    ":data_inicial" => $data_inicial,
                    ":data_final" => $data_final]);
    return $stmt->fetchAll();
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}
?>

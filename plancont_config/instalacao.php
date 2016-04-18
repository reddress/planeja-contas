<?php
require_once(__DIR__ . "/../plancont_visoes_multipaginas/cabecalho.php");

// Criar tabelas
require_once("db.php");

function criar_tabela($dbh, $nome, $sql) {
  try {
    $dbh->exec($sql);
    println("Criando tabela $nome.");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

criar_tabela($dbh, "plancont_usuario",
             "create table if not exists plancont_usuario
(id int not null auto_increment,
nome varchar(64) not null,
email varchar(80) not null,
senha varchar(255) not null,
constraint pk_usuario_id primary key (id))
engine=InnoDB");

criar_tabela($dbh, "plancont_tipo_de_conta",
             "create table if not exists plancont_tipo_de_conta
(id int not null auto_increment,
nome varchar(32) not null,
sinal int not null,
constraint pk_tipo_de_conta_id primary key (id))
engine=InnoDB");

criar_tabela($dbh, "plancont_conta",
             "create table if not exists plancont_conta
(id int not null auto_increment,
id_usuario int not null,
id_tipo_de_conta int not null,
nome varchar(80) not null,
saldo int not null,
constraint pk_conta_id primary key (id),
constraint fk_conta_usuario foreign key (id_usuario)
references plancont_usuario (id),
constraint fk_conta_tipo foreign key (id_tipo_de_conta)
references plancont_tipo_de_conta (id))
engine=InnoDB");

criar_tabela($dbh, "plancont_transacao",
             "create table if not exists plancont_transacao
(id int not null auto_increment,
id_usuario int not null,
valor int not null,
data_criada datetime not null,
debito int not null,
credito int not null,
descricao varchar(200) not null,
constraint pk_transacao_id primary key (id),
constraint fk_transacao_usuario foreign key (id_usuario)
references plancont_usuario (id),
constraint fk_transacao_debito foreign key (debito)
references plancont_conta(id),
constraint fk_transacao_credito foreign key (credito)
references plancont_conta(id))
engine=InnoDB");

// Inserir tipos de contas
try {
  $dbh->exec("insert into plancont_tipo_de_conta (id, nome, sinal)
    values(1, 'Bens', 1),
(2, 'Despesas', 1),
(3, 'Obrigações', -1),
(4, 'Receitas', -1),
(5, 'Patrimônio líquido', -1)");
} catch (PDOException $e) {
  die($e->getMessage());
}

?>

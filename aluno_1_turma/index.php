<!--
form_um_turma.php
-->

<h1>
<br>    
<?php
require 'config_1_turma.php';

// Buscar todas as turmas cadastradas
$stmt = $pdo->query("SELECT id, descricao FROM turmas");
$turmas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<form method="POST" action="cadastrar_um_turma.php">
    Nome: <input type="text" name="nome" required autofocus><br><br>

    Turma:
    <select name="turma_id" required>
        <option value="">-- Selecione --</option>
        <?php foreach ($turmas as $turma): ?>
            <option value="<?= $turma['id'] ?>"><?= htmlspecialchars($turma['descricao']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Salvar</button>
</form>
<a href="exibir_aluno_uma_turma.php">Ver Associação</a>
<pre>

Neste caso temos que  o aluno está em uma única turma, 
basta que pegar o retorno das turmas e colocar em um 
"Select Box" (em Delphi chama-se ComboBox)
Exibindo o  nome mas o value é o id que será gravado na tabela aluno:

alunos
+----+--------+----------+
| id | nome   | turma_id |
+----+--------+----------+
|  1 | JOÃO   |    1     |
+----+--------+----------+

turmas
+----+----------+
| id | descricao|
+----+----------+
|  1 | 1003     |
|  2 | 2003     |
+----+----------+


CREATE DATABASE IF NOT EXISTS `aluno_1_turma`;
USE `aluno_1_turma`;

-- Tabela de turmas
CREATE TABLE IF NOT EXISTS `turmas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`)
);

-- Tabela de alunos
CREATE TABLE IF NOT EXISTS `alunos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `turma_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT fk_aluno_turma FOREIGN KEY (`turma_id`) REFERENCES `turmas`(`id`)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);


INSERT INTO `turmas` (`id`, `descricao`) VALUES
	(1, '1003'),
	(2, '3003'),
	(3, '1006'),
	(4, 'NEJA1');

</pre>

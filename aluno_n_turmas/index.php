<!--
index.php
-->

<h1>

<?php
require 'config_varias_turma.php';

// Buscar todas as turmas cadastradas
$stmt = $pdo->query("SELECT id, descricao FROM turmas");
$turmas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<form method="POST" action="cadastrar_varias_turmas.php">
    Nome: <input type="text" name="nome" required autofocus><br><br>

    Turmas:<br>
    <?php foreach ($turmas as $turma): ?>
        <label>
            <input type="checkbox" name="turmas[]" value="<?= $turma['id'] ?>">
            <?= htmlspecialchars($turma['descricao']) ?>
        </label><br>
    <?php endforeach; ?>

    <br>
    <button type="submit">Salvar</button>
</form>

<a href="exibir_aluno_varias_turmas.php">Ver Associação</a>
<hr>



<pre>

Neste caso eu posso ter um aluno e 1 ou várias turmas,logo preciso de uma tabela extra
que fará a associaçao entre aluno e turma conterá a chave de ambas



alunos
+----+--------+
| id | nome   |
+----+--------+
|  1 | JOÃO   |
+----+--------+

turmas
+----+----------+
| id | descricao|
+----+----------+
|  1 | 1003     |
|  2 | 2003     |
+----+----------+

aluno_turma
+----+----------+----------+
| id | aluno_id | turma_id |
+----+----------+----------+
|  1 |    1     |    1     |
|  2 |    1     |    2     |
+----+----------+----------+



CREATE DATABASE IF NOT EXISTS aluno_n_turma;
USE aluno_n_turma;

CREATE TABLE IF NOT EXISTS alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS turmas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS aluno_turma (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aluno_id INT NOT NULL,
    turma_id INT NOT NULL,
    FOREIGN KEY (aluno_id) REFERENCES alunos(id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (turma_id) REFERENCES turmas(id)
        ON DELETE CASCADE ON UPDATE CASCADE
);
</pre>
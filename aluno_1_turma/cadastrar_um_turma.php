<!--
cadastrar_um_turma.php
-->

<?php
require 'config_1_turma.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $turmaId = $_POST['turma_id'] ?? null;

    if (!empty($nome) && !empty($turmaId)) {
        try {
            $pdo->beginTransaction();

            // Inserir aluno
            $stmt = $pdo->prepare("INSERT INTO alunos (nome, turma_id) VALUES (UPPER(:nome), :turma_id)");
            $stmt->execute([':nome' => $nome, ':turma_id' => $turmaId]);
            $pdo->commit();
            echo "Aluno cadastrado em uma turma!";
        } catch (Exception $e) {
            $pdo->rollBack();
            echo "Erro: " . $e->getMessage();
        }
    } else {
        echo "Preencha todos os campos!";
    }
}
?>

<hr>
<a href=".">Voltar</a>


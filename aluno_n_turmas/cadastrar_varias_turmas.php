<!--
cadastrar_varias_turmas.php
-->

<?php
require 'config_varias_turma.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $turmas = $_POST['turmas'] ?? [];

    if (!empty($nome) && !empty($turmas)) {
        try {
            $pdo->beginTransaction();

            // Inserir aluno
            $stmt = $pdo->prepare("INSERT INTO alunos (nome) VALUES (:nome)");
            $stmt->execute([':nome' => $nome]);
            $alunoId = $pdo->lastInsertId();

            // Inserir relações na tabela pivô
            $stmtPivot = $pdo->prepare("INSERT INTO aluno_turma (aluno_id, turma_id) VALUES (:aluno_id, :turma_id)");
            foreach ($turmas as $turmaId) {
                $stmtPivot->execute([
                    ':aluno_id' => $alunoId,
                    ':turma_id' => $turmaId
                ]);
            }

            $pdo->commit();
            echo "Aluno cadastrado em várias turmas!";
        } catch (Exception $e) {
            $pdo->rollBack();
            echo "Erro: " . $e->getMessage();
        }
    } else {
        echo "Preencha o nome e selecione ao menos uma turma.";
    }
}
?>
<hr>
<a href=".">Voltar</a>
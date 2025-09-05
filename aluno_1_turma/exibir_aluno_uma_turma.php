<?php
require 'config_1_turma.php';

// Consulta aluno + turma (relação 1 para 1)
$sql = "
    SELECT a.nome AS aluno, t.descricao AS turma
    FROM alunos a
    JOIN turmas t ON a.turma_id = t.id
    ORDER BY a.nome
";

$stmt = $pdo->query($sql);
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Alunos e Turmas</title>
</head>
<body>
    <h2>Lista de Alunos e suas Turmas</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Aluno</th>
            <th>Turma</th>
        </tr>
        <?php foreach ($resultados as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['aluno']) ?></td>
                <td><?= htmlspecialchars($row['turma']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href=".">Voltar</a>
</body>
</html>


<?php
require 'config_varias_turma.php';

// Consulta aluno + turma
$sql = "
    SELECT a.nome AS aluno, t.descricao AS turma
    FROM aluno_turma at
    JOIN alunos a ON at.aluno_id = a.id
    JOIN turmas t ON at.turma_id = t.id
    ORDER BY a.nome, t.descricao
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

    
<hr>
<a href=".">Voltar</a>
</body>
</html>

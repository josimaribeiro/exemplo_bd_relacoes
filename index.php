<?php
// Define o diretório base que você quer listar
$baseDir = __DIR__; // __DIR__ pega o diretório atual do script (htdocs)

// Tenta abrir o diretório
if ($handle = opendir($baseDir)) {
    echo "<!DOCTYPE html>";
    echo "<html lang='pt-br'>";
    echo "<head>";
    echo "    <meta charset='UTF-8'>";
    echo "    <meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "    <title>Meus Projetos Locais</title>";
    echo "    <style>";
    echo "        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }";
    echo "        .container { max-width: 800px; margin: 50px auto; background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }";
    echo "        h1 { text-align: center; color: #0056b3; margin-bottom: 30px; }";
    echo "        ul { list-style: none; padding: 0; }";
    echo "        li { margin-bottom: 10px; }";
    echo "        a { text-decoration: none; color: #007bff; font-size: 1.1em; padding: 8px 12px; display: block; border: 1px solid #e0e0e0; border-radius: 5px; transition: all 0.3s ease; }";
    echo "        a:hover { background-color: #e9f5ff; border-color: #007bff; transform: translateX(5px); }";
    echo "        .no-projects { text-align: center; color: #666; font-style: italic; }";
    echo "    </style>";
    echo "</head>";
    echo "<body>";
    echo "    <div class='container'>";
    echo "        <h1>Meus Projetos PHP Locais</h1>";
    echo "        <ul>";

    $hasProjects = false;
    // Loop através de cada item no diretório
    while (false !== ($file = readdir($handle))) {
        // Ignora "." e "..", que representam o diretório atual e o pai
        // Ignora também o próprio script 'portal.php' se ele estiver na raiz
        // Você pode adicionar outras pastas que não quer listar (e.g., 'xampp', 'webalizer')
        if ($file != "." && $file != ".." && is_dir($baseDir . '/' . $file) && $file != 'portal.php' && $file != 'xampp' && $file != 'dashboard') {
            echo "            <li><a href='$file/' target='_blank'>$file</a></li>";
            $hasProjects = true;
        }
    }

    if (!$hasProjects) {
        echo "            <li class='no-projects'>Nenhum projeto encontrado. Crie subpastas em 'htdocs' para vê-las aqui.</li>";
    }

    echo "        </ul>";
    echo "    </div>";
    echo "</body>";
    echo "</html>";

    closedir($handle); // Fecha o diretório
} else {
    echo "Não foi possível abrir o diretório base.";
}
?>

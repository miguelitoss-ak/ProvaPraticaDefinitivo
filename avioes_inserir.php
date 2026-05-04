<?php
require_once 'carregar_pdo.php';
require_once 'carregar_twig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $modelo = $_POST['modelo'] ?? '';
    $fabricante = $_POST['fabricante'] ?? '';
    $ano = (int) ($_POST['ano'] ?? 0);
    $raridade = $_POST['raridade'] ?? '';
    $categoria = $_POST['categoria'] ?? '';
    $descricao = $_POST['descricao'] ?? '';

    if (empty($modelo) || empty($fabricante) || empty($ano)) {
        die("Erro: Campos obrigatórios vazios.");
    }

    $sql = "INSERT INTO colecao 
        (modelo, fabricante, ano_lancamento, raridade, categoria, descricao) 
        VALUES (:modelo, :fabricante, :ano, :raridade, :categoria, :descricao)";

    $stmt = $pdo->prepare($sql);

    $sucesso = $stmt->execute([
        ':modelo' => $modelo,
        ':fabricante' => $fabricante,
        ':ano' => $ano,
        ':raridade' => $raridade,
        ':categoria' => $categoria,
        ':descricao' => $descricao
    ]);

    if ($sucesso) {
        header("Location: index.php?mensagem=sucesso");
        exit;
    } else {
        die("Erro ao inserir no banco.");
    }
}

echo $twig->render('avioes_inserir.html');
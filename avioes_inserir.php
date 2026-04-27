<?php
require_once 'carregar_pdo.php';
require_once 'carregar_twig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados
    $modelo = $_POST['modelo'];
    $fabricante = $_POST['fabricante'];
    $ano = $_POST['ano'];
    $raridade = $_POST['raridade'];
    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];

    // Validação no Back-end (Requisito do Trabalho)
    if (empty($modelo) || empty($fabricante)) {
        die("Erro: Campos obrigatórios vazios.");
    }

    // SQL com Prepared Statements (Segurança contra SQL Injection)
    $sql = "INSERT INTO colecao (modelo, fabricante, ano_lancamento, raridade, categoria, descricao) 
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
    }
}

// Se não for POST, apenas mostra o formulário
echo $twig->render('avioes_inserir.html');
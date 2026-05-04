<?php

require_once 'carregar_pdo.php';
require_once 'carregar_twig.php';

// EDITAR (UPDATE)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = (int) $_POST['id'];
    $modelo = $_POST['modelo'] ?? '';
    $fabricante = $_POST['fabricante'] ?? '';
    $ano = (int) ($_POST['ano'] ?? 0);
    $raridade = $_POST['raridade'] ?? '';
    $categoria = $_POST['categoria'] ?? '';
    $descricao = $_POST['descricao'] ?? '';

    if (empty($modelo) || empty($fabricante) || empty($ano)) {
        die("Erro: Campos obrigatórios vazios.");
    }

    $sql = "UPDATE colecao SET 
        modelo = :modelo,
        fabricante = :fabricante,
        ano_lancamento = :ano,
        raridade = :raridade,
        categoria = :categoria,
        descricao = :descricao
        WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':modelo' => $modelo,
        ':fabricante' => $fabricante,
        ':ano' => $ano,
        ':raridade' => $raridade,
        ':categoria' => $categoria,
        ':descricao' => $descricao,
        ':id' => $id
    ]);

    header("Location: index.php");
    exit;
}

// BUSCAR avião pelo ID (GET)
$id = (int) ($_GET['id'] ?? 0);

$sql = "SELECT * FROM colecao WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$aviao = $stmt->fetch();

if (!$aviao) {
    die("Avião não encontrado.");
}

// Mostra o formulário com os dados
echo $twig->render('avioes_editar.html', [
    'aviao' => $aviao
]);
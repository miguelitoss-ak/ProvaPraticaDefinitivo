<?php

require_once 'carregar_pdo.php';
require_once 'carregar_twig.php';

// 🔴 EXCLUIR (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = (int) ($_POST['id'] ?? 0);

    if ($id > 0) {
        $sql = "DELETE FROM colecao WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
    }

    header("Location: index.php");
    exit;
}

// 🟡 BUSCAR avião (GET)
$id = (int) ($_GET['id'] ?? 0);

$sql = "SELECT * FROM colecao WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$aviao = $stmt->fetch();

if (!$aviao) {
    die("Avião não encontrado.");
}

// Mostra tela de confirmação
echo $twig->render('avioes_excluir.html', [
    'aviao' => $aviao
]);
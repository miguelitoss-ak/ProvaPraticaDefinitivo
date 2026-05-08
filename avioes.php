<?php
// avioes.php
require_once 'carregar_twig.php'; // Configuração do Twig
require_once 'carregar_pdo.php';  // Conexão com Banco

// 1. Busca todos os aviões (O "Read" do CRUD)
$query = $pdo->query("SELECT * FROM colecao ORDER BY CASE raridade WHEN 'Lendário' THEN 4 WHEN 'Épico' THEN 3 WHEN 'Raro' THEN 2 WHEN 'Comum' THEN 1 ELSE 0 END DESC, criado_em DESC");
$avioes = $query->fetchAll();

// 2. Renderiza o template passando a lista
echo $twig->render('avioes.html', [
    'colecao' => $avioes,
    'titulo' => 'Meu Álbum de Aviões'
]);
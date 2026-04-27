<?php
// jogos.php
require_once 'carregar_twig.php'; // Configuração do Twig
require_once 'carregar_pdo.php';  // Conexão com Banco

// 1. Busca todos os aviões (O "Read" do CRUD)
$query = $pdo->query("SELECT * FROM colecao ORDER BY criado_em DESC");
$avioes = $query->fetchAll();

// 2. Renderiza o template passando a lista
echo $twig->render('avioes.html', [
    'colecao' => $avioes,
    'titulo' => 'Meu Álbum de Aviões'
]);
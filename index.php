<?php
// 1. Importa as configurações (Banco e Template)
require_once 'carregar_pdo.php';
require_once 'carregar_twig.php';

// Busca os dados (READ)
$query = $pdo->query("SELECT * FROM colecao ORDER BY id DESC");
$avioes = $query->fetchAll();

// 3. Renderiza o template 'avioes.html' (que está na pasta templates)
// Passamos a lista de aviões para dentro do template com o nome 'colecao'
echo $twig->render('avioes.html', [
    'titulo_pagina' => 'Álbum de Cartas: Aviação',
    'colecao' => $avioes
]);
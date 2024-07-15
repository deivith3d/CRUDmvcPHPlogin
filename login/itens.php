<?php
// Inicia uma nova sessão ou retoma a sessão existente
session_start();
// Inclui o arquivo 'Conexao.php' que contém a definição da classe Conexao
include_once 'Conexao.php';
// Cria uma nova instância da classe Conexao
$conex = new Conexao();
// Estabelece uma conexão com o banco de dados utilizando o método fazConexao da classe Conexao
$conex->fazConexao();
// Verifica se o usuário está logado verificando se o 'user_id' está definido na sessão
if (!isset($_SESSION['user_id'])) {
    // Se o usuário não estiver logado, redireciona para a página de login
    header('Location: login.php');
    // Encerra a execução do script para garantir que o redirecionamento ocorra imediatamente
    exit();
}
// Executa uma consulta ao banco de dados para obter todos os itens da tabela 'items'
$stmt = $conex->conn->query("SELECT * FROM items");
// Busca todos os resultados da consulta e armazena na variável $items
$items = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Listagem de Itens</title>
</head>
<body>
    <h2>Bem-vindo, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <a href="logout.php">Sair</a>
    <h2>Itens</h2>
    <ul>
        <?php foreach ($items as $item): ?>
            <li><?php echo htmlspecialchars($item['name']) . ": " 
            .htmlspecialchars($item['description']); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>

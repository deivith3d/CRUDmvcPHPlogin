<?php
// Inicia uma nova sessão ou retoma a sessão existente
session_start();

// Inclui o arquivo 'Conexao.php' que contém a definição da classe Conexao
include_once '../dao/Conexao.php';

// Cria uma nova instância da classe Conexao
$conex = new Conexao();

// Estabelece uma conexão com o banco de dados utilizando o método fazConexao da classe Conexao
$conex->fazConexao();

// Verifica se o método de requisição é POST, ou seja, se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém o nome de usuário, a senha e a confirmação de senha enviados pelo formulário
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // Verifica se as senhas coincidem
    if ($password !== $password_confirm) {
        // Define uma mensagem de erro se as senhas não coincidirem
        $error = 'As senhas não coincidem.';
    } else {
        // Prepara uma consulta SQL para verificar se o nome de usuário já existe no banco de dados
        $stmt = $conex->conn->prepare("SELECT * FROM users WHERE username = ?");
        // Executa a consulta com o nome de usuário fornecido
        $stmt->execute([$username]);
        // Verifica se o nome de usuário já foi registrado
        if ($stmt->fetch()) {
            // Define uma mensagem de erro se o nome de usuário já existir
            $error = 'Nome de usuário já existe.';
        } else {
            // Cria um hash da senha utilizando o algoritmo bcrypt
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            // Prepara uma consulta SQL para inserir o novo usuário no banco de dados
            $stmt = $conex->conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            // Executa a consulta para inserir o novo usuário
            if ($stmt->execute([$username, $hashed_password])) {
                // Define uma mensagem de sucesso se o usuário for registrado com sucesso
                $success = 'Usuário registrado com sucesso. Você pode fazer login agora.';
            } else {
                // Define uma mensagem de erro se houver um problema ao registrar o usuário
                $error = 'Erro ao registrar o usuário. Tente novamente.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Registro de Novo Usuário</title>
    </head>
    <body>
        <h2>Registro de Novo Usuário</h2>
        <?php if (isset($error)): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <p style="color:green;"><?php echo $success; ?></p>
        <?php endif; ?>
        <form method="POST">
            <label>Nome de usuário:</label>
            <input type="text" name="username" required><br>
            <label>Senha:</label>
            <input type="password" name="password" required><br>
            <label>Confirme a senha:</label>
            <input type="password" name="password_confirm" required><br>
            <button type="submit">Registrar</button>
        </form>
        <br>
        <a href="login.php">Já tem uma conta? Faça login</a>
    </body>
</html>

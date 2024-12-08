<?php
session_start(); // Inicie a sessão

// Inclui o arquivo de conexão
require 'conexao.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $re = $_POST['re'];
    $password = $_POST['password'];

    // Consulta para verificar o usuário
    try {
        $stmt = $pdo->prepare("SELECT password, acesso FROM usuarios_nivel WHERE re = :re");
        $stmt->bindParam(':re', $re);
        $stmt->execute();

        // Obtém o registro correspondente
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Login bem-sucedido: define as variáveis de sessão
            $_SESSION['logged_in'] = true;
            $_SESSION['re'] = $re; // Armazena o RE
            $_SESSION['access_level'] = $user['acesso']; // Armazena o nível de acesso

            // Redireciona para a página do sistema
            header('Location: ../../pages/sistema.php');
            exit;
        } else {
            // RE ou senha inválidos
            echo "RE ou senha incorretos.";
        }
    } catch (PDOException $e) {
        echo "Erro ao verificar os dados: " . $e->getMessage();
    }
} else {
    echo "Método de requisição inválido.";
}
?>


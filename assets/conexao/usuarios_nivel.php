<?php
// Inclui o arquivo de conexão
require 'conexao.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $re = $_POST['re'];
    $opm = $_POST['opm'];
    $posto_graduacao = $_POST['posto_graduacao'];
    $nome_guerra = $_POST['nome_guerra'];
    $acesso = $_POST['acesso'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $resp_cad = $_POST['resp_cad'];

    // Verifica se as senhas coincidem
    if ($password !== $password_confirm) {
        echo "As senhas não conferem.";
        exit;
    }

    // Verifica se o RE já existe na tabela
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios_nivel WHERE re = :re");
    $stmt->bindParam(':re', $re);
    $stmt->execute();
    $reExists = $stmt->fetchColumn();

    if ($reExists) {
        echo "O RE já está cadastrado. Por favor, use um RE único.";
        exit;
    }

    // Insere os dados na tabela
    try {
        $stmt = $pdo->prepare("
            INSERT INTO usuarios_nivel (re, opm, posto_graduacao, nome_guerra, acesso, password, resp_cad)
            VALUES (:re, :opm, :posto_graduacao, :nome_guerra, :acesso, :password, :resp_cad)
        ");
        $stmt->bindParam(':re', $re);
        $stmt->bindParam(':opm', $opm);
        $stmt->bindParam(':posto_graduacao', $posto_graduacao);
        $stmt->bindParam(':nome_guerra', $nome_guerra);
        $stmt->bindParam(':acesso', $acesso);
        // Criptografa a senha antes de salvar
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':resp_cad', $resp_cad);

        $stmt->execute();

        echo "<script>
        alert('Cadastro realizado com sucesso!');
        window.location.href = '../../pages/p_um/nivel_acesso.php';
    </script>";
    } catch (PDOException $e) {
        echo "Erro ao salvar os dados: " . $e->getMessage();
    }
}
?>

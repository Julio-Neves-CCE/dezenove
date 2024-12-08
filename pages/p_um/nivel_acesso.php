<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php"); // Redireciona para a página de login
    exit;
}

// Verifica se o nível de acesso é permitido
$allowed_access_levels = ['admin', 'gerente'];
if (!in_array($_SESSION['access_level'], $allowed_access_levels)) {
    echo "Você não tem permissão para acessar esta página.";
    exit;
}

// Inclui a conexão com o banco de dados
require '../../assets/conexao/conexao.php';

// Obtém o RE do usuário logado
$re = $_SESSION['re'];

try {
    // Busca os dados do usuário logado
    $stmt = $pdo->prepare("SELECT posto_graduacao, nome_guerra FROM usuarios_nivel WHERE re = :re");
    $stmt->bindParam(':re', $re);
    $stmt->execute();
    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user_data) {
        $posto_graduacao = $user_data['posto_graduacao'];
        $nome_guerra = $user_data['nome_guerra'];
    } else {
        echo "Erro: Dados do usuário não encontrados.";
        exit;
    }
} catch (PDOException $e) {
    echo "Erro ao buscar dados do usuário: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P/1-Nível de Acesso</title>
    <link rel="stylesheet" href="../../assets/css/p_um.css">
    <link rel="stylesheet" href="../../assets/css/main_p_um.css">
    <link rel="shortcut icon" href="../../assets/img/icons8-estrela-48.png" type="image/x-icon">

</head>


<body>
    <header>
        <img src="../../assets/img/brasao.png" alt="">
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#" id="estrutura-link">Estrutura</a></li>
            <li><a href="#">Quem somos?</a></li>
            <li><a href="#">Contato</a></li>
        </ul>
    </header>
    <main>
        <section>
            <ul>
                <li><a href="#">Nível de Acesso</a></li>

                <a href="efetivo.php" id="back"><img src="../../assets/img/icons8-rewind-button-round-48.png" alt=""></a>
            </ul>
            <img src="" alt="">
        </section>
        <fieldset>
            <legend>Nível de Acesso</legend>
            <form action="../../assets/conexao/usuarios_nivel.php" method="POST">
                <div>
                <label for="re">Digite o RE:</label><br>
                <input type="re" id="re" name="re" placeholder="000.000-0" required><br>
                    <input type="text" id="opm" name="opm" readonly><br>
                </div>
                <div>

                    <input type="text" id="posto_graduacao" name="posto_graduacao" readonly>

                    <input type="text" id="nome_guerra" name="nome_guerra" readonly><br>
                </div>

                <label for="acesso">Nível de Acesso:</label><br>
                <select name="acesso" id="acesso">

                    <option value="gerente">Gerente</option>
                    <option value="usuario">Usuário</option>
                    <option value="convidado">Convidado</option>
                </select><br>

                <label for="senha">Senha:</label><br>
                <input type="password" name="password"><br>

                <label for="senha_confirma">Confirma Senha:</label><br>
                <input type="password" name="password_confirm"><br>

                <label for="resp_cad">Responsável:</label><br>
                <input type="text" name="resp_cad" id="resp_cad" value="<?php echo htmlspecialchars($posto_graduacao . ' ' . $nome_guerra); ?>" readonly>


                <div class="center-button">
                    <input type="submit" value="Cadastrar" name="cadastrar">
                </div>
            </form>
        </fieldset>
    </main>


    <script src="../../assets/js/formatRE.js"></script>
    <script src="../../assets/js/buscadadosRE.js"></script>
    <script src="../../assets/js/confirmaSenha.js"></script>

</body>

</html>
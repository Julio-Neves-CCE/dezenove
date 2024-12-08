<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php"); // Redireciona para a página de login
    exit;
}

// Verifica se o nível de acesso é permitido
$allowed_access_levels = ['admin', 'gerente', 'usuario'];
if (!in_array($_SESSION['access_level'], $allowed_access_levels)) {
    echo "Você não tem permissão para acessar esta página.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seção Operacional</title>
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
                <li><a href="#">Cadastro Simples</a></li>

                <a href="efetivo.php" id="back"><img src="../../assets/img/icons8-rewind-button-round-48.png" alt=""></a>
            </ul>
            <img src="" alt="">
        </section>
        <fieldset>
            <legend>Cadastro Simples</legend>
            <form action="../../assets/conexao/processar_cad_simples.php" method="POST">
                <label for="re">Digite o RE:</label><br>
                <input type="text" id="re" name="re" placeholder="000.000-0"><br>

                <label for="posto" name="posto_graduacao">Posto/Graduação</label><br>
                <select name="posto_graduacao" id="posto_graduacao">
                    <option value="Cel PM">Cel PM</option>
                    <option value="Ten Cel PM">Ten Cel PM</option>
                    <option value="Maj PM">Maj PM</option>
                    <option value="Cap PM">Cap PM</option>
                    <option value="1º Ten PM">1º Ten PM</option>
                    <option value="2º Ten PM">2º Ten PM</option>
                    <option value="Asp Of PM">Asp Of PM</option>
                    <option value="SubTen PM">SubTen PM</option>
                    <option value="1º Sgt PM">1º Sgt PM</option>
                    <option value="2º Sgt PM">2º Sgt PM</option>
                    <option value="3º Sgt PM">3º Sgt PM</option>
                    <option value="Cb PM">Cb PM</option>
                    <option value="Sd PM">Sd PM</option>
                    
                </select><br>
                <label for="name">Nome de Guerra:</label><br>
                <input type="text" id="nome_guerra" name="nome_guerra"><br>
                
                <label for="opm" name="opm">OPM</label><br>
                <select name="opm" id="opm">
                    <option value="EM">EM</option>
                    <option value="1ª Cia">1ª Cia</option>
                    <option value="2ª Cia">2ª Cia</option>
                    <option value="3ª Cia CM">3ª Cia CM</option>
                    <option value="3ª Cia AN">3ª Cia AN</option>
                    <option value="3ª Cia EC">3ª Cia EC</option>
                    <option value="FT">Força Tática</option>
                </select><br>
                
                <div class="center-button">
                    <input type="submit" value="Cadastrar" name="cadastrar"></div>
            </form>
        </fieldset>
    </main>


    <script src="../../assets/js/formatRE.js"></script>
</body>

</html>
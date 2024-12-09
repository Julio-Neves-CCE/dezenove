<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php"); // Redireciona para a página de login
    exit;
}

// Verifica se o nível de acesso é permitido
$allowed_access_levels = ['admin', 'gerente', 'usuario', 'convidado'];
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
    <title>IPM - Inserir IPM</title>
    <link rel="stylesheet" href="../../../assets/css/spjmd.css">
    <link rel="stylesheet" href="../../../assets/css/main_p_um.css">
    <link rel="shortcut icon" href="../../../assets/img/icons8-estrela-48.png" type="image/x-icon">

</head>

<body>
    <header>
        <img src="../../../assets/img/brasao.png" alt="">
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
                <li><a href="#">Novo IPM</a></li>

                <a href="ipm.php" id="back"><img src="../../../assets/img/icons8-rewind-button-round-48.png" alt=""></a>
            </ul>
            <img src="" alt="">
        </section>
        <fieldset>
            <legend>Inserir Novo IPM</legend>
            <form action="../../../assets/conexao/processar_novo_ipm.php" method="POST">
                <label for="portaria">Número de Portaria:</label><br>
                <input type="text" name="portaria_numero" id="portaria_numero" placeholder="00/000/00" required><br>
                <label for="resumo">Resumo do Fato:</label><br>
                <input type="text" name="resumo" id="resumo"><br>
                <label for="local">Local do Fato:</label><br>
                <select name="local" id="local">
                    <option value="Americana">Americana</option>
                    <option value="Santa Barbara d Oeste">Santa Bárbara d Oeste</option>
                    <option value="Cosmopolis">Cosmópolis</option>
                    <option value="Artur Nogueira">Artur Nogueira</option>
                    <option value="Engenheiro Coelho">Engenheiro Coelho</option>
                </select><br>
                <label for="opm" name="opm">OPM</label><br>
                <select name="opm" id="opm">
                    <option value="1ª Cia">1ª Cia</option>
                    <option value="2ª Cia">2ª Cia</option>
                    <option value="3ª Cia CM">3ª Cia CM</option>
                    <option value="3ª Cia AN">3ª Cia AN</option>
                    <option value="3ª Cia EC">3ª Cia EC</option>
                </select><br>
                <label for="data_fato">Data do Fato:</label><br>
                <input type="date" name="data_fato" id="data_fato"><br>
                <div class="campo-container">
                    <div>
                        <label for="data_portaria">Data da Portaria:</label><br>
                        <input type="date" name="data_portaria" id="data_portaria">
                    </div>
                    <div>
                        <label for="prazo">Prazo:</label><br>
                        <input type="text" name="prazo" id="prazo">
                    </div>
                </div>
                <label for="encarregado">Encarregado:</label><br>
                <div>
                    <label for="re">Digite o RE:</label><br>
                    <input type="re" id="re" name="re" placeholder="000.000-0" required><br>
                </div>
                <div>
                    <input type="text" id="posto_graduacao" name="posto_graduacao" readonly>
                    <input type="text" id="nome_guerra" name="nome_guerra" readonly><br>
                </div>
                <label for="data_status">Status</label><br>
                <select name="data_status" id="data_status">
                    <option value="instrução">Instrução</option>
                    <option value="TJM - cota">TJM - cota</option>
                    <option value="TJM - índicio de crime">TJM - índicio de crime</option>
                    <option value="TJM - pedido de arquivamento">TJM - pedido de arquivamento</option>
                    <option value="Arquivado">Arquivado</option>
                    <option value="Outros">Outros</option>
                </select><br>
                <div class="center-button">
                        <input type="submit" value="Cadastrar" name="cadastrar">
                    </div>
            </form>


        </fieldset>

    </main>
    <script src="../../../assets/js/formatPortaria.js"></script>
    <script src="../../../assets/js/formatRE.js"></script>
    <script src="../../../assets/js/buscadadosRE.js"></script>


</body>

</html>
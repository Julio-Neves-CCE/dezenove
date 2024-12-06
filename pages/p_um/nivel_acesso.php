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

                <a href="p_um.php" id="back"><img src="../../assets/img/icons8-rewind-button-round-48.png" alt=""></a>
            </ul>
            <img src="" alt="">
        </section>
        <fieldset>
            <legend>Nível de Acesso</legend>
            <form action="../../assets/conexao/#" method="POST">
        <div>
            <label for="re">Digite o RE:</label><br>
            <input type="text" id="re" name="re" placeholder="000.000-0" required><br>
            <input type="text" id="opm" name="opm" readonly><br>
        </div>
        <div>
          
            <input type="text" id="posto_graduacao" name="posto_graduacao" readonly>
          
            <input type="text" id="nome_guerra" name="nome_guerra" readonly><br>
        </div>

       
       

        <div class="center-button">
            <input type="submit" value="Cadastrar" name="cadastrar">
        </div>
    </form>
        </fieldset>
    </main>


    <script src="../../assets/js/formatRE.js"></script>
    <script src="../../assets/js/buscadadosRE.js"></script>
</body>

</html>
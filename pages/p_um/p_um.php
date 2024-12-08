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
               <li><a href="efetivo.php">Efetivo</a></li>
               <li><a href="escala.php">Escala</a></li>
              <a href="../sistema.php" id="back"><img src="../../assets/img/icons8-rewind-button-round-48.png" alt=""></a>
               </ul>
               <img src="" alt="">
        </section>

    </main>


</body>
</html>

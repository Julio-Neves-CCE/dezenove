<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../assets/css/header.css">
   
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="shortcut icon" href="../assets/img/icons8-estrela-48.png" type="image/x-icon">

    
   
</head>
<body>
    <header>
        <img src="../assets/img/brasao.png" alt="Brasão">
        <ul>
            <li><a href="#">Login</a></li>
            <li><a href="#">Contato</a></li>
        </ul>
    </header>
    <main>
        <!-- Tela de Login -->
        <h2>Solicitar Acesso</h2>
        <fieldset>
            <form action="#" method="POST">
                <div class="input-group">
                    <label for="username">Email</label>
                    <input type="email" id="username" name="username" placeholder="Digite seu email" required>
                </div>
                <div class="input-group">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password" placeholder="Digite sua senha" required>
                </div>
                <div class="input-group">
                    <input type="submit" value="Entrar">
                </div>
            </form>
            <div class="info-text">
            <p>Digite suas credenciais para acessar sua conta.</p>
        </div>
        </fieldset>
       
    </main>
</body>
</html>

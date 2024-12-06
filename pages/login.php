<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
   
   
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="shortcut icon" href="../assets/img/icons8-estrela-48.png" type="image/x-icon">

    
   
</head>
<body>

    <main>
        <!-- Tela de Login -->
       
        <fieldset>
            <form action="#" method="POST">
                <div class="input-group">
                    <label for="re">Digite o RE:</label>
                    <input type="re" id="re" name="re" placeholder="000.000-0" required>
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
    <script src="../assets/js/formatRE.js"></script>
</body>
</html>

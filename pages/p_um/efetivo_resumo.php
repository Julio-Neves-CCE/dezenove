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

// Inclui a conexão com o banco de dados
require_once("../../assets/conexao/conexao.php");

// Função para calcular a porcentagem
function calcularPorcentagem($existente, $fixado) {
    if ($fixado == 0) {
        return 0;
    }
    return ($existente / $fixado) * 100;
}

// Função para definir a cor da célula "Claro"
function definirCorClaro($existente, $fixado) {
    if ($existente > $fixado) {
        return 'green';  // Maior que fixado, cor verde
    } elseif ($existente < $fixado) {
        return 'red';    // Menor que fixado, cor vermelha
    } else {
        return 'blue';   // Igual, cor azul
    }
}

// Definir os valores fixados
$fixado = [
    'EM' => 72,
    '1ª Cia' => 156,
    '2ª Cia' => 122,
    '3ª Cia - CM' => 47,
    '3ª Cia - AN' => 34,
    '3ª Cia - EC' => 15,
    'FT' => 91
];

// Inicializar array para armazenar os resultados de contagem de "Existente"
$existente = [];

// Consultar os dados da tabela usuarios_simples
$query = "SELECT OPM FROM usuarios_simples";
$result = $pdo->query($query);
$rows = $result->fetchAll(PDO::FETCH_ASSOC);

// Contar as ocorrências de cada UOP na coluna OPM
foreach ($fixado as $uop => $valorFixado) {
    $existente[$uop] = 0; // Inicializa a contagem para cada UOP
    foreach ($rows as $row) {
        if (strpos($row['OPM'], $uop) !== false) {
            $existente[$uop]++; // Incrementa a contagem quando a categoria é encontrada
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P/1 - Efetivo Resumo</title>
    <link rel="stylesheet" href="../../assets/css/p_um.css">
    <link rel="stylesheet" href="../../assets/css/main_p_um.css">
    <link rel="stylesheet" href="../../assets/css/table.css">
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
            <h2>Efetivo Resumo</h2>
            <a href="efetivo.php" id="back"><img src="../../assets/img/icons8-rewind-button-round-48.png" alt=""></a>
            <table>
                <thead>
                    <tr>
                        <th>UOP</th>
                        <th>Existente</th>
                        <th>Fixado</th>
                        <th>Claro</th>
                        <th>%</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalExistente = 0;
                    $totalFixado = 0;

                    foreach ($fixado as $uop => $valorFixado) {
                        $existenteContagem = $existente[$uop];
                        $porcentagem = calcularPorcentagem($existenteContagem, $valorFixado);
                        $corClaro = definirCorClaro($existenteContagem, $valorFixado);

                        // Acumulando totais para o cálculo final
                        $totalExistente += $existenteContagem;
                        $totalFixado += $valorFixado;

                        echo "<tr>";
                        echo "<td>{$uop}</td>";
                        echo "<td>{$existenteContagem}</td>";
                        echo "<td>{$valorFixado}</td>";
                        echo "<td class='{$corClaro}'>". ($existenteContagem > $valorFixado ? 'Maior' : ($existenteContagem < $valorFixado ? 'Menor' : 'Igual')) . "</td>";
                        echo "<td>". number_format($porcentagem, 2) ."%</td>";
                        echo "</tr>";
                    }

                    // Calculando o total
                    $totalPorcentagem = calcularPorcentagem($totalExistente, $totalFixado);
                    ?>
                    <tr>
                        <td><strong>Totais</strong></td>
                        <td><?php echo $totalExistente; ?></td>
                        <td><?php echo $totalFixado; ?></td>
                        <td></td>
                        <td><?php echo number_format($totalPorcentagem, 2); ?>%</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>

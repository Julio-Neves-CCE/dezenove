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

// Incluir a conexão com o banco de dados
require_once '../../../assets/conexao/conexao.php'; // Inclui o arquivo de conexão

// Definir a consulta SQL para obter os dados
$sql = "SELECT portaria_numero, resumo, data_portaria, prazo, data_status FROM novo_ipm WHERE data_status = 'intrucao'";
$result = $conn->query($sql);

// Função para calcular a data de vencimento e a contagem de prazo
function calcularPrazo($dataPortaria, $prazo) {
    $dataPortaria = new DateTime($dataPortaria);
    $dataVencimento = $dataPortaria->modify("+$prazo days");
    $dataVencimentoFormatted = $dataVencimento->format('d-m-Y'); // Formato dd-mm-aaaa
    
    // Calcular a diferença entre a data de vencimento e a data atual
    $hoje = new DateTime();
    $intervalo = $hoje->diff($dataVencimento);
    $diasRestantes = $intervalo->days;
    if ($hoje > $dataVencimento) {
        $diasRestantes = -$intervalo->days; // Se passou da data de vencimento
    }
    
    // Determinar a cor do background baseado nos dias restantes
    $cor = "";
    if ($diasRestantes > 10) {
        $cor = "green";
    } elseif ($diasRestantes <= 10 && $diasRestantes > 5) {
        $cor = "yellow";
    } elseif ($diasRestantes <= 5 && $diasRestantes >= 0) {
        $cor = "red";
    } else {
        $cor = "gray"; // "Vencido"
    }
    
    return [$dataVencimentoFormatted, $diasRestantes, $cor];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPM</title>
    <link rel="stylesheet" href="../../../assets/css/spjmd.css">
    <link rel="stylesheet" href="../../../assets/css/main_p_um.css">
    <link rel="stylesheet" href="../../../assets/css/table_resumo.css">
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
               <li><a href="intrucao.php">Em Instrução</a></li>
               <a href="ipm.php" id="back"><img src="../../../assets/img/icons8-rewind-button-round-48.png" alt=""></a>
           </ul>

           <!-- Tabela com dados -->
           <table>
               <thead>
                   <tr>
                       <th>Portaria Número</th>
                       <th>Resumo</th>
                       <th>Data Portaria</th>
                       <th>Prazo</th>
                       <th>Data Vencimento</th>
                       <th>Contagem Prazo</th>
                   </tr>
               </thead>
               <tbody>
                   <?php
                   // Verificar se existem resultados
                   if ($result->num_rows > 0) {
                       // Exibir os dados em linhas
                       while($row = $result->fetch_assoc()) {
                           // Calcular data vencimento e contagem de prazo
                           list($dataVencimento, $diasRestantes, $cor) = calcularPrazo($row['data_portaria'], $row['prazo']);
                           
                           // Formatar a data_portaria para o formato dd-mm-aaaa
                           $dataPortariaFormatted = (new DateTime($row['data_portaria']))->format('d-m-Y');
                           
                           echo "<tr>";
                           echo "<td>" . htmlspecialchars($row['portaria_numero']) . "</td>";
                           echo "<td>" . htmlspecialchars($row['resumo']) . "</td>";
                           echo "<td>" . htmlspecialchars($dataPortariaFormatted) . "</td>";
                           echo "<td>" . htmlspecialchars($row['prazo']) . "</td>";
                           echo "<td>" . htmlspecialchars($dataVencimento) . "</td>";
                           // Contagem de prazo com cor de fundo
                           echo "<td style='background-color: $cor;'>" . ($diasRestantes >= 0 ? $diasRestantes . " dias" : "Vencido") . "</td>";
                           echo "</tr>";
                       }
                   } else {
                       echo "<tr><td colspan='6'>Nenhum registro encontrado</td></tr>";
                   }
                   // Fechar a conexão
                   $conn->close();
                   ?>
               </tbody>
           </table>
        </section>
    </main>
</body>
</html>


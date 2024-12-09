<?php
// Incluindo a conexão com o banco de dados
include('conexao.php');

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Coletar os dados do formulário
    $portaria_numero = $_POST['portaria_numero'];
    $resumo = $_POST['resumo'];
    $local = $_POST['local'];
    $opm = $_POST['opm'];
    $data_fato = $_POST['data_fato'];
    $data_portaria = $_POST['data_portaria'];
    $prazo = $_POST['prazo'];
    $re = $_POST['re'];
    $posto_graduacao = $_POST['posto_graduacao'];
    $nome_guerra = $_POST['nome_guerra'];
    $data_status = $_POST['data_status'];

    // Prevenir injeção de SQL
    $portaria_numero = $conn->real_escape_string($portaria_numero);
    $resumo = $conn->real_escape_string($resumo);
    $local = $conn->real_escape_string($local);
    $opm = $conn->real_escape_string($opm);
    $data_fato = $conn->real_escape_string($data_fato);
    $data_portaria = $conn->real_escape_string($data_portaria);
    $prazo = $conn->real_escape_string($prazo);
    $re = $conn->real_escape_string($re);
    $posto_graduacao = $conn->real_escape_string($posto_graduacao);
    $nome_guerra = $conn->real_escape_string($nome_guerra);
    $data_status = $conn->real_escape_string($data_status);

    // Preparar a consulta SQL para inserção
    $sql = "INSERT INTO novo_ipm (portaria_numero, resumo, local, opm, data_fato, data_portaria, prazo, re, posto_graduacao, nome_guerra, data_status) 
            VALUES ('$portaria_numero', '$resumo', '$local', '$opm', '$data_fato', '$data_portaria', '$prazo', '$re', '$posto_graduacao', '$nome_guerra', '$data_status')";

    // Executar a consulta SQL
    if ($conn->query($sql) === TRUE) {
        header('location:../../pages/spjmd/ipm/novo_ipm.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    // Fechar a conexão
    $conn->close();
}
?>

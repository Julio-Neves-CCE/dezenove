<?php
// Inclui o arquivo de conexão
require_once '../../assets/conexao/conexao.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastrar'])) {
    // Captura os dados enviados pelo formulário
    $re = isset($_POST['re']) ? trim($_POST['re']) : null;
    $postoGraduacao = isset($_POST['posto_graduacao']) ? trim($_POST['posto_graduacao']) : null;
    $nomeGuerra = isset($_POST['nome_guerra']) ? trim($_POST['nome_guerra']) : null;
    $opm = isset($_POST['opm']) ? trim($_POST['opm']) : null;

    // Depuração opcional (remova após resolver)
    // echo "<pre>";
    // var_dump($re, $postoGraduacao, $nomeGuerra, $opm);
    // exit;

    // Verifica se todos os campos obrigatórios foram preenchidos
    if (!empty($re) && !empty($postoGraduacao) && !empty($nomeGuerra) && !empty($opm)) {
        // Insere os dados no banco de dados
        $sql = "INSERT INTO usuarios_simples (re, posto_graduacao, nome_guerra, opm) VALUES (?, ?, ?, ?)";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$re, $postoGraduacao, $nomeGuerra, $opm]);

            // Exibe mensagem de sucesso e redireciona
            echo "<script>
                alert('Cadastro realizado com sucesso!');
                window.location.href = '../../pages/p_um/cad_simples.php';
            </script>";
        } catch (PDOException $e) {
            // Exibe mensagem de erro caso ocorra um problema
            echo "<script>
                alert('Erro ao cadastrar: " . $e->getMessage() . "');
                window.history.back();
            </script>";
        }
    } else {
        // Exibe mensagem de erro caso algum campo obrigatório não seja preenchido
        echo "<script>
            alert('Preencha todos os campos obrigatórios!');
            window.history.back();
        </script>";
    }
} else {
    // Caso o acesso ao arquivo não seja via POST, redireciona para a página do formulário
    header('Location: ../../pages/p_um/cad_simples.php');
    exit();
}
?>


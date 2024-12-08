<?php
require_once 'conexao.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['re'])) {
    $re = trim($_POST['re']); // Remove espaços extras do valor enviado

    // Validação do formato do RE (mantemos a validação original)
    if (!preg_match('/^\d{3}\.\d{3}-\d{1}$/', $re)) {
        echo json_encode([
            'success' => false,
            'message' => 'O RE deve estar no formato 000.000-0.'
        ]);
        exit;
    }

    try {
        // A consulta agora usa o valor de $re já normalizado, sem a necessidade de REPLACE no SQL
        $stmt = $pdo->prepare("SELECT posto_graduacao, nome_guerra, opm FROM usuarios_simples WHERE trim(re) = :re");
        $stmt->bindParam(':re', $re, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode([
                'success' => true,
                'posto_graduacao' => $result['posto_graduacao'],
                'nome_guerra' => $result['nome_guerra'],
                'opm' => $result['opm']
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'RE não encontrado.'
            ]);
        }
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Erro no servidor: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Método inválido ou campo RE ausente.'
    ]);
}

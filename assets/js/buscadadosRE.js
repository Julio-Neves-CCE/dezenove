document.getElementById('re').addEventListener('blur', function () {
    let re = this.value.trim();

    if (re === '') {
        alert('O campo RE não pode estar vazio.');
        return;
    }

    // Validação do formato RE
    const reFormat = /^\d{3}\.\d{3}-\d{1}$/;
    if (!reFormat.test(re)) {
        alert('O RE deve estar no formato 000.000-0.');
        return;
    }

    // Log para verificar o valor de RE antes da requisição
    console.log('Valor de RE enviado para busca:', re);


    // Ajuste do caminho da requisição
    fetch('/dezenove/assets/conexao/busca_dados_re.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `re=${encodeURIComponent(re)}`
    })
    .then(response => {
        console.log('Resposta do servidor:', response); // Verifique se a resposta é OK
        if (!response.ok) {
            throw new Error('Erro de rede');
        }
        return response.json();
    })
    .then(data => {
        console.log('Dados recebidos:', data); // Verifique os dados recebidos
        if (data.success) {
            document.getElementById('posto_graduacao').value = data.posto_graduacao;
            document.getElementById('nome_guerra').value = data.nome_guerra;
            document.getElementById('opm').value = data.opm;
        } else {
            alert(data.message || 'RE não encontrado.');
            document.getElementById('posto_graduacao').value = '';
            document.getElementById('nome_guerra').value = '';
            document.getElementById('opm').value = '';
        }
    })
    .catch(error => {
        console.error('Erro ao buscar os dados:', error); // Log detalhado do erro
        alert('Erro ao processar a solicitação.');
    });
});

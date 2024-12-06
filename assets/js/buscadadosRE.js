document.getElementById('re').addEventListener('blur', function () {
    const re = this.value.trim();

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

    // Fazendo a requisição AJAX
    fetch('../../assets/conexao/busca_dados_re.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `re=${encodeURIComponent(re)}`
    })
        .then(response => response.json())
        .then(data => {
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
            console.error('Erro ao buscar os dados:', error);
            alert('Erro ao processar a solicitação.');
        });
});

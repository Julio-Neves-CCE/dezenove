document.addEventListener('DOMContentLoaded', function () {
    // Seleciona os inputs que precisam da máscara
    const inputs = document.querySelectorAll('#re, #re_encarregado, #re_escrivao');

    inputs.forEach(input => {
        input.addEventListener('input', function (event) {
            let inputValue = event.target.value;

            // Remove tudo que não seja letra ou número
            inputValue = inputValue.replace(/[^a-zA-Z0-9]/g, '');

            // Aplica a máscara 000.000-0
            if (inputValue.length <= 3) {
                inputValue = inputValue.replace(/(\w{3})/, '$1');
            } else if (inputValue.length <= 6) {
                inputValue = inputValue.replace(/(\w{3})(\w{0,3})/, '$1.$2');
            } else if (inputValue.length <= 8) {
                inputValue = inputValue.replace(/(\w{3})(\w{3})(\w{0,1})/, '$1.$2-$3');
            }

            // Atualiza o valor do input
            event.target.value = inputValue.toUpperCase(); // Deixa o valor em maiúsculo, caso tenha letras
        });
    });
});


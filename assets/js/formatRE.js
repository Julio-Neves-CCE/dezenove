document.addEventListener('DOMContentLoaded', function () {
    // Seleciona os inputs que precisam da máscara
    const inputs = document.querySelectorAll('#re, #re_encarregado, #re_escrivao');

    inputs.forEach(input => {
        input.addEventListener('input', function (event) {
            let inputValue = event.target.value;

            // Remove tudo que não seja número (isso deve manter apenas números)
            inputValue = inputValue.replace(/\D/g, '');

            // Aplica a máscara 000.000-0
            if (inputValue.length <= 3) {
                inputValue = inputValue.replace(/(\d{3})/, '$1');
            } else if (inputValue.length <= 6) {
                inputValue = inputValue.replace(/(\d{3})(\d{0,3})/, '$1.$2');
            } else if (inputValue.length <= 9) {
                inputValue = inputValue.replace(/(\d{3})(\d{3})(\d{0,1})/, '$1.$2-$3');
            }

            // Atualiza o valor do input com a máscara aplicada
            event.target.value = inputValue; // Não precisa deixar em maiúsculo se o RE não tiver letras
        });
    });
});

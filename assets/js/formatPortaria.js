document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('portaria_numero');

    if (input) {
        input.addEventListener('input', () => {
            let value = input.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos

            if (value.length > 2) {
                value = value.slice(0, 2) + '/' + value.slice(2);
            }
            if (value.length > 6) {
                value = value.slice(0, 6) + '/' + value.slice(6);
            }
            if (value.length > 9) {
                value = value.slice(0, 9); // Limita ao tamanho máximo de 9 caracteres
            }

            input.value = value;
        });
    }
});

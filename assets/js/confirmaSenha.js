    document.addEventListener("DOMContentLoaded", () => {
        const form = document.querySelector("form");
        const passwordInput = form.querySelector('input[name="password"]');
        const confirmPasswordInput = form.querySelector('input[name="password_confirm"]');
        const submitButton = form.querySelector('input[type="submit"]');

        // Criação do elemento de mensagem de erro
        const errorMessage = document.createElement("span");
        errorMessage.style.color = "yellow";
        errorMessage.style.fontSize = "small";
        errorMessage.textContent = "Senha não confere";
        errorMessage.style.display = "none"; // Oculto por padrão
        confirmPasswordInput.parentNode.insertBefore(errorMessage, confirmPasswordInput.nextSibling);

        // Função para validar as senhas
        function validatePasswords() {
            if (passwordInput.value === confirmPasswordInput.value) {
                errorMessage.style.display = "none";
                submitButton.disabled = false; // Habilita o botão
            } else {
                errorMessage.style.display = "inline"; // Mostra a mensagem
                submitButton.disabled = true; // Desabilita o botão
            }
        }

        // Adiciona eventos de input nos campos de senha
        passwordInput.addEventListener("input", validatePasswords);
        confirmPasswordInput.addEventListener("input", validatePasswords);
    });

// Pega o link "Estrutura" e a imagem com id "estrutura-img"
const estruturaLink = document.getElementById('estrutura-link');
const estruturaImg = document.getElementById('estrutura-img');

// Evento de clique para rolar até a imagem
estruturaLink.addEventListener('click', (e) => {
    e.preventDefault(); // Evita o comportamento padrão do link (não vai navegar para outra página)
    
    // Rola suavemente até a imagem com o id 'estrutura-img'
    estruturaImg.scrollIntoView({
        behavior: 'smooth',  // Rolagem suave
        block: 'start'      // A imagem será alinhada ao topo da janela
    });
});

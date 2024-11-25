var produtoImg = document.getElementById("produtoImg");
    var produtoMiniatura = document.getElementsByClassName("produtoMiniatura");
    produtoMiniatura[0].onclick = function(){
        produtoImg.src = produtoMiniatura[0].src;
    }
    produtoMiniatura[1].onclick = function(){
        produtoImg.src = produtoMiniatura[1].src;
    }
    produtoMiniatura[2].onclick = function(){
        produtoImg.src = produtoMiniatura[2].src;
    }
    produtoMiniatura[3].onclick = function(){
        produtoImg.src = produtoMiniatura[3].src;
    }
    document.addEventListener('DOMContentLoaded', () => {
    const addToCartButtons = document.querySelectorAll('.adicionar-carrinho');
    const cartCounter = document.querySelector('.cart-counter');
    // Função para adicionar produto ao carrinho
    function adicionarAoCarrinho(nome, preco) {
        const carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
        // Verifica se o produto já está no carrinho
        const produtoExistenteIndex = carrinho.findIndex(item => item.nome === nome);
        
        if (produtoExistenteIndex !== -1) {
            carrinho[produtoExistenteIndex].quantidade += 1;  // Aumenta a quantidade
        } else {
            carrinho.push({ nome, preco, quantidade: 1 });
        }
        localStorage.setItem('carrinho', JSON.stringify(carrinho));  // Atualiza o localStorage
        atualizarCarrinho();
    }
    // Atualiza o contador do carrinho
    function atualizarCarrinho() {
        const carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
        cartCounter.textContent = carrinho.length;  // Atualiza o contador do carrinho
    }
    // Evento de clique para adicionar ao carrinho
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            
            const nomeProduto = button.getAttribute('data-produto');
            const precoProduto = parseFloat(button.getAttribute('data-preco'));
            adicionarAoCarrinho(nomeProduto, precoProduto);
        });
    });
    // Atualiza o contador ao carregar a página
    atualizarCarrinho();
});
document.addEventListener('DOMContentLoaded', () => {
    const tabelaCarrinho = document.getElementById('tabela-carrinho');
    const subtotalElement = document.getElementById('subtotal');
    const freteElement = document.getElementById('frete');
    const totalElement = document.getElementById('total');
    // Função para carregar os produtos no carrinho a partir do localStorage
    function carregarCarrinho() {
        const carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
        let subtotal = 0;
        // Limpa a tabela antes de adicionar os produtos
        tabelaCarrinho.innerHTML = `
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Valor</th>
                <th>Ação</th>
            </tr>
        `;
        // Adiciona os produtos na tabela
        carrinho.forEach((item, index) => {
            const tr = document.createElement('tr');
            tr.classList.add('item-carrinho');
            tr.innerHTML = `
                <td>
                    <div class="info-carrinho">
                        <img src="assets/img/carrinho-${index + 1}.jpg" alt="">
                        <p>${item.produto}</p> <!-- Corrigido: 'nome' para 'produto' -->
                    </div>
                </td>
                <td>
                    <input class="quantidade" type="number" value="${item.quantidade}" data-index="${index}">
                </td>
                <td class="preco">R$ ${item.preco.toFixed(2)}</td>
                <td><a href="#" class="remover" data-index="${index}">Remover</a></td>
            `;
            tabelaCarrinho.appendChild(tr);
            // Atualiza o subtotal
            subtotal += item.preco * item.quantidade;
        });
        // Atualiza o subtotal, frete e total
        subtotalElement.textContent = `R$ ${subtotal.toFixed(2)}`;
        const frete = 77;
        freteElement.textContent = `R$ ${frete.toFixed(2)}`;
        totalElement.textContent = `R$ ${(subtotal + frete).toFixed(2)}`;
    }
    // Função para remover item do carrinho
    function removerItem(index) {
        const carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
        carrinho.splice(index, 1); // Remove o item
        localStorage.setItem('carrinho', JSON.stringify(carrinho));
        carregarCarrinho(); // Recarrega o carrinho
    }
    // Função para atualizar a quantidade do produto
    function atualizarQuantidade(index, quantidade) {
        const carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
        if (quantidade < 1) return; // Não permite quantidade negativa
        carrinho[index].quantidade = quantidade;
        localStorage.setItem('carrinho', JSON.stringify(carrinho));
        carregarCarrinho(); // Recarrega o carrinho
    }
    // Eventos para remover produtos
    tabelaCarrinho.addEventListener('click', (e) => {
        if (e.target.classList.contains('remover')) {
            const index = e.target.dataset.index;
            removerItem(index);
        }
    });
    // Eventos para atualizar quantidade
    tabelaCarrinho.addEventListener('input', (e) => {
        if (e.target.classList.contains('quantidade')) {
            const index = e.target.dataset.index;
            const quantidade = parseInt(e.target.value);
            atualizarQuantidade(index, quantidade);
        }
    });
    // Carrega os itens do carrinho ao carregar a página
    carregarCarrinho();
});
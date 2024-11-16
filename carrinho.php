<?php
session_start(); // Inicializa a sessão

// Verifica se o carrinho está vazio e inicializa, caso não exista
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = []; // Inicializa o carrinho
}

// Lógica para remover item do carrinho
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remover_item'])) {
    $index = isset($_POST['index']) ? (int)$_POST['index'] : null; // Garantir índice válido
    if ($index !== null && isset($_SESSION['carrinho'][$index])) {
        unset($_SESSION['carrinho'][$index]); // Remove o item do carrinho
        $_SESSION['carrinho'] = array_values($_SESSION['carrinho']); // Reindexa os itens
    }
    header('Location: carrinho.php'); // Redireciona para evitar reenvio do formulário
    exit();
}

// Calcula o total do carrinho
$subtotal = 0;
$frete = 77; // Valor fixo para o frete
foreach ($_SESSION['carrinho'] as $item) {
    $subtotal += $item['preco']; // Soma os preços dos itens
}
$total = $subtotal + $frete; // Total final com frete
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- Início do Menu -->
    <div class="novoMenu">
        <div class="container">
            <div class="navegador">
                <div class="logo"></div>
                <img src="assets/img/logo.png" alt="loja virtual" width="125px">
                <nav>
                    <ul id="MenuItens">
                        <li><a href="index.php">Início</a></li>
                        <li><a href="produtos.php">Produtos</a></li>
                        <li><a href="empresa.php">Empresa</a></li>
                        <li><a href="contatos.php">Contatos</a></li>
                        <li><a href="minha-conta.php">Minha conta</a></li>
                    </ul>
                    <a href="carrinho.php" title="Carrinho">
                        <img src="assets/img/carrinho2.png" alt="Carrinho" width="30px" height="30px">
                        <span id="total-carrinho"><?php echo count($_SESSION['carrinho']); ?></span>
                    </a>
                </nav>
            </div>
        </div>
    </div>
    <!-- Fim do Menu -->

    <div class="corpo-categorias carrinho-compras">
        <table id="tabela-carrinho">
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Valor</th>
                <th>Ação</th>
            </tr>
            <?php if (!empty($_SESSION['carrinho'])): ?>
                <?php foreach ($_SESSION['carrinho'] as $index => $item): ?>
                    <tr>
                        <td>
                            <img src="<?php echo htmlspecialchars($item['imagem'] ?? 'default-image.jpg'); ?>" 
                                 alt="<?php echo htmlspecialchars($item['produto']); ?>" 
                                 width="50" height="50">
                            <?php echo htmlspecialchars($item['produto']); ?>
                        </td>
                        <td>
                            <input type="number" name="quantidade" value="1" min="1" max="10" class="quantidade-produto">
                        </td> <!-- Quantidade alterável -->
                        <td>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                        <td>
                            <form method="POST" action="">
                                <input type="hidden" name="index" value="<?php echo $index; ?>">
                                <button type="submit" name="remover_item">Remover</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Seu carrinho está vazio.</td>
                </tr>
            <?php endif; ?>
        </table>

        <!-- Valor total -->
        <div class="valor-total">
            <table>
                <tr>
                    <td>Sub-total</td>
                    <td id="subtotal">R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></td>
                </tr>
                <tr>
                    <td>Frete</td>
                    <td id="frete">R$ <?php echo number_format($frete, 2, ',', '.'); ?></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td id="total">R$ <?php echo number_format($total, 2, ',', '.'); ?></td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Início do Rodapé -->
    <footer>
        <div class="rodape">
            <div class="conteiner">
                <div class="linha">
                    <div class="rodape-col-1">
                        <h3>Baixe o nosso APP</h3>
                        <p>Baixe nosso aplicativo nas melhores plataformas</p>
                    </div>
                    <div class="rodape-col-2">
                        <img src="assets/img/logo-2.png" alt="">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
                    </div>
                    <div class="rodape-col-3">
                        <h3>Mais informações</h3>
                        <ul>
                            <li>Cupons</li>
                            <li>Blog</li>
                            <li>Política de privacidade</li>
                            <li>Contatos</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Fim do Rodapé -->

</body>
</html>

<?php
session_start();

// Inicializa o carrinho se não existir
$_SESSION['carrinho'] = $_SESSION['carrinho'] ?? [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = $_POST['index'] ?? null;
    
    // Remover item
    if (isset($_POST['remover_item'], $_SESSION['carrinho'][$index])) {
        unset($_SESSION['carrinho'][$index]);
        $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);
        header('Location: carrinho.php');
        exit();
    }
    
    // Atualizar quantidade
    if (isset($_POST['atualizar_quantidade'], $_SESSION['carrinho'][$index])) {
        $_SESSION['carrinho'][$index]['quantidade'] = max(1, $_POST['quantidade'] ?? 1);
        header('Location: carrinho.php');
        exit();
    }
}

// Cálculo do subtotal e total
$frete = 77;
$subtotal = array_sum(array_map(fn($item) => $item['preco'] * ($item['quantidade'] ?? 1), $_SESSION['carrinho']));
$total = $subtotal + $frete;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja virtual</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/stylerodape.css">
    <link rel="stylesheet" href="assets/css/stylemenu.css">
    <style>body { background: radial-gradient(var(--cor-fonte), var(--cor-btn-font)); }</style>
</head>
<body>
    <div class="novoMenu">
        <div class="container">
            <div class="navegador">
                <div class="logo"></div>
                <img src="assets/img/logoestilo.png" alt="loja virtual" width="125px">
                <nav>
                    <ul id="MenuItens">
                        <li><a href="loja.php">Inicio</a></li>
                        <li><a href="produtos.php">Produtos</a></li>
                        <li><a href="#">Empresa</a></li>
                        <li><a href="#">Contatos</a></li>
                        <li><a href="index.php">Sair</a></li>
                    </ul>
                    
                    <a href="carrinho.html" title="Carrinho" id="carrinho">
                        <img src="assets/img/carrinho2.png" alt="Carrinho" width="30" height="30">
                    </a>
                </nav>
            </div>
        </div>
    </div>
    
    <div class="corpo-categorias carrinho-compras">
        <table id="tabela-carrinho">
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Valor Unitário</th>
                <th>Valor Total</th>
                <th>Ação</th>
            </tr>
            
            <?php if ($_SESSION['carrinho']): ?>
                <?php foreach ($_SESSION['carrinho'] as $index => $item): ?>
                    <tr>
                        <td>
                            <img src="<?= htmlspecialchars($item['imagem'] ?? 'default-image.jpg'); ?>" 
                                 alt="<?= htmlspecialchars($item['produto']); ?>" 
                                 width="50" height="50">
                            <?= htmlspecialchars($item['produto']); ?>
                        </td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="index" value="<?= $index; ?>">
                                <input type="number" name="quantidade" value="<?= $item['quantidade'] ?? 1; ?>" min="1">
                                <button type="submit" name="atualizar_quantidade">Atualizar</button>
                            </form>
                        </td>
                        <td>R$ <?= number_format($item['preco'], 2, ',', '.'); ?></td>
                        <td>R$ <?= number_format($item['preco'] * ($item['quantidade'] ?? 1), 2, ',', '.'); ?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="index" value="<?= $index; ?>">
                                <button type="submit" name="remover_item">Remover</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">Seu carrinho está vazio.</td></tr>
            <?php endif; ?>
        </table>
        
        <div class="valor-total">
            <table>
                <tr><td>Sub-total</td><td>R$ <?= number_format($subtotal, 2, ',', '.'); ?></td></tr>
                <tr><td>Frete</td><td>R$ <?= number_format($frete, 2, ',', '.'); ?></td></tr>
                <tr><td>Total</td><td>R$ <?= number_format($total, 2, ',', '.'); ?></td></tr>
            </table>
            <a href="pagamento.php"><button>Ir para pagamento</button></a>
        </div>
    </div>
    
</body>
</html>

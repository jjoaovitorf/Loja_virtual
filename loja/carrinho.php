<?php
session_start(); // Inicializa a sessão
// Verifica se o carrinho está vazio e inicializa, caso não exista
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}
// Lógica para remover item do carrinho
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remover_item'])) {
        $index = isset($_POST['index']) ? (int)$_POST['index'] : null; // Garante índice válido
        if ($index !== null && isset($_SESSION['carrinho'][$index])) {
            unset($_SESSION['carrinho'][$index]); // Remove o item
            $_SESSION['carrinho'] = array_values($_SESSION['carrinho']); // Reindexa os itens
        }
        header('Location: carrinho.php');
        exit();
    }
    // Lógica para atualizar quantidade
    if (isset($_POST['atualizar_quantidade'])) {
        $index = isset($_POST['index']) ? (int)$_POST['index'] : null;
        $quantidade = isset($_POST['quantidade']) ? (int)$_POST['quantidade'] : 1;
        if ($index !== null && isset($_SESSION['carrinho'][$index])) {
            $_SESSION['carrinho'][$index]['quantidade'] = $quantidade > 0 ? $quantidade : 1; // Quantidade mínima: 1
        }
        header('Location: carrinho.php');
        exit();
    }
}
// Calcula o subtotal e o total
$subtotal = 0;
$frete = 77; // Valor fixo para o frete
foreach ($_SESSION['carrinho'] as $item) {
    $subtotal += $item['preco'] * ($item['quantidade'] ?? 1);
}
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
</head>
<body>
    <!--inicio do banner   -->
    <div class="novoMenu">
        <!--inicio do container   -->
        <div class="container">
            <div class="navegador">
                <div class="logo"></div>
                <img src="assets/img/logoestilo.png" alt="loja virtual" width="125px">
                <nav>
                    <ul id="MenuItens">
                        <li><a href="index.html">Inicio</a></li>
                        <li><a href="produtos.html">produtos</a></li>
                        <li><a href="">Empresa</a></li>
                        <li><a href="">Contatos</a></li>
                        <li><a href="index.php">Sair</a></li>
                    </ul>
                    <a href="carrinho.html" title="Carrinho" id="carrinho">
                        <img src="assets/img/carrinho2.png" alt="Carrinho" width="30px" height="30px">
                    </a>
                </nav>
            </div>
        </div>
</body>
<div class="corpo-categorias carrinho-compras">
    <table id="tabela-carrinho">
        <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Valor Unitário</th>
            <th>Valor Total</th>
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
                        <!-- Formulário para atualizar quantidade -->
                        <form method="POST" action="" class="form-atualizar-quantidade">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <input type="number" name="quantidade" value="<?php echo $item['quantidade'] ?? 1; ?>" min="1">
                            <button type="submit" name="atualizar_quantidade">Atualizar</button>
                        </form>
                    </td>
                    <td>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                    <td>R$ <?php echo number_format($item['preco'] * ($item['quantidade'] ?? 1), 2, ',', '.'); ?></td>
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
                <td colspan="5">Seu carrinho está vazio.</td>
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
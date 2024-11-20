<?php
session_start();

// Redireciona se o carrinho estiver vazio
if (empty($_SESSION['carrinho'])) {
    header('Location: carrinho.php');
    exit();
}

// Calcula valores
$frete = 77; 
$subtotal = 0;

foreach ($_SESSION['carrinho'] as $item) {
    $quantidade = isset($item['quantidade']) ? $item['quantidade'] : 1;
    $subtotal += $item['preco'] * $quantidade;
}

$total = $subtotal + $frete;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Pagamento</title>
    <link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/stylerodape.css">
<link rel="stylesheet" href="assets/css/stylemenu.css">
   

</head>
<body>
    <div class="container">
        <h1>Pagamento</h1>
        <form action="processar_pagamento.php" method="POST">
            <fieldset>
                <legend>Dados do Cliente</legend>
                <label>Nome Completo: <input type="text" name="nome" required></label>
                <label>Endereço: <input type="text" name="endereco" required></label>
                <label>Telefone: <input type="text" name="telefone" required></label>
            </fieldset>

            <fieldset>
                <legend>Detalhes do Pagamento</legend>
                <label>Número do Cartão: <input type="text" name="cartao" required></label>
                <label>Validade (MM/AA): <input type="text" name="validade" placeholder="MM/AA" required></label>
                <label>CVV: <input type="text" name="cvv" required></label>
            </fieldset>

            <div class="resumo-pedido">
                <p>Subtotal: R$ <?= number_format($subtotal, 2, ',', '.'); ?></p>
                <p>Frete: R$ <?= number_format($frete, 2, ',', '.'); ?></p>
                <p><strong>Total: R$ <?= number_format($total, 2, ',', '.'); ?></strong></p>
            </div>

            <button type="submit">Finalizar Compra</button>
        </form>
    </div>
</body>
</html>

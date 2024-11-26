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
   <style>
/* Estilos gerais */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: radial-gradient(var(--cor-fonte), var(--cor-btn-font));
    color: #333;
}

/* Container principal */
.container {
    width: 80%;
    max-width: 900px;
    margin: 40px auto;
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Título */
h1 {
    text-align: center;
    color: #333;
    margin-bottom: 30px;
}

/* Fieldset */
fieldset {
    border: 1px solid #ddd;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 8px;
    background-color: #f9f9f9;
}

legend {
    font-size: 1.2em;
    font-weight: bold;
    color: black;
}

/* Labels e campos de input */
label {
    display: block;
    font-size: 1em;
    margin-bottom: 8px;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 1em;
}

input[type="text"]:focus {
    border-color: #4CAF50;
    outline: none;
}

/* Resumo do pedido */
.resumo-pedido {
    background-color: #f9f9f9;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.resumo-pedido p {
    margin: 8px 0;
}

.resumo-pedido strong {
    font-size: 1.2em;
    color: black;
}

/* Botão de finalização */
button[type="submit"] {
    width: 100%;
    padding: 15px;
    background-color: grey;
    color: white;
    font-size: 1.2em;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    margin-top: 20px;
}

button[type="submit"]:hover {
    background-color: black;
}

/* Responsividade */
@media (max-width: 768px) {
    .container {
        width: 90%;
        padding: 15px;
    }

    fieldset {
        padding: 12px;
    }

    input[type="text"] {
        font-size: 0.9em;
        padding: 8px;
    }

    button[type="submit"] {
        font-size: 1em;
        padding: 12px;
    }
}


   </style>
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

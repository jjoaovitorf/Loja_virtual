
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar pedido </title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    
</body>
</html>

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = ['nome', 'endereco', 'telefone', 'cartao', 'validade', 'cvv'];
    foreach ($dados as $campo) {
        if (empty($_POST[$campo])) {
            echo "<h1>Erro no pagamento!</h1>";
            echo "<p>Por favor, preencha todos os campos corretamente.</p>";
            exit();
        }
    }

    unset($_SESSION['carrinho']); // Limpa o carrinho
    echo "<h1>Compra finalizada com sucesso!</h1>";
    echo "<p>Obrigado, {$_POST['nome']}! Seu pedido será enviado para {$_POST['endereco']}.</p>";
} else {
    header('Location: pagamento.php');
    exit();
}

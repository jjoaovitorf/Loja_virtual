<?php
session_start(); // Inicia a sessão

// Inicializa o carrinho se ele ainda não existir
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Lógica para adicionar produtos ao carrinho
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionar_carrinho'])) {
    // Dados enviados pelo formulário
    $produto = $_POST['produto'];
    $preco = (float)$_POST['preco'];
    $imagem = $_POST['imagem'];

    // Adiciona o produto ao carrinho
    $_SESSION['carrinho'][] = [
        'produto' => $produto,
        'preco' => $preco,
        'imagem' => $imagem,
    ];

    // Atualiza o carrinho com uma mensagem de sucesso
    header('Location: produtos.php'); // Evita reenvio do formulário
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja Virtual</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/stylerodape.css">
    <link rel="stylesheet" href="assets/css/stylemenu.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Inclui jQuery -->
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
                    <li><a href="loja.php">Início</a></li>
                    <li><a href="produtos.php">Produtos</a></li>
                    <li><a href="">Empresa</a></li>
                    <li><a href="">Contatos</a></li>
                    <li><a href="index.php">Sair</a></li>
                </ul>
                <a href="carrinho.php" title="">
                    <img src="assets/img/carrinho.png" alt="" width="30px" height="30px">
                    <span id="total-carrinho"><?php echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0; ?></span>
                </a>
            </nav>
        </div>
    </div>
</div>
<!-- Fim do Menu -->

<div class="linha">
    <div class="col-4">
        <a href="ver-produto.html">
            <img src="assets/img/camisa6.webp" alt="Camisa social Manga Curta Masculina">
        </a>
        <h4>Camisa social Manga Curta Masculina</h4>
        <p>R$ 145,00</p>
        <div class="classificacao">
            <ion-icon name="star-outline"></ion-icon>
            <ion-icon name="star-outline"></ion-icon>
            <ion-icon name="star-outline"></ion-icon>
            <ion-icon name="star-outline"></ion-icon>
            <ion-icon name="star-outline"></ion-icon>
        </div>
        <!-- Formulário para adicionar ao carrinho -->
        <form method="POST" class="form-adicionar-carrinho">
            <input type="hidden" name="produto" value="Camisa social Manga Curta Masculina">
            <input type="hidden" name="preco" value="145.00">
            <input type="hidden" name="imagem" value="assets/img/camisa6.webp"> <!-- Passa a imagem -->
            <button type="submit" name="adicionar_carrinho" class="adicionar-carrinho">Adicionar ao Carrinho</button>
        </form>
    </div>

    <!-- Outros produtos aqui -->
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

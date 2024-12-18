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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
   

</head>
<body>

 <!-- Início do Menu -->
 <div class="novoMenu">
    <div class="container">
        <div class="navegador">
            <div class="logo"></div>
            <img src="assets/img/logoestilo.png" alt="loja virtual" width="125px">
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

 <h1 class="produtos-titulo">Produtos</h1>

 <div class="linha">
    <div class="col-4">
        <a href="produtos.php">
            <img src="assets/img/roupa11.webp" alt="Camisa de algodão, estampada VIAOUR">
        </a>
        <h4>Camisa de algodão, estampada VIAOUR</h4>
        <p>R$ 115,00</p>
        
        <!-- Formulário para adicionar ao carrinho -->
        <form method="POST" class="form-adicionar-carrinho">
            <input type="hidden" name="produto" value="Camisa de algodão, estampada VIAOUR">
            <input type="hidden" name="preco" value="115.00">
            <input type="hidden" name="imagem" value="assets/img/roupa11.webp"> <!-- Passa a imagem -->
        
            <button type="submit" name="adicionar_carrinho" class="adicionar-carrinho">Adicionar ao Carrinho</button>
        </form>
    </div>

    <div class="col-4">
        <a href="produtos.php">
            <img src="assets/img/roupa10.webp" alt="Camisa de algodão, estampada listrada">
        </a>
        <h4>Camisa de algodão, estampada listrada</h4>
        <p>R$ 125,00</p>
        
        <!-- Formulário para adicionar ao carrinho -->
        <form method="POST" class="form-adicionar-carrinho">
            <input type="hidden" name="produto" value="Camisa de algodão, estampada listrada">
            <input type="hidden" name="preco" value="125.00">
            <input type="hidden" name="imagem" value="assets/img/roupa10.webp"> <!-- Passa a imagem -->
            <button type="submit" name="adicionar_carrinho" class="adicionar-carrinho">Adicionar ao Carrinho</button>
        </form>
    </div>

    <div class="col-4">
        <a href="produtos.php">
            <img src="assets/img/roupa9.webp" alt="Camisa de algodão, estampada paris">
        </a>
        <h4>Camisa de algodão, estampada paris</h4>
        <p>R$ 132,00</p>
        
        <!-- Formulário para adicionar ao carrinho -->
        <form method="POST" class="form-adicionar-carrinho">
            <input type="hidden" name="produto" value="Camisa de algodão, estampada paris">
            <input type="hidden" name="preco" value="132.00">
            <input type="hidden" name="imagem" value="assets/img/roupa9.webp"> <!-- Passa a imagem -->
            <button type="submit" name="adicionar_carrinho" class="adicionar-carrinho">Adicionar ao Carrinho</button>
        </form>
    </div>


    <div class="col-4">
        <a href="produto.php">
            <img src="assets/img/roupa8.webp" alt="Camisa de algodão, estampada california">
        </a>
        <h4>Camisa de algodão, estampada</h4>
        <p>R$ 145,00</p>
        
        <!-- Formulário para adicionar ao carrinho -->
        <form method="POST" class="form-adicionar-carrinho">
            <input type="hidden" name="produto" value="Camisa de algodão, estampada california">
            <input type="hidden" name="preco" value="145.00">
            <input type="hidden" name="imagem" value="assets/img/roupa8.webp"> <!-- Passa a imagem -->
            <button type="submit" name="adicionar_carrinho" class="adicionar-carrinho">Adicionar ao Carrinho</button>
        </form>
    </div> 
  


    <div class="col-4">
        <a href="produto.pho">
            <img src="assets/img/roupa7.webp" alt="Camisa de algodão, estampada paris">
        </a>
        <h4>Camisa de algodão, estampada paris</h4>
        <p>R$ 201,00</p>
        
        <!-- Formulário para adicionar ao carrinho -->
        <form method="POST" class="form-adicionar-carrinho">
            <input type="hidden" name="produto" value="Camisa de algodão, estampada paris">
            <input type="hidden" name="preco" value="201.00">
            <input type="hidden" name="imagem" value="assets/img/roupa7.webp"> <!-- Passa a imagem -->
            <button type="submit" name="adicionar_carrinho" class="adicionar-carrinho">Adicionar ao Carrinho</button>
        </form>
    </div>



    <div class="col-4">
        <a href="produto.php">
            <img src="assets/img/roupa6.webp" alt="Camisa social marrom Manga Curta">
        </a>
        <h4>Camisa social marrom Manga Curta</h4>
        <p>R$ 69,00</p>
        
        <!-- Formulário para adicionar ao carrinho -->
        <form method="POST" class="form-adicionar-carrinho">
            <input type="hidden" name="produto" value="Camisa social marrom Manga Curta">
            <input type="hidden" name="preco" value="69.00">
            <input type="hidden" name="imagem" value="assets/img/roupa6.webp"> <!-- Passa a imagem -->
            <button type="submit" name="adicionar_carrinho" class="adicionar-carrinho">Adicionar ao Carrinho</button>
        </form>
    </div>

    <div class="col-4">
        <a href="produto.php">
            <img src="assets/img/padrao1.jpg" alt="Camisa de algodão lisa">
        </a>
        <h4>Camisa de botão preta</h4>
        <p>R$ 87,00</p>
        
        <!-- Formulário para adicionar ao carrinho -->
        <form method="POST" class="form-adicionar-carrinho">
            <input type="hidden" name="produto" value="Camisa de algodão lisa">
            <input type="hidden" name="preco" value="87.00">
            <input type="hidden" name="imagem" value="assets/img/roupa12.webp"> <!-- Passa a imagem -->
            <button type="submit" name="adicionar_carrinho" class="adicionar-carrinho">Adicionar ao Carrinho</button>
        </form>
    </div>


    <div class="col-4">
        <a href="produto.php">
            <img src="assets/img/camisa3.webp" alt="Camisa social azul Manga Curta">
        </a>
        <h4>Camisa social azul Manga Curta </h4>
        <p>R$ 110,00</p>
        
        <!-- Formulário para adicionar ao carrinho -->
        <form method="POST" class="form-adicionar-carrinho">
            <input type="hidden" name="produto" value="Camisa social azul Manga Curta">
            <input type="hidden" name="preco" value="110.00">
            <input type="hidden" name="imagem" value="assets/img/camisa3.webp"> <!-- Passa a imagem -->
            <button type="submit" name="adicionar_carrinho" class="adicionar-carrinho">Adicionar ao Carrinho</button>
        </form>
    </div>


    <div class="col-4">
        <a href="produto.php">
            <img src="assets/img/camisa4.webp" alt="Camisa social branca de botão">
        </a>
        <h4>Camisa social branca de botão</h4>
        <p>R$ 99,00</p>
        
        <!-- Formulário para adicionar ao carrinho -->
        <form method="POST" class="form-adicionar-carrinho">
            <input type="hidden" name="produto" value="Camisa social branca de botão">
            <input type="hidden" name="preco" value="99.00">
            <input type="hidden" name="imagem" value="assets/img/camisa4.webp"> <!-- Passa a imagem -->
            <button type="submit" name="adicionar_carrinho" class="adicionar-carrinho">Adicionar ao Carrinho</button>
        </form>
    </div>


    <div class="col-4">
        <a href="produto.php">
            <img src="assets/img/camisa5.webp" alt="Camisa de algodão Manga Curta">
        </a>
        <h4>Camisa de algodão Manga Curta</h4>
        <p>R$ 114,00</p>
        
        <!-- Formulário para adicionar ao carrinho -->
        <form method="POST" class="form-adicionar-carrinho">
            <input type="hidden" name="produto" value="Camisa de algodão Manga Curta">
            <input type="hidden" name="preco" value="99.00">
            <input type="hidden" name="imagem" value="assets/img/camisa5.webp"> <!-- Passa a imagem -->
            <button type="submit" name="adicionar_carrinho" class="adicionar-carrinho">Adicionar ao Carrinho</button>
        </form>
    </div>

    <!-- Outros produtos aqui -->
    <div class="col-4">
        <a href="produto.php">
            <img src="assets/img/camisa41.webp" alt="Camisa de algodão Manga Curta">
        </a>
        <h4>Camisa de algodão preta</h4>
        <p>R$ 150,00</p>
        
        <!-- Formulário para adicionar ao carrinho -->
        <form method="POST" class="form-adicionar-carrinho">
            <input type="hidden" name="produto" value="Camisa de algodão Manga Curta">
            <input type="hidden" name="preco" value="99.00">
            <input type="hidden" name="imagem" value="assets/img/camisa41.webp"> <!-- Passa a imagem -->
            <button type="submit" name="adicionar_carrinho" class="adicionar-carrinho">Adicionar ao Carrinho</button>
        </form>
    </div>



    <div class="col-4">
        <a href="produto.php">
            <img src="assets/img/camisa50.webp" alt="Camisa de algodão Manga Curta">
        </a>
        <h4>Camisa de algodão branca</h4>
        <p>R$ 50,00</p>
        
        <!-- Formulário para adicionar ao carrinho -->
        <form method="POST" class="form-adicionar-carrinho">
            <input type="hidden" name="produto" value="Camisa de algodão Manga Curta">
            <input type="hidden" name="preco" value="99.00">
            <input type="hidden" name="imagem" value="assets/img/camisa50.ewbp"> <!-- Passa a imagem -->
            <button type="submit" name="adicionar_carrinho" class="adicionar-carrinho">Adicionar ao Carrinho</button>
        </form>
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
                    <img src="assets/img/logoestilo.png" alt="">
                    <p>Elegância para Todos os Momentos!</p>
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
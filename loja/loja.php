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
    <!-- Início do banner -->
    <div class="banner">
        <div class="container">
            <div class="navegador">
                <div class="logo"></div>
                <img src="assets/img/logoestilo.png" alt="loja virtual" width="125px">
                <nav>
                    <ul id="MenuItens">
                        <li><a href="loja.php">Início</a></li>
                        <li><a href="produtos.php">Produtos</a></li>
                        <li><a href="#">Empresa</a></li>
                        <li><a href="#">Contatos</a></li>
                        <li>
                            <?php
                            session_start(); // Certifique-se de que a sessão está sendo iniciada corretamente
                            
                            // Verifica se o usuário está logado
                            if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])): ?>
                                <a href="loja.php"><?php echo $_SESSION['usuario']; ?></a> <!-- Exibe o nome do usuário -->
                            <?php else: ?>
                                <a href="index.php">Sair</a> <!-- Caso o usuário não esteja logado -->
                            <?php endif; ?>
                        </li>
                    </ul>
                    <a href="carrinho.php" title="Carrinho de compras">
                        <img src="assets/img/carrinho.png" alt="Carrinho de compras" width="30px" height="30px">
                    </a>
                </nav>
            </div>
        </div>

        <!-- Início da seção de apresentação do produto -->
        <div class="linha">
            <div class="col-2">
                <h1>Elegância para Todos os Momentos!</h1>
                <p>
                    "Descubra o seu estilo único com nossas roupas masculinas.<br>
                    Cada peça é feita para realçar a sua personalidade.<br>
                    Elegância e conforto para o homem moderno.<br>
                    Qualidade e autenticidade em cada detalhe."
                </p>
                <br><a href="#" class="btn">Mais informações &#8594;</a>
            </div>
            <div class="col-2">
                <img src="assets/img/homem-macho-confiante-em-jaqueta-de-couro-preta-apontando-dedos-para-a-esquerda-na-oferta-promocional-mostrando-o-logotipo-branco.png" alt="Imagem de um homem confiante em jaqueta de couro">
            </div>
        </div>
        <!-- Fim da seção de apresentação do produto -->
    </div>
    <!-- Fim do banner -->

    <!-- Início das categorias -->
    <div class="categorias">
        <div class="corpo-categorias">
            <div class="linha">
                <div class="col-3">
                    <img src="assets/img/padrao1.jpg" alt="Categoria 1">
                </div>
                <div class="col-3">
                    <img src="assets/img/padrao.avif" alt="Categoria 2">
                </div>
                <div class="col-3">
                    <img src="assets/img/padrao22.avif" alt="Categoria 3">
                </div>
            </div>
        </div>
    </div>
    <!-- Fim das categorias -->

    <!-- Início da seção de produtos em destaque -->
    <div class="corpo-categorias">
        <div class="titulo">
            <h2>Produtos em destaque</h2>
        </div>
        <div class="linha">
            <div class="col-4">
                <a href="produtos.php" title="Ver produto">
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
            </div>
            <div class="col-4">
                <a href="produtos.php" title="Ver produto">
                    <img src="assets/img/camisa3.webp" alt="Camisa social Manga longa Masculina">
                </a>
                <h4>Camisa social Manga Longa Masculina</h4>
                <p>R$ 214,99</p>
                <div class="classificacao">
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                </div>
            </div>
            <div class="col-4">
                <a href="produtos.php" title="Ver produto">
                    <img src="assets/img/camisa4.webp" alt="Camisa social Manga Curta Masculina">
                </a>
                <h4>Camisa social Manga Curta Masculina</h4>
                <p>R$ 149,99</p>
                <div class="classificacao">
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                </div>
            </div>
            <div class="col-4">
                <a href="produtos.php" title="Ver produto">
                    <img src="assets/img/camisa7.webp" alt="Camiseta Verde Militar Masculina">
                </a>
                <h4>Camiseta Verde Militar Masculina</h4>
                <p>R$ 99,99</p>
                <div class="classificacao">
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim da seção de produtos em destaque -->

    
    
<!-- Início do rodapé -->
<footer>
    <div class="rodape">
        <div class="conteiner">
            <div class="linha">
                <div class="rodape-col-1">
                    <h3>Baixe o nosso APP</h3>
                    <p>Baixe nosso aplicativo nas melhores plataformas</p>
                </div>
                <div class="rodape-col-2">
                    <img src="assets/img/logoestilo.png" alt="Logo">
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
        <div class="direitos">
            <p>&copy; 2024 Todos os direitos reservados.</p>
        </div>
    </div>
</footer>


</html>
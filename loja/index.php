
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? null;
    $email = $_POST['email'] ?? null;
    $senha = $_POST['senha'] ?? null;

    if ($nome && $email && $senha) {
        $conn = new mysqli('localhost', 'root', '', 'loja');
        if ($conn->connect_error) {
            echo "<script>document.getElementById('mensagemCadastro').className = 'mensagem erro ativo'; 
                  document.getElementById('mensagemCadastro').innerText = 'Erro de conexão com o banco de dados.';</script>";
        } else {
            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>document.getElementById('mensagemCadastro').className = 'mensagem sucesso ativo'; 
                      document.getElementById('mensagemCadastro').innerText = 'Usuário cadastrado com sucesso!';</script>";
            } else {
                echo "<script>document.getElementById('mensagemCadastro').className = 'mensagem erro ativo'; 
                      document.getElementById('mensagemCadastro').innerText = 'Erro ao cadastrar usuário: " . $conn->error . "';</script>";
            }
            $conn->close();
        }
    } else {
        echo "<script>document.getElementById('mensagemCadastro').className = 'mensagem erro ativo'; 
              document.getElementById('mensagemCadastro').innerText = 'Por favor, preencha todos os campos!';</script>";
    }
}

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $conn = new mysqli('localhost', 'root', '', 'loja');

    if ($conn->connect_error) {
        die('Erro de conexão: ' . $conn->connect_error);
    }

    $sql = "SELECT id, nome, is_admin FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $usuario = $result->fetch_assoc();
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['is_admin'] = $usuario['is_admin'];

        if ($usuario['is_admin']) {
            header('Location: painel_administrativo.php');
        } else {
            header('Location: loja.php');
        }
        exit;
    } else {
        
    }
    $conn->close();
}
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
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="index.php">produtos</a></li>
                        <li><a href="">Empresa</a></li>
                        <li><a href="">Contatos</a></li>
                        <li><a href="index.php">Minha conta</a></li>
                    </ul>
                    <a href="carrinho.html" title="Carrinho" id="carrinho">
                        <img src="assets/img/carrinho2.png" alt="Carrinho" width="30px" height="30px">
                    </a>
                </nav>


            </div>
        </div>
        <!-- minha conta-->
        <div class="minha-conta">
            <div class="conteiner">
                <div class="linha">
                    <div class="col-2">
                        <img src="assets/img/Inverso .png" width="100%">
                    </div>

                    <div class="col-2">
    <div class="formulario">
        <div class="bnt-form">
            <samp onclick="mostrarEntrar()" id="btnEntrar" class="active">Entrar</samp>
            <samp onclick="mostrarCadastro()" id="btnCadastro">Cadastro</samp>
        </div>
        <hr id="Indicador">

        <!-- Formulário de Login -->
        <form action="index.php" method="post" id="EntrarPainel" class="active">
            <?php if (!empty($erro_login)): ?>
                <div class="mensagem-erro">Credenciais inválidas!</div>
            <?php endif; ?>
            <input type="email" name="email" placeholder="E-mail de acesso" required>
            <input type="password" name="senha" placeholder="Digite sua senha" required>
            <button type="submit" class="btn">Entrar</button>
            <a href="#">Esqueceu sua senha?</a>
        </form>

        <!-- Formulário de Cadastro -->
        <form action="#" method="post" id="CadastroSite">
            <input type="text" name="nome" placeholder="Nome completo" required>
            <input type="email" name="email" placeholder="E-mail de acesso" required>
            <input type="password" name="senha" placeholder="Digite sua senha" required>
            <button type="submit" class="btn">Cadastrar-se</button>
        </form>
    </div>
</div>

                </div>
            </div>
        </div>

        <!-- minha conta-->

        <footer>
            <div class="rodape">
                <div class="conteiner">
                    <div class="linha">
                        <div class="rodape-col-1">
                           <h3>Baixe o nosso APP</h>
                            <p>Baixe nosso aplicativos nas melhorres plataformas</p>
                            <div class="app-logo">
                                <img src="assets/img/google.png" alt="">
                                <i<mg src="assets/img/apple.png" alt="">
                            </div>
                        </div>
                        <div class="rodape-col-2">
                            <img src="assets/img/logoestilo.png" alt="">
                            <p> Lorem Ipsum is simply dummy text of the printing <br>and typesetting industry</p>
                        </div>

                        <div class="rodape-col-3">
                            <h3> Mais inforamções</h3>
                            <ul>
                                <li>Cupons</li>
                                <li>Blog</li>
                                <li>Politica de privacidade</li>
                                <li>Contatos</li>
                            </ul>
                        </div>
                        <div class="rodape-col-4">
                            <h3> redes sociais</h3>
                            <ul>
                                <li>facebook</li>
                                <li>Intagram</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr>
                <p>
                <div class="direitos">
                    &#169; Todos os direitos reservados a msflix.com.br
                </div>
                </p>
            </div>
        </footer>

        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script src="assets/js/login.js"></script>
</body>

</html>
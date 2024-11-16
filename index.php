<?php
session_start();

// Conexão com o banco de dados
$host = 'localhost';
$usuario = 'root'; // Substituir caso necessário
$senha = '';       // Substituir caso necessário
$banco = 'loja';
$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

$erroLogin = "";
$erroCadastro = "";

// Dados do administrador
$nomeAdmin = 'Administrador';
$emailAdmin = 'admin@loja.com';
$senhaAdmin = 'admin1234'; // Senha do admin

// Gera o hash da senha do administrador
$senhaHash = password_hash($senhaAdmin, PASSWORD_DEFAULT);

// Insere o administrador no banco de dados (verificar se já não existe)
$sqlVerificaAdmin = "SELECT * FROM usuarios WHERE email = ?";
$stmtVerificaAdmin = $conexao->prepare($sqlVerificaAdmin);
$stmtVerificaAdmin->bind_param("s", $emailAdmin);
$stmtVerificaAdmin->execute();
$resultadoAdmin = $stmtVerificaAdmin->get_result();

if ($resultadoAdmin->num_rows === 0) {
    // Insere o administrador no banco de dados
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sss", $nomeAdmin, $emailAdmin, $senhaHash);

    if ($stmt->execute()) {
        echo "Administrador cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar administrador: " . $stmt->error;
    }
}

// Processamento de Login
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['entrar'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta ao banco de dados para verificar o usuário
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        
        // Verifica se a senha fornecida corresponde ao hash armazenado
        if (password_verify($senha, $usuario['senha'])) {
            // Verifica se o usuário é o administrador
            if ($usuario['email'] == 'admin@loja.com') {
                // Cria a sessão do administrador
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['nome'] = $usuario['nome'];
                $_SESSION['email'] = $usuario['email'];

                // Redireciona para o painel administrativo após login bem-sucedido
                header("Location: painel_administrativo.php");
                exit();
            } else {
                // Redireciona para a página inicial após login bem-sucedido
                header("Location: loja.php");
                exit();
            }
        } else {
            $erroLogin = "Usuário ou senha incorretos!";
        }
    } else {
        $erroLogin = "Usuário não encontrado!";
    }
}

// Processamento de Cadastro
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senhaConfirmada = $_POST['senha_confirmada'];

    // Verifica se as senhas coincidem
    if ($senha === $senhaConfirmada) {
        // Verifica se o email já está cadastrado
        $sqlVerificaEmail = "SELECT * FROM usuarios WHERE email = ?";
        $stmtVerificaEmail = $conexao->prepare($sqlVerificaEmail);
        $stmtVerificaEmail->bind_param("s", $email);
        $stmtVerificaEmail->execute();
        $resultadoEmail = $stmtVerificaEmail->get_result();

        if ($resultadoEmail->num_rows > 0) {
            $erroCadastro = "Este e-mail já está cadastrado!";
        } else {
            // Gera o hash da senha antes de armazená-la
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            
            // Insere o novo usuário no banco de dados
            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("sss", $nome, $email, $senhaHash);

            if ($stmt->execute()) {
                // Redireciona para a página de login após o cadastro
                header("Location: index.php");
                exit();
            } else {
                $erroCadastro = "Erro ao cadastrar: " . $stmt->error;
            }
        }
    } else {
        $erroCadastro = "As senhas não coincidem!";
    }
}

// Fechar a conexão
$conexao->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja virtual</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- inicio do banner -->
    <div class="novoMenu">
        <div class="container">
            <div class="navegador">
                <div class="logo">
                    <img src="" alt="">
                </div>
                <nav>
                    <ul id="MenuItens">
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="produtos.php">Produtos</a></li>
                        <li><a href="">Empresa</a></li>
                        <li><a href="">Contatos</a></li>
                        <li><a href="index.php">Minha conta</a></li>
                    </ul>
                    <a href="carrinho.html" title="">
                        <img src="assets/img/carrinho2.png" alt="" width="30px" height="30px">
                    </a>
                </nav>
            </div>
        </div>
    </div>

    <!-- minha conta -->
    <div class="minha-conta">
        <div class="conteiner">
            <div class="linha">
                <div class="col-2">
                    <img src="assets/img/Inverso.png" width="100%">
                </div>

                <div class="col-2">
                    <div class="formulario">
                        <div class="bnt-form">
                            <samp onclick="mostrarEntrar()" id="btnEntrar" class="active">Entrar</samp>
                            <samp onclick="mostrarCadastro()" id="btnCadastro">Cadastro</samp>
                        </div>
                        <hr id="Indicador">

                        <!-- Formulário de Login -->
                        <form action="" method="post" id="EntrarPainel" class="active">
                            <input type="email" name="email" placeholder="E-mail de acesso" required>
                            <input type="password" name="senha" placeholder="Digite sua senha" required>
                            <button type="submit" name="entrar" class="btn">Entrar</button>
                            <a href="#">Esqueceu sua senha?</a>
                            <!-- Mensagem de erro de login, só aparece se o login falhar -->
                            <?php if ($erroLogin): ?>
                                <p style="color: red;"><?php echo $erroLogin; ?></p>
                            <?php endif; ?>
                        </form>

                        <!-- Formulário de Cadastro -->
                        <form action="" method="post" id="CadastroSite">
                            <input type="text" name="nome" placeholder="Nome completo" required>
                            <input type="email" name="email" placeholder="E-mail de acesso" required>
                            <input type="password" name="senha" placeholder="Digite sua senha" required>
                            <input type="password" name="senha_confirmada" placeholder="Confirme sua senha" required>
                            <button type="submit" name="cadastrar" class="btn">Cadastrar-se</button>
                            <!-- Mensagem de erro de cadastro, só aparece se houver erro -->
                            <?php if ($erroCadastro): ?>
                                <p style="color: red;"><?php echo $erroCadastro; ?></p>
                            <?php endif; ?>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rodapé -->
    <footer>
        <div class="rodape">
            <div class="conteiner">
                <div class="linha">
                    <div class="rodape-col-1">
                        <h3>Baixe o nosso APP</h3>
                        <p>Baixe nosso aplicativo nas melhores plataformas</p>
                        <div class="app-logo">
                            <img src="assets/img/google.png" alt="Google Play">
                            <img src="assets/img/apple.png" alt="App Store">
                        </div>
                    </div>
                    <div class="rodape-col-2">
                        <img src="assets/img/logo-2.png" alt="Logo">
                        <p>Lorem Ipsum is simply dummy text of the printing <br>and typesetting industry</p>
                    </div>

                    <div class="rodape-col-3">
                        <h3>Fale conosco</h3>
                        <p>+55 11 1234-5678</p>
                        <p>contato@empresa.com.br</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>

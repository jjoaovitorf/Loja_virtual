<?php
// Conexão com o banco de dados
$host = 'localhost';
$usuario = 'root'; // Substituir caso necessário
$senha = '';       // Substituir caso necessário
$banco = 'loja';
$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

// Exclusão de usuário
if (isset($_GET['excluir'])) {
    // Obtém o ID do usuário a ser excluído
    $idUsuario = $_GET['excluir'];

    // Valida se o ID é numérico
    if (is_numeric($idUsuario)) {
        // Prepara a consulta SQL para excluir o usuário
        $sqlExcluir = "DELETE FROM usuarios WHERE id = ?";
        $stmtExcluir = $conexao->prepare($sqlExcluir);

        if ($stmtExcluir === false) {
            die('Erro na preparação da consulta: ' . $conexao->error);
        }

        // Vincula o parâmetro ao SQL (ID do usuário)
        $stmtExcluir->bind_param("i", $idUsuario);

        // Executa a exclusão
        if ($stmtExcluir->execute()) {
            echo "<p style='color: green;'>Usuário excluído com sucesso!</p>";
        } else {
            echo "<p style='color: red;'>Erro ao excluir o usuário: " . $stmtExcluir->error . "</p>";
        }

        // Fecha a consulta
        $stmtExcluir->close();
    } else {
        echo "<p style='color: red;'>ID inválido!</p>";
    }
}

// Consulta para obter todos os usuários
$sql = "SELECT id, nome, email FROM usuarios";
$resultado = $conexao->query($sql);

if (!$resultado) {
    die("Erro na consulta: " . $conexao->error);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuários</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <!-- Menu do administrador -->
    <div class="novoMenu">
        <div class="container">
            <div class="navegador">
                <div class="logo"></div>
                <img src="assets/img/logo.png" alt="loja virtual" width="125px">
                <nav>
                    <ul id="MenuItens">
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="produtos.php">Produtos</a></li>
                        <li><a href="usuarios.php">Usuários</a></li>
                        <li><a href="logout.php">Sair</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Listagem de usuários -->
    <div class="usuarios-lista">
        <div class="container">
            <h2>Usuários Cadastrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($usuario = $resultado->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $usuario['id']; ?></td>
                            <td><?php echo $usuario['nome']; ?></td>
                            <td><?php echo $usuario['email']; ?></td>
                            <td>
                                <a href="painel_administrativo.php?excluir=<?php echo $usuario['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
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
                            <img src="assets/img/google.png" alt="">
                            <img src="assets/img/apple.png" alt="">
                        </div>
                    </div>
                    <div class="rodape-col-2">
                        <img src="assets/img/logo-2.png" alt="loja virtual">
                        <p>Lorem Ipsum is simply dummy text of the printing <br>and typesetting industry</p>
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
                    <div class="rodape-col-4">
                        <h3>Redes sociais</h3>
                        <ul>
                            <li>Facebook</li>
                            <li>Instagram</li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr>
            <div class="direitos">
                &#169; Todos os direitos reservados a msflix.com.br
            </div>
        </div>
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>

<?php
// Fechar a conexão
$conexao->close();
?>

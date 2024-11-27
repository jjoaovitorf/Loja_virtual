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
$sqlUsuarios = "SELECT id, nome, email FROM usuarios";
$resultadoUsuarios = $conexao->query($sqlUsuarios);
if (!$resultadoUsuarios) {
    die("Erro na consulta: " . $conexao->error);
}
// Consulta para obter todos os produtos
$sqlProdutos = "SELECT id, nome, quantidade FROM estoque";
$resultadoProdutos = $conexao->query($sqlProdutos);
if (!$resultadoProdutos) {
    die("Erro na consulta: " . $conexao->error);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/stylerodape.css">
    <link rel="stylesheet" href="assets/css/stylemenu.css">
    <style>
        /* Estilos gerais para o corpo da página */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        /* Container principal */
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        /* Cabeçalho */
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Listagem de usuários e produtos */
        .usuarios-lista, .produtos-lista, .adicionar-produto {
            margin-bottom: 40px;
        }

        /* Tabelas */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: black;
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }

        a {
            color: #d9534f;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            color: #c9302c;
        }

        /* Formulário */
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="number"] {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .container {
                width: 95%;
            }

            table {
                font-size: 14px;
            }

            form {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Menu do administrador -->
    <div class="novoMenu">
        <div class="container">
            <div class="navegador">
                <div class="logo"></div>
                <img src="assets/img/logoestilo.png" alt="loja virtual" width="125px">
                <nav>
                    <ul id="MenuItens">
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="index.php">Sair</a></li>
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
                    <?php while ($usuario = $resultadoUsuarios->fetch_assoc()) { ?>
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
    <!-- Listagem de produtos -->
    <div class="produtos-lista">
        <div class="container">
            <h2>Produtos no Estoque</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Quantidade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($produto = $resultadoProdutos->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $produto['id']; ?></td>
                            <td><?php echo $produto['nome']; ?></td>
                            <td><?php echo $produto['quantidade']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Formulário para adicionar um novo produto -->
    <div class="adicionar-produto">
        <div class="container">
            <h2>Adicionar Produto</h2>
            <form action="painel_administrativo.php" method="POST">
                <label for="nome">Nome do Produto:</label>
                <input type="text" name="nome" id="nome" required><br><br>
                <label for="quantidade">Quantidade:</label>
                <input type="number" name="quantidade" id="quantidade" required><br><br>
                <button type="submit" name="adicionarProduto">Adicionar Produto</button>
            </form>
        </div>
    </div>
    <?php
    // Adicionar um novo produto ao estoque
    if (isset($_POST['adicionarProduto'])) {
        $nome = $conexao->real_escape_string($_POST['nome']); // Protege contra SQL Injection
        $quantidade = (int) $_POST['quantidade']; // Garante que a quantidade seja um número inteiro

        // Verifica se a quantidade é válida
        if ($quantidade > 0) {
            // Prepara a consulta SQL para inserir um novo produto
            $sqlAdicionarProduto = "INSERT INTO estoque (nome, quantidade) VALUES (?, ?)";
            $stmtAdicionarProduto = $conexao->prepare($sqlAdicionarProduto);

            if ($stmtAdicionarProduto === false) {
                die('Erro na preparação da consulta: ' . $conexao->error);
            }

            // Vincula os parâmetros ao SQL
            $stmtAdicionarProduto->bind_param("si", $nome, $quantidade);

            // Executa a inserção
            if ($stmtAdicionarProduto->execute()) {
                echo "<p style='color: green;'>Produto adicionado com sucesso!</p>";
            } else {
                echo "<p style='color: red;'>Erro ao adicionar o produto: " . $stmtAdicionarProduto->error . "</p>";
            }

            // Fecha a consulta
            $stmtAdicionarProduto->close();
        } else {
            echo "<p style='color: red;'>Quantidade inválida! A quantidade deve ser maior que zero.</p>";
        }
    }
    ?>
</body>
</html>

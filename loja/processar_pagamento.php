<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Pedido</title>
    <style>
        /* Definindo as variáveis de cor para preto e cinza */
        :root {
            --cor-fonte: #555555; /* Cinza claro */
            --cor-btn-font: #000000; /* Preto */
        }

        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Definindo o fundo com gradiente radial */
        body {
            font-family: 'Arial', sans-serif;
            background: radial-gradient(circle, var(--cor-fonte) 30%, var(--cor-btn-font) 80%); /* Gradiente preto e cinza */
            color: #f1f1f1; /* Cor do texto para contraste */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Caixa de conteúdo */
        .container {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            text-align: center;
        }

        /* Títulos */
        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }

        /* Mensagens de sucesso */
        h1.success {
            color:#000000
        }

        h1.error {
            color: #dc3545;
        }

        /* Parágrafos */
        p {
            font-size: 16px;
            margin-bottom: 20px;
            color: #555;
        }

        /* Botões */
        button {
    
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
        

        button:hover {
            background-color: #444444; /* Cor mais clara de cinza para o hover */
        }

        /* Estilo do link (caso queira adicionar algo como voltar ao carrinho ou homepage) */
        a {
            color: var(--cor-btn-font);
            text-decoration: none;
            font-size: 16px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Mensagem de sucesso ou erro será exibida aqui -->
        <?php
            session_start();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $dados = ['nome', 'endereco', 'telefone', 'cartao', 'validade', 'cvv'];
                foreach ($dados as $campo) {
                    if (empty($_POST[$campo])) {
                        echo "<h1 class='error'>Erro no pagamento!</h1>";
                        echo "<p>Por favor, preencha todos os campos corretamente.</p>";
                        exit();
                    }
                }

                unset($_SESSION['carrinho']); // Limpa o carrinho
                echo "<h1 class='success'>Compra finalizada com sucesso!</h1>";
                echo "<p>Obrigado, {$_POST['nome']}! Seu pedido será enviado para {$_POST['endereco']}.</p>";
            } else {
                header('Location: pagamento.php');
                exit();
            }
        ?>
        <a href="loja.php">Voltar à página inicial</a>
    </div>
</body>
</html>

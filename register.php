<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Garante que o conteúdo centralize na tela */
        }

        .wrapper {
            width: 90%; /* Ajusta a largura para telas menores */
            max-width: 400px; /* Largura máxima para telas maiores */
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box; /* Garante que o padding não aumente a largura */
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        p {
            text-align: center;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .alert {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 4px;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <h2>Cadastro</h2>
    <p>Por favor, preencha este formulário para criar uma conta.</p>

    <?php
    session_start(); // Inicia a sessão para acessar as mensagens
    // Exibe mensagens de erro
    if (isset($_SESSION['error_messages']) && !empty($_SESSION['error_messages'])) {
        echo '<div class="alert alert-danger">';
        foreach ($_SESSION['error_messages'] as $error) {
            echo '<p>' . htmlspecialchars($error) . '</p>';
        }
        echo '</div>';
        unset($_SESSION['error_messages']); // Limpa as mensagens da sessão
    }

    // Exibe mensagem de sucesso (se houver)
    if (isset($_SESSION['success_message'])) {
        echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
        unset($_SESSION['success_message']); // Limpa a mensagem da sessão
    }
    ?>

    <form action="https://1952119tiao-valeoescrito.github.io/blockchain-bet-brasil/cadastro_usuarios.php" method="post">
        <div class="form-group">
            <label>Nome de usuário:</label>
            <input type="text" name="username" class="form-control">
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="text" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label>Telefone:</label>
            <input type="text" name="telefone" class="form-control">
        </div>
        <div class="form-group">
            <label>Senha:</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
            <label>Confirme a senha:</label>
            <input type="password" name="confirm_password" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Criar Conta">
            <input type="reset" class="btn btn-secondary ml-2" value="Apagar Dados">
        </div>
        <p>Já tem uma conta? <a href="login.php">Entre aqui</a>.</p>
    </form>
</div>

</body>
</html>
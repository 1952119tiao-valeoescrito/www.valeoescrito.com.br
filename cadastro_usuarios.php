<?php
// Inicializa a sessão para mensagens de feedback
session_start();

// Função para limpar e validar dados de entrada
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Inclui o arquivo de configuração do banco de dados
    require_once 'config.php';  // Ajuste o caminho se necessário

    // Coleta e limpa os dados do formulário
    $username = clean_input($_POST["username"]);
    $email = clean_input($_POST["email"]);
    $telefone = clean_input($_POST["telefone"]);
    $password = $_POST["password"]; // Não limpe a senha aqui
    $confirm_password = $_POST["confirm_password"]; // Não limpe a confirmação

    // Validação dos campos
    $erros = array();

    if (empty($username)) {
        $erros[] = "O nome de usuário é obrigatório.";
    }
    if (empty($email)) {
        $erros[] = "O email é obrigatório.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "O email é inválido.";
    }
    if (empty($telefone)) {
        $erros[] = "O telefone é obrigatório.";
    }
    if (empty($password)) {
        $erros[] = "A senha é obrigatória.";
    }
    if (strlen($password) < 6) {
        $erros[] = "A senha deve ter pelo menos 6 caracteres.";
    }
    if ($password != $confirm_password) {
        $erros[] = "As senhas não coincidem.";
    }

    // Se não houver erros, procede com o cadastro
    if (empty($erros)) {

        // Hash da senha para segurança
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Preparação da query para evitar SQL injection
        $sql = "INSERT INTO usuarios (username, email, telefone, password) VALUES (?, ?, ?, ?)";

        if($stmt = $mysqli->prepare($sql)){
            // Bind dos parâmetros
            $stmt->bind_param("ssss", $username, $email, $telefone, $hashed_password);

            // Executa a query
            if($stmt->execute()){
                // Redireciona para a página de login com mensagem de sucesso
                $_SESSION['success_message'] = "Cadastro realizado com sucesso! Faça login.";
                header("location: login.php");
                exit();
            } else {
                $_SESSION['error_message'] = "Erro ao cadastrar o usuário. Tente novamente mais tarde.";
            }

            // Fecha a declaração
            $stmt->close();
        } else {
            $_SESSION['error_message'] = "Erro na preparação da query. Contacte o administrador.";
        }

        // Fecha a conexão
        $mysqli->close();
    } else {
        // Armazena os erros na sessão
        $_SESSION['error_messages'] = $erros;
    }

    // Redireciona de volta para a página de cadastro para exibir os erros
    header("location: register.php"); // Certifique-se de que register.php é o nome correto da sua página de cadastro
    exit();
}
?>
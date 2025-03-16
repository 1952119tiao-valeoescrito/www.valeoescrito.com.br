<center><br><br><br><br><br>
<?php
// Inicialize a sessÃ£o
session_start();

// Verifique se o usuÃ¡rio jÃ¡ estÃ¡ logado, em caso afirmativo, redirecione-o para a pÃ¡gina de boas-vindas
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}

// Incluir arquivo de configuraÃ§Ã£o
require_once "config.php";

// Defina variÃ¡veis e inicialize com valores vazios
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processando dados do formulÃ¡rio quando o formulÃ¡rio Ã© enviado
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Verifique se o nome de usuÃ¡rio estÃ¡ vazio
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor, insira o nome de usuÃ¡rio.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Verifique se a senha estÃ¡ vazia
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor, insira sua senha.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validar credenciais
    if(empty($username_err) && empty($password_err)){
        // Prepare uma declaraÃ§Ã£o selecionada
        $sql = "SELECT id, username, password FROM users WHERE username = :username";

        if($stmt = $pdo->prepare($sql)){
            // Vincule as variÃ¡veis Ã  instruÃ§Ã£o preparada como parÃ¢metros
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Definir parÃ¢metros
            $param_username = trim($_POST["username"]);

            // Tente executar a declaraÃ§Ã£o preparada
            if($stmt->execute()){
                // Verifique se o nome de usuÃ¡rio existe, se sim, verifique a senha
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){
                            // A senha estÃ¡ correta, entÃ£o inicie uma nova sessÃ£o
                            session_start();

                            // Armazene dados em variÃ¡veis de sessÃ£o
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirecionar o usuÃ¡rio para a pÃ¡gina de boas-vindas
                            header("location: welcome.php");
                        } else{
                            // A senha nÃ£o Ã© vÃ¡lida, exibe uma mensagem de erro genÃ©rica
                            $login_err = "Nome de usuÃ¡rio ou senha invÃ¡lidos.";
                        }
                    }
                } else{
                    // O nome de usuÃ¡rio nÃ£o existe, exibe uma mensagem de erro genÃ©rica
                    $login_err = "Nome de usuÃ¡rio ou senha invÃ¡lidos.";
                }
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
            // Fechar declaraÃ§Ã£o
            unset($stmt);
        }
    }

    // Fechar conexÃ£o
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper"><p align="center">
        <h2>Login</h2>
        <p>Por favor, preencha os campos para fazer o login.</p>
        <?php
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Nome do usuÃ¡rio</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Entrar">
            </div>
            <p>NÃ£o tem uma conta? <a href="https://1952119tiao-valeoescrito.github.io/blockchain-bet-brasil/register.php">Inscreva-se agora</a>.</p>
        </form>
    </div>
</body>
</html>
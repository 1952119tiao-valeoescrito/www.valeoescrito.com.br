<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Aposta - Vale o Escrito</title>

    <!-- Estilos CSS (Responsivo) -->
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            width: 90%; /* Ajuste para telas menores */
            max-width: 960px; /* Largura máxima para telas maiores */
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        /* Estilos para telas menores */
        @media (max-width: 600px) {
            th, td {
                display: block;
                width: 100%;
                text-align: left;
                box-sizing: border-box; /* Impede que o preenchimento aumente a largura */
            }

            th {
                background-color: #ddd;
            }
        }

        /* Cores e Estilos Específicos */
        .highlight {
            color: #ff0000;
        }

        .sub-highlight {
            color: #4b0082;
        }

        .gray-text {
            color: rgb(169, 169, 169);
        }

        .blue-link {
            color: #0000cd;
        }

        .dark-gray-text {
            color: #808080;
        }
        .success-message {
            color: green;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .error-message {
            color: red;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

    </style>
</head>
<body>

<div class="container">

<?php

// Função para limpar e validar dados de entrada
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Conexão com o banco de dados
$servername = "mysql48-farm1.kinghost.net";
$username = "valeoescrito";
$password = "Kmvd96uJ";
$database = "valeoescrito";

$conexao = new mysqli($servername, $username, $password, $database);

// Verifica a conexão
if ($conexao->connect_error) {
    die("<div class='error-message'>Falha na conexão com o banco de dados: " . $conexao->connect_error . "</div>");
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Coleta e valida os dados do formulário
    $num_extracao = clean_input($_POST["num_extracao"]);
    $data_extracao = clean_input($_POST["data_extracao"]);
    $num_token = clean_input($_POST["num_token"]);
    $country_pais = clean_input($_POST["country_pais"]);
    $email_indicador = clean_input($_POST["email_indicador"]);
    $email_investidor = clean_input($_POST["email_investidor"]);
    $telefone = clean_input($_POST["telefone"]);
    $pri_premio = clean_input($_POST["pri_premio"]);
    $seg_premio = clean_input($_POST["seg_premio"]);
    $ter_premio = clean_input($_POST["ter_premio"]);
    $qua_premio = clean_input($_POST["qua_premio"]);
    $qui_premio = clean_input($_POST["qui_premio"]);

    // Validação dos campos (mais robusta)
    $erros = array();

    if (empty($num_extracao)) {
        $erros[] = "O campo 'Número da Extração' é obrigatório.";
    }
    if (empty($data_extracao)) {
        $erros[] = "O campo 'Data da Extração' é obrigatório.";
    }
    if (empty($num_token)) {
        $erros[] = "O campo 'Número do Token' é obrigatório.";
    }
    if (empty($country_pais)) {
        $erros[] = "O campo 'País' é obrigatório.";
    }
    if (empty($email_indicador)) {
        $erros[] = "O campo 'E-mail do Indicador' é obrigatório.";
    } elseif (!filter_var($email_indicador, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "O 'E-mail do Indicador' é inválido.";
    }
    if (empty($email_investidor)) {
        $erros[] = "O campo 'Seu E-mail' é obrigatório.";
    } elseif (!filter_var($email_investidor, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "O 'Seu E-mail' é inválido.";
    }
    if (empty($telefone)) {
        $erros[] = "O campo 'Telefone' é obrigatório.";
    }
    if (empty($pri_premio)) {
        $erros[] = "O campo '1º Prêmio' é obrigatório.";
    }
    if (empty($seg_premio)) {
        $erros[] = "O campo '2º Prêmio' é obrigatório.";
    }
    if (empty($ter_premio)) {
        $erros[] = "O campo '3º Prêmio' é obrigatório.";
    }
    if (empty($qua_premio)) {
        $erros[] = "O campo '4º Prêmio' é obrigatório.";
    }
    if (empty($qui_premio)) {
        $erros[] = "O campo '5º Prêmio' é obrigatório.";
    }

    // Exibe os erros, se houver
    if (!empty($erros)) {
        echo "<div class='error-message'>Por favor, corrija os seguintes erros:<ul>";
        foreach ($erros as $erro) {
            echo "<li>" . $erro . "</li>";
        }
        echo "</ul></div>";
    } else {
        // Preparação da query (prevenção contra SQL injection)
        $stmt = $conexao->prepare("INSERT INTO apostar (num_extracao, data_extracao, num_token, country_pais, email_indicador, email_investidor, telefone, pri_premio, seg_premio, ter_premio, qua_premio, qui_premio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Vincula os parâmetros
        $stmt->bind_param("ssssssssssss", $num_extracao, $data_extracao, $num_token, $country_pais, $email_indicador, $email_investidor, $telefone, $pri_premio, $seg_premio, $ter_premio, $qua_premio, $qui_premio);

        // Executa a query
        if ($stmt->execute()) {
            echo "<div class='success-message'>BET BRASIL - VALE O ESCRITO.<br>Seu registro foi realizado com sucesso.<br>Obrigado por confiar em nosso empreendimento!!!</div>";
        } else {
            echo "<div class='error-message'>Erro ao inserir no banco de dados: " . $stmt->error . "</div>";
        }

        // Fecha a declaração
        $stmt->close();

        // Exibe os dados inseridos
        echo '
            <img src="https://www.valeoescrito.com.br/OIG1.jpeg" alt="Vale o Escrito Logo">
            <h2 style="text-align: center"><span class="highlight">FAZENDO A DIFERENÇA, AJUDANDO AS PESSOAS.</span></h2>
            <p style="text-align: center"><span class="sub-highlight">CONTEMPLAMOS VOCÊ COM 5, 4, 3, 2 E ATÉ COM 1 PONTO APENAS.</span></p>
            <h3 style="text-align: center"><span class="highlight">SORTEIOS PELA LOTERIA FEDERAL</span></h3>
            <p style="text-align: center">
                <strong>Extração nº: ' . htmlspecialchars($num_extracao) . ' ***** Corre dia: ' . htmlspecialchars($data_extracao) . '</strong>
            </p>
            <p style="text-align: center"><strong>Token nº: ' . htmlspecialchars($num_token) . ' ***** País: ' . htmlspecialchars($country_pais) . '</strong></p>
            <p style="text-align: center"><strong class="gray-text">E-mail indicador: <a href="mailto:' . htmlspecialchars($email_indicador) . '" class="gray-text">' . htmlspecialchars($email_indicador) . '</a></strong></p>
            <p style="text-align: center"><strong class="gray-text">Seu e-mail: <a href="mailto:' . htmlspecialchars($email_investidor) . '" class="gray-text">' . htmlspecialchars($email_investidor) . '</a></strong></p>
            <p style="text-align: center"><strong class="gray-text">Seu telefone: <span class="gray-text">' . htmlspecialchars($telefone) . '</span></strong></p>

            <table>
                <thead>
                    <tr>
                        <th colspan="6"><span style="color: #000080"><strong>VALE O ESCRITO</strong></span></th>
                    </tr>
                    <tr>
                        <th><span class="highlight">Colocação:</span></th>
                        <th><span class="highlight">1º Prêmio:</span></th>
                        <th><span class="highlight">2º Prêmio:</span></th>
                        <th><span class="highlight">3º Prêmio:</span></th>
                        <th><span class="highlight">4º Prêmio:</span></th>
                        <th><span class="highlight">5º Prêmio:</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span style="color: #000080"><strong>Prognósticos:</strong></span></td>
                        <td><span style="color: #000080"><strong>' . htmlspecialchars($pri_premio) . '</strong></span></td>
                        <td><span style="color: #000080"><strong>' . htmlspecialchars($seg_premio) . '</strong></span></td>
                        <td><span style="color: #000080"><strong>' . htmlspecialchars($ter_premio) . '</strong></span></td>
                        <td><span style="color: #000080"><strong>' . htmlspecialchars($qua_premio) . '</strong></span></td>
                        <td><span style="color: #000080"><strong>' . htmlspecialchars($qui_premio) . '</strong></span></td>
                    </tr>
                    <tr>
                        <td colspan="6"><span class="highlight"><strong>APOSTA REGISTRADA EM BANCO DE DADOS.</strong></span></td>
                    </tr>
                </tbody>
            </table>

            <table style="width:100%;">
                <tr>
                    <td style="width:50%; text-align:center; vertical-align:top;">
                        <p class="dark-gray-text"><strong>PAGAMENTO VIA PIX.</strong></p>
                        <p class="dark-gray-text">Escaneie o QR Code dentro do aplicativo do seu banco.</p>
                        <img src="img_valeoescrito_serie-intermediaria.png" alt="QR Code PIX" style="width: auto; max-width: 200px;">
                    </td>
                    <td style="width:50%; text-align:center; vertical-align:top;">
                        <p class="dark-gray-text"><strong>ACEITAMOS PAGAMENTO COM CRIPTOMOEDAS.</strong></p>
                        <p class="dark-gray-text"><strong>PAGUE 0,00033 ETH.</strong></p>
                        <p class="dark-gray-text"><strong>DEPÓSITO NA CARTEIRA 0x9D586CbA6c856B4979C1D2e5115ecdBAc85184E8.</strong></p>
                        <p class="dark-gray-text"><strong>CONHEÇA-NOS MELHOR</strong></p>
                        <p><a href="https://www.valeoescrito.com.br" class="blue-link"><strong>VALE O ESCRITO</strong></a></p>
                        <p class="dark-gray-text"><strong>COMO FAZER / SABER PARA RECEBER O PRÊMIO? <br>ENTRAREMOS EM CONTATO COM VOCÊ!</strong></p>
                        <p class="dark-gray-text"><strong>FIQUE TRANQUILO.</strong></p>
                        <img src="estamos-juntos.jpg" alt="Estamos Juntos" style="width: auto; max-width: 86px;">
                    </td>
                </tr>
            </table>

            <p style="text-align: center">
                <span class="dark-gray-text">Dúvidas? Envie um e-mail para <a href="mailto:suporte@valeoescrito.com.br" class="blue-link">suporte@valeoescrito.com.br</a> - WhatsApp: <a href="https://api.whatsapp.com/send?phone=5521993527957" target="_blank" class="blue-link">+55 (21) 99352-7957</a>.</span>
            </p>

            <p style="text-align: center">
                <span style="color: #000080">"Entrega o teu caminho ao Senhor, confia Nele, e o mais Ele fará" (Salmos 37:5)</span>
            </p>
        ';

    }
}

// Fecha a conexão
$conexao->close();

?>

</div> <!-- Fim do container -->

</body>
</html>
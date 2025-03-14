<?php
session_start();

// Gera um número de aposta único se ainda não existir na sessão
if (!isset($_SESSION['numero_aposta'])) {
    $_SESSION['numero_aposta'] = uniqid(); // Usamos uniqid() para gerar um ID único
}

// Recupera o número da aposta da sessão
$numero_aposta = $_SESSION['numero_aposta'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Apostas</title>
    <style>
        /* Estilos inline do seu modelo + ajustes */
        body { font-family: Arial, sans-serif; }
        .formulario {
            font-size: 12px;
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #fff;
        }
        .formulario p {
            font-size: 12px;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .formulario table {
            width: 100%; /* Ajustei para ocupar a largura total */
            max-width: 600px; /* Largura máxima para não esticar demais em telas grandes */
            margin: 0 auto; /* Centralizar a tabela */
            border-collapse: collapse;
        }
        .formulario input[type="text"],
        .formulario input[type="email"],
        .formulario select {
            width: calc(100% - 20px); /* Ajustar a largura dos campos */
            padding: 10px;
            margin: 0; /* Removido o margin para melhor controle */
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; /* Garante que o padding não aumenta a largura total */
            font-family: inherit;
            font-size: inherit;
            height: auto; /* Resetando a altura fixa para auto */
        }

        .formulario select {
            height: auto; /* Resetando a altura fixa para auto */
        }

        .formulario input[type="submit"],
        .formulario input[type="reset"] {
            cursor: pointer;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            font-family: inherit;
            font-size: inherit;
            appearance: button;
            background-color: #eee; /* Cor de fundo suave */
        }
        /* Estilos para os campos de pagamento (inicialmente escondidos) */
        .payment-options {
            margin-top: 20px;
            text-align: center;
        }
        .payment-options button {
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            margin: 0 10px;
        }
        .payment-details {
            display: none; /* Inicialmente escondido */
            margin-top: 10px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: left;
        }

        .payment-details.active {
            display: block; /* Mostra quando ativo */
        }

        /* Estilos para a divisão uniforme */
        .colocacao-table {
            width: 100%;
        }
        .colocacao-table td {
            width: 16.66%; /* 100% / 6 colunas (colocação + 5 prêmios) */
            padding: 5px;
            text-align: center;
        }

        /* Estendendo os campos de email e telefone */
        .full-width-input {
            width: calc(100% - 20px); /* Ocupar todo o espaço disponível */
            box-sizing: border-box; /* Incluir padding e borda na largura */
        }

        /* Centralizar a tabela de prognósticos */
        .prognosticos-container {
            text-align: center; /* Centraliza horizontalmente */
            margin-top: 10px; /* Adiciona um espaço acima da tabela */
        }

        /* Centraliza os botões submeter/redefinir */
        .button-container {
            text-align: center;
            margin-top: 10px;
        }
      /* Centraliza o texto "Prognósticos" à esquerda */
        .colocacao-table tr:last-child td:first-child {
            text-align: center; /* Centraliza o texto */
        }
         /* Centraliza o gerador de números aleatórios */
        .gerador-container {
            text-align: center;
            margin-top: 10px; /* Adiciona um espaço acima do gerador */
        }
          /* Estilo para o texto abaixo do gerador */
        .gerador-texto {
            font-size: 12px;
            font-family: Arial, sans-serif;
            text-align: center;
            color: #000; /* Cor do texto */
            margin-top: 5px; /* Espaço acima do texto */
        }
         /* Estilo para o número da aposta */
        .numero-aposta {
            font-size: 14px;
            font-family: Arial, sans-serif;
            text-align: center;
            margin-bottom: 10px;
            font-weight: bold;
        }
        @media (max-width: 600px) {
            .formulario table {
                width: 95%; /* Ocupar quase toda a largura em telas menores */
            }
        }
    </style>
</head>
<body>

<form action="https://www.valeoescrito.com.br/apostar.php" class="formulario" method="post">
     <!-- Exibe o Número da Aposta -->
    <p class="numero-aposta">Número da Aposta: <?php echo htmlspecialchars($numero_aposta); ?></p>

    <p><span style="color: rgb(255,0,0)"><strong><span>GANHA COM 5, 4, 3, 2 E ATÉ COM 1 PONTO APENAS - SORTEIOS PELA LOTERIA FEDERAL.</span></strong></span></p>

    <table align="center" border="0" cellpadding="1" cellspacing="1">
        <tbody>
            <tr>
                <td colspan="2"> </td>
                <td colspan="11">Preencha os dados sugeridos no formulário abaixo:</td>
            </tr>
            <tr>
                <td colspan="2">Concurso nº:</td>
                <td colspan="2"><input type="text" id="num" name="num_extracao" size="1" /></td>
                <td>Data:</td>
                <td colspan="8"><input type="text" id="data" name="data_extracao" size="1" value="2025-02-01" /></td>
            </tr>
            <tr>
                <td>  País:</td>
                <td colspan="8">
                    <select id="country" name="country_pais" size="1">
                        <option value="BZ" selected>Select a country/Selecione um país</option>
                        <option value="AL">Albania</option>
                        <option value="DE">Alemania</option>
                        <option value="AD">Andorra</option>
                        <option value="AO">Angola</option>
                        <option value="AI">Anguila</option>
                        <option value="AG">Antigua y Barbuda</option>
                        <option value="AN">Antillas Holandesas</option>
                        <option value="SA">Arabia Saudí</option>
                        <option value="DZ">Argelia</option>
                        <option value="AR">Argentina</option>
                        <option value="AM">Armenia</option>
                        <option value="AW">Aruba</option>
                        <option value="AU">Australia</option>
                        <option value="AT">Austria</option>
                        <option value="BS">Bahamas</option>
                        <option value="BH">Bahréin</option>
                        <option value="BB">Barbados</option>
                        <option value="BE">Bélgica</option>
                        <option value="BE">Belice</option>
                        <option value="BJ">Benín</option>
                        <option value="BM">Bermudas</option>
                        <option value="BT">Bután</option>
                        <option value="BO">Bolivia</option>
                        <option value="BA">Bosnia y Herzegovina</option>
                        <option value="BW">Botsuana</option>
                        <option value="BR">Brasil</option>
                        <option value="BN">Brunéi</option>
                        <option value="BG">Bulgaria</option>
                        <option value="BF">Burkina Faso</option>
                        <option value="BI">Burundi</option>
                        <option value="CV">Cabo Verde</option>
                        <option value="KH">Camboya</option>
                        <option value="CA">Canadá</option>
                        <option value="TD">Chad</option>
                        <option value="CL">Chile</option>
                        <option value="C2">China Internacional</option>
                        <option value="CY">Chipre</option>
                        <option value="VA">Ciudad del Vaticano</option>
                        <option value="CO">Colombia</option>
                        <option value="KM">Comoras</option>
                        <option value="KR">Corea del Sur</option>
                        <option value="CR">Costa Rica</option>
                        <option value="HR">Croacia</option>
                        <option value="DK">Dinamarca</option>
                        <option value="DM">Dominica</option>
                        <option value="EC">Ecuador</option>
                        <option value="SV">El Salvador</option>
                        <option value="AE">Emiratos Árabes Unidos</option>
                        <option value="ER">Eritrea</option>
                        <option value="SK">Eslovaquia</option>
                        <option value="SI">Eslovenia</option>
                        <option value="ES">España</option>
                        <option value="FM">Estados Federados de Micronesia</option>
                        <option value="US">Estados Unidos</option>
                        <option value="EE">Estonia</option>
                        <option value="ET">Etiopía</option>
                        <option value="PH">Filipinas</option>
                        <option value="FI">Finlandia</option>
                        <option value="FJ">Fiyi</option>
                        <option value="FR">Francia</option>
                        <option value="GM">Gambia</option>
                        <option value="GI">Gibraltar</option>
                        <option value="GD">Granada</option>
                        <option value="GR">Grecia</option>
                        <option value="GL">Groenlandia</option>
                        <option value="GP">Guadalupe</option>
                        <option value="GT">Guatemala</option>
                        <option value="GF">Guayana Francesa</option>
                        <option value="GN">Guinea</option>
                        <option value="GW">Guinea- Bissau</option>
                        <option value="GY">Guyana</option>
                        <option value="HN">Honduras</option>
                        <option value="HK">Hong Kong</option>
                        <option value="HU">Hungría</option>
                        <option value="IN">India</option>
                        <option value="ID">Indonesia</option>
                        <option value="IE">Irlanda</option>
                        <option value="NF">Isla Norfolk</option>
                        <option value="IS">Islandia</option>
                        <option value="CK">Islas Caimán</option>
                        <option value="CK">Islas Cook</option>
                        <option value="FO">Islas Feroe</option>
                        <option value="FK">Islas Malvinas</option>
                        <option value="MH">Islas Marshall</option>
                        <option value="PN">Islas Pitcairn</option>
                        <option value="SB">Islas Salomón</option>
                        <option value="TC">Islas Turcas y Caicos</option>
                        <option value="VG">Islas Vírgenes Británicas</option>
                        <option value="IL">Israel</option>
                        <option value="IT">Italia</option>
                        <option value="JM">Jamaica</option>
                        <option value="JP">Japón</option>
                        <option value="JO">Jordania</option>
                        <option value="KZ">Kazajstán</option>
                        <option value="KE">Kenia</option>
                        <option value="KG">Kirguistán</option>
                        <option value="KI">Kiribati</option>
                        <option value="KW">Kuwait</option>
                        <option value="LA">Laos</option>
                        <option value="LS">Lesotho</option>
                        <option value="LV">Letonia</option>
                        <option value="LI">Liechtenstein</option>
                        <option value="LT">Lituania</option>
                        <option value="LU">Luxemburgo</option>
                        <option value="MG">Madagascar</option>
                        <option value="MY">Malasia</option>
                        <option value="MW">Malawi</option>
                        <option value="MV">Maldivas</option>
                        <option value="ML">Malí</option>
                        <option value="MT">Malta</option>
                        <option value="MA">Marruecos</option>
                        <option value="MQ">Martinica</option>
                        <option value="MU">Mauricio</option>
                        <option value="MR">Mauritania</option>
                        <option value="YT">Mayotte</option>
                        <option value="MX">México</option>
                        <option value="MN">Mongolia</option>
                        <option value="MS">Montserrat</option>
                        <option value="MZ">Mozambique</option>
                        <option value="NA">Namibia</option>
                        <option value="NR">Nauru</option>
                        <option value="NP">Nepal</option>
                        <option value="NI">Nicaragua</option>
                        <option value="NE">Níger</option>
                        <option value="NU">Niue</option>
                        <option value="NO">Noruega</option>
                        <option value="NC">Nueva Caledonia</option>
                        <option value="NZ">Nueva Zelanda</option>
                        <option value="OM">Omán</option>
                        <option value="NL">Países Bajos</option>
                        <option value="PW">Palaos</option>
                        <option value="PA">Panamá</option>
                        <option value="PG">Papúa Nueva Guinea</option>
                        <option value="PE">Perú</option>
                        <option value="PF">Polinesia Francesa</option>
                        <option value="PL">Polonia</option>
                        <option value="PT">Portugal</option>
                        <option value="QA">Qatar</option>
                        <option value="GB">Reino Unido</option>
                        <option value="CZ">República Checa</option>
                        <option value="AZ">República de Azerbaiyán</option>
                        <option value="GA">República de Gabón</option>
                        <option value="CG">República del Congo</option>
                        <option value="CD">República Democrática del Congo</option>
                        <option value="DO">República Dominicana</option>
                        <option value="RE">Reunión</option>
                        <option value="RW">Ruanda</option>
                        <option value="RO">Rumanía</option>
                        <option value="RU">Rusia</option>
                        <option value="WS">Samoa</option>
                        <option value="KN">San Cristóbal y Nieves</option>
                        <option value="SM">San Marino</option>
                        <option value="PM">San Pedro y Miquelón</option>
                        <option value="VC">San Vicente y las Granadinas</option>
                        <option value="SH">Santa Elena</option>
                        <option value="LC">Santa Lucía</option>
                        <option value="ST">Santo Tomé y Príncipe</option>
                        <option value="SN">Senegal</option>
                        <option value="SC">Seychelles</option>
                        <option value="SL">Sierra Leona</option>
                        <option value="SG">Singapur</option>
                        <option value="SO">Somalia</option>
                        <option value="LK">Sri Lanka</option>
                        <option value="SZ">Suazilandia</option>
                        <option value="ZA">Sudáfrica</option>
                        <option value="SE">Suecia</option>
                        <option value="CH">Suiza</option>
                        <option value="SR">Surinam</option>
                        <option value="SJ">Svalbard y Jan Mayen</option>
                        <option value="TH">Tailandia</option>
                        <option value="TW">Taiwán</option>
                        <option value="TZ">Tanzania</option>
                        <option value="TJ">Tayikistán</option>
                        <option value="TG">Togo</option>
                        <option value="TO">Tonga</option>
                        <option value="TT">Trinidad y Tobago</option>
                        <option value="TN">Túnez</option>
                        <option value="TM">Turkmenistán</option>
                        <option value="TR">Turquía</option>
                        <option value="TV">Tuvalu</option>
                        <option value="UA">Ucrania</option>
                        <option value="UG">Uganda</option>
                        <option value="UY">Uruguay</option>
                        <option value="VU">Vanuatu</option>
                        <option value="VE">Venezuela</option>
                        <option value="VN">Vietnam</option>
                        <option value="WF">Wallis y Futuna</option>
                        <option value="YE">Yemen</option>
                        <option value="DJ">Yibuti</option>
                        <option value="ZM">Zambia</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">Seu e-mail:</td>
                <td colspan="11"><input type="email" id="email" name="email_indicador" class="full-width-input" size="1" /></td>
            </tr>
            <tr>
                <td colspan="2">Seu indicado:</td>
                <td colspan="11"><input type="email" id="email" name="email_investidor" class="full-width-input" size="1" /></td>
            </tr>
            <tr>
                <td colspan="2"> Telefone: </td>
                <td colspan="11"><input type="text" id="telefone" name="telefone" class="full-width-input" size="1" /></td>
            </tr>

            <!-- Botões Submeter/Redefinir -->
            <tr>
                <td colspan="13" class="button-container">
                    <input type="submit" id="Enviar" name="Enviar" size="1" value="Submeter" />
                    <input type="reset" name="B3" size="1" value="Redefinir" />
                </td>
            </tr>

            <!-- Gerador de Números Aleatórios (Movido para Dentro da Tabela) -->
            <tr>
                <td colspan="13" class="gerador-container">
                    <form action="gerador.php" method="post">
                        <span style="color: #ffffff">
                            <span style="color: #ffffff">
                                <!-- Script do gerador de números aleatórios -->
                                 <script type="text/javascript">
            // <![CDATA[
            // Unique Random Numbers Picker
            // -Picks a number of unique random numbers from an array
            // © 2002 Premshree Pillai
            // http://www.qiksearch.com, http://javascript.qik.cjb.net
            // E-mail : qiksearch@rediffmail.com

            var numArr = new Array("1/1","1/2","1/3","1/4","1/5","1/6","1/7","1/8","1/9","1/10","10/11","10/12","10/13","10/14","10/15","10/16","10/17","10/18","10/19","10/20","10/21","10/22","10/23","10/24","10/25"
            ,"2/1","2/2","2/3","2/4","2/5","2/6","2/7","2/8","2/9","2/10","11/11","11/12","11/13","11/14","11/15","11/16","11/17","11/18","11/19","11/20","11/21","11/22","11/23","11/24","11/25"
            ,"3/1","3/2","3/3","3/4","3/5","3/6","3/7","3/8","3/9","3/10","12/11","12/12","12/13","12/14","12/15","12/16","12/17","12/18","12/19","12/20","12/21","12/22","12/23","12/24","12/25"
            ,"4/1","4/2","4/3","4/4","4/5","4/6","4/7","4/8","4/9","4/10","13/11","13/12","13/13","13/14","13/15","13/16","13/17","13/18","13/19","13/20","13/21","13/22","13/23","13/24","13/25"
            ,"5/1","5/2","5/3","5/4","5/5","5/6","5/7","5/8","5/9","5/10","14/11","14/12","14/13","14/14","14/15","14/16","14/17","14/18","14/19","14/20","14/21","14/22","14/23","14/24","14/25"
            ,"6/1","6/2","6/3","6/4","6/5","6/6","6/7","6/8","6/9","6/10","15/11","15/12","15/13","15/14","15/15","15/16","15/17","15/18","15/19","15/20","15/21","15/22","15/23","15/24","15/25"
            ,"7/1","7/2","7/3","7/4","7/5","7/6","7/7","7/8","7/9","7/10","16/11","16/12","16/13","16/14","16/15","16/16","16/17","16/18","16/19","16/20","16/21","16/22","16/23","16/24","16/25"
            ,"8/1","8/2","8/3","8/4","8/5","8/6","8/7","8/8","8/9","8/10","17/11","17/12","17/13","17/14","17/15","17/16","17/17","17/18","17/19","17/20","17/21","17/22","17/23","17/24","17/25"
            ,"9/1","9/2","9/3","9/4","9/5","9/6","9/7","9/8","9/9","9/10","18/11","18/12","18/13","18/14","18/15","18/16","18/17","18/18","18/19","18/20","18/21","18/22","18/23","18/24","18/25"
            ,"10/1","10/2","10/3","10/4","10/5","10/6","10/7","10/8","10/9","10/10","19/11","19/12","19/13","19/14","19/15","19/16","19/17","19/18","2/19","19/20","19/21","19/22","19/23","19/24","19/25"
            ,"11/1","11/2","11/3","11/4","11/5","11/6","11/7","11/8","11/9","11/10","20/11","20/12","20/13","20/14","20/15","20/16","20/17","20/18","20/19","20/20","20/21","20/22","20/23","20/24","20/25"
            ,"12/1","12/2","12/3","12/4","12/5","12/6","12/7","12/8","12/9","12/10","21/11","21/12","21/13","21/14","21/15","21/16","21/17","21/18","21/19","21/20","21/21","21/22","21/23","21/24","21/25"
            ,"13/1","13/2","13/3","13/4","13/5","13/6","13/7","13/8","13/9","13/10","22/11","22/12","22/13","22/14","22/15","22/16","22/17","22/18","22/19","22/20","22/21","22/22","22/23","22/24","22/25"
            ,"14/1","14/2","14/3","14/4","14/5","14/6","14/7","14/8","14/9","14/10","23/11","23/12","23/13","23/14","23/15","23/16","23/17","23/18","23/19","23/20","23/21","23/22","23/23","23/24","23/25"
            ,"15/1","15/2","15/3","15/4","15/5","15/6","15/7","15/8","15/9","15/10","24/11","24/12","24/13","24/14","24/15","24/16","24/17","24/18","24/19","24/20","24/21","24/22","24/23","24/24","24/25"
            ,"16/1","16/2","16/3","16/4","16/5","16/6","16/7","16/8","16/9","16/10","25/11","25/12","25/13","25/14","25/15","25/16","25/17","25/18","25/19","25/20","25/21","25/22","25/23","25/24","25/25"
            ,"17/1","17/2","17/3","17/4","17/5","17/6","17/7","17/8","17/9","17/10","1/11","1/12","1/13","1/14","1/15","1/16","1/17","1/18","1/19","1/20","1/21","1/22","1/23","1/24","1/25"
            ,"18/1","18/2","18/3","18/4","18/5","18/6","18/7","18/8","18/9","18/10","2/11","2/12","2/13","2/14","2/15","2/16","2/17","2/18","2/19","2/20","2/21","2/22","2/23","2/24","2/25"
            ,"19/1","19/2","19/3","19/4","19/5","19/6","19/7","19/8","19/9","19/10","3/11","3/12","3/13","3/14","3/15","3/16","3/17","3/18","3/19","3/20","3/21","3/22","3/23","3/24","3/25"
            ,"20/1","20/2","20/3","20/4","20/5","20/6","20/7","20/8","20/9","20/10","4/11","4/12","4/13","4/14","4/15","4/16","4/17","4/18","4/19","4/20","4/21","4/22","4/23","4/24","4/25"
            ,"21/1","21/2","21/3","21/4","21/5","21/6","21/7","21/8","21/9","21/10","5/11","5/12","5/13","5/14","5/15","5/16","5/17","5/18","5/19","5/20","5/21","5/22","5/23","5/24","5/25"
            ,"22/1","22/2","22/3","22/4","22/5","22/6","22/7","22/8","22/9","22/10","6/11","6/12","6/13","6/14","6/15","6/16","6/17","6/18","6/19","6/20","6/21","6/22","6/23","6/24","6/25"
            ,"23/1","23/2","23/3","23/4","23/5","23/6","23/7","23/8","23/9","23/10","7/11","7/12","7/13","7/14","7/15","7/16","7/17","7/18","7/19","7/20","7/21","7/22","7/23","7/24","7/25"
            ,"24/1","24/2","24/3","24/4","24/5","24/6","24/7","24/8","24/9","24/10","8/11","8/12","8/13","8/14","8/15","8/16","8/17","8/18","8/19","8/20","8/21","8/22","8/23","8/24","8/25"
            ,"25/1","25/2","25/3","25/4","25/5","25/6","25/7","25/8","25/9","25/10","9/11","9/12","9/13","9/14","9/15","9/16","9/17","9/18","9/19","9/20","9/21","9/22","9/23","9/24","9/25"
            );

                                // Add elements here
                                var pickArr = new Array(); // The array that will be formed
                                var count=0;
                                var doFlag=false;
                                var iterations=0;

                                function pickNums(nums)
                                {
                                    iterations+=1;
                                    var currNum = Math.round((numArr.length-1)*Math.random());
                                    if(count!=0)
                                    {
                                        for(var i=0; i<pickArr.length; i++)
                                        {
                                            if(numArr[currNum]==pickArr[i])
                                            {
                                                doFlag=true;
                                                break;
                                            }
                                        }
                                    }
                                    if(!doFlag)
                                    {
                                        pickArr[count]=numArr[currNum];
                                        document.write('<a href=\"' + numArr[currNum] + '\">'+numArr[currNum]+'</a> <font color="#808080">|</font> ');
                                        count+=1;
                                    }
                                    if(iterations<(numArr.length*3)) // Compare for max iterations you want
                                    {
                                        if((count<nums))
                                        {
                                            pickNums(nums);
                                        }
                                    }
                                    else
                                    {
                                        location.reload();
                                    }
                                }

                                pickNums(5); // Call the function, the argument is the number of elements you want to pick.
                                // Here we pick 5 unique random numbers
                                // ]]></script>
                            </span>
                        </span>
                    </form>
                    <!-- Texto Adicional Abaixo do Gerador -->
                    <p class="gerador-texto">Os prognósticos acima foram gerados pelo próprio sistema, mas você pode escolher seus próprios prognósticos na tabela dos prognósticos válidos no jogo.</p>
                </td>
            </tr>

             <!-- Colocação e Prognósticos -->
            <tr>
                <td colspan="13" class="prognosticos-container">
                    <table class="colocacao-table" style="margin: 0 auto;"> <!-- Centraliza a tabela horizontalmente -->
                        <tr>
                            <td>Colocação:</td>
                            <td>1º Prêmio:</td>
                            <td>2º Prêmio:</td>
                            <td>3º Prêmio:</td>
                            <td>4º Prêmio:</td>
                            <td>5º Prêmio:</td>
                        </tr>
                        <tr>
                            <td>Prognósticos:</td>
                            <td><input type="text" id="pri_premio" name="pri_premio" size="1" /></td>
                            <td><input type="text" id="seg_premio" name="seg_premio" size="1" /></td>
                            <td><input type="text" id="ter_premio" name="ter_premio" size="1" /></td>
                            <td><input type="text" id="qua_premio" name="qua_premio" size="1" /></td>
                            <td><input type="text" id="qui_premio" name="qui_premio" size="1" /></td>
                        </tr>
                    </table>
                </td>
            </tr>

        </tbody>
    </table>

    <!-- Opções de Pagamento -->
    <div class="payment-options">
        <p>Selecione o método de pagamento:</p>
        <button type="button" onclick="showPaymentDetails('metamask')">Metamask</button>
        <button type="button" onclick="showPaymentDetails('pix')">PIX</button>
    </div>

    <!-- Detalhes do Pagamento Metamask -->
    <div id="metamaskDetails" class="payment-details">
        <h3>Pagar com Metamask</h3>
        <p>Conecte sua carteira Metamask para realizar o pagamento.</p>
        <button type="button" onclick="payWithMetamask()">Conectar e Pagar com Metamask</button>
        <p id="metamaskStatus"></p>
    </div>

    <!-- Detalhes do Pagamento PIX -->
    <div id="pixDetails" class="payment-details">
        <h3>Pagar com PIX</h3>
        <p>Escaneie o código QR ou copie o código PIX para realizar o pagamento.</p>
        <img src="URL_DO_SEU_QR_CODE_PIX" alt="QR Code PIX" style="max-width: 200px;">
        <p>Código PIX: <span id="pixCode">SUA_CHAVE_PIX</span></p>
        <button onclick="copyPixCode()">Copiar Código PIX</button>
        <p id="pixStatus"></p>
    </div>

<input type="hidden" name="numero_aposta" value="<?php echo htmlspecialchars($numero_aposta); ?>">

</form>


<script>
    function showPaymentDetails(paymentMethod) {
        // Esconde todos os detalhes de pagamento
        document.querySelectorAll('.payment-details').forEach(function(el) {
            el.classList.remove('active');
        });

        // Mostra os detalhes do método de pagamento selecionado
        document.getElementById(paymentMethod + 'Details').classList.add('active');
    }

    function payWithMetamask() {
        // Coloque aqui a lógica para conectar com o Metamask e processar o pagamento
        // Exemplo:
        // if (typeof window.ethereum !== 'undefined') { ... }
        document.getElementById('metamaskStatus').innerText = "Conectando com Metamask... (Implemente a lógica de conexão)";
    }

    function copyPixCode() {
        // Coloque aqui a lógica para copiar o código PIX para a área de transferência
        // Exemplo:
        // navigator.clipboard.writeText(document.getElementById('pixCode').innerText);
        // alert("Código PIX copiado para a área de transferência!");
        var pixCode = document.getElementById('pixCode').innerText;

        navigator.clipboard.writeText(pixCode)
            .then(function() {
                document.getElementById('pixStatus').innerText = 'Código PIX copiado!';
            })
            .catch(function(err) {
                console.error('Erro ao copiar código PIX: ', err);
                document.getElementById('pixStatus').innerText = 'Erro ao copiar código PIX!';
            });

    }
</script>

</body>
</html>
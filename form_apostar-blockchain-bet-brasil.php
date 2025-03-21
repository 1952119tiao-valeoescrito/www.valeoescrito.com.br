<!DOCTYPE html>
<html>
<head>
	<title>BET BRASIL</title>
	<meta content="text/html;charset=UTF-8" http-equiv="Content-Type" /><script type="text/javascript">
//<![CDATA[
// Do print the page
window.onload = function()
{
    if (typeof(window.print) != 'undefined') {
        window.print();
    }
}
//]]>
</script><script type="text/javascript">
//<![CDATA[
// updates current settings
if (window.parent.setAll) {
    window.parent.setAll('ptbr-utf-8', 'utf8_general_ci', '1', 'loteria', 'usuarios', '02988897ba64e331e68935b28932ea77');
}
    // set current db, table and sql query in the querywindow
if (window.parent.reload_querywindow) {
    window.parent.reload_querywindow(
        'loteria',
        'usuarios',
        '');
}
 
if (window.parent.frame_content) {
    // reset content frame name, as querywindow needs to set a unique name
    // before submitting form data, and navigation frame needs the original name
    if (typeof(window.parent.frame_content.name) != 'undefined'
     && window.parent.frame_content.name != 'frame_content') {
        window.parent.frame_content.name = 'frame_content';
    }
    if (typeof(window.parent.frame_content.id) != 'undefined'
     && window.parent.frame_content.id != 'frame_content') {
        window.parent.frame_content.id = 'frame_content';
    }
    //window.parent.frame_content.setAttribute('name', 'frame_content');
    //window.parent.frame_content.setAttribute('id', 'frame_content');
}
//]]>
</script>



<?php
   
         $num_extracao = $_POST["num_extracao"];
         $data_extracao = $_POST["data_extracao"];
         $num_token = $_POST["num_token"];
         $country_pais = $_POST["country_pais"];
         $email_indicador = $_POST["email_indicador"];
         $email_investidor = $_POST["email_investidor"];
         $telefone = $_POST["telefone"];
         $pri_premio = $_POST["pri_premio"];
         $seg_premio = $_POST["seg_premio"];
         $ter_premio = $_POST["ter_premio"];
         $qua_premio = $_POST["qua_premio"];
         $qui_premio = $_POST["qui_premio"];


         if(empty($num_extracao)):
            echo "<script>alert('Preencha o campo Extração nº:')</script>";
            echo "<script>history.back()</script>";
            exit;
            elseif(empty($data_extracao)):
            echo "<script>alert('Preencha o campo Data:')</script>";
            echo "<script>history.back()</script>";
            exit;
            elseif(empty($num_token)):
            echo "<script>alert('Preencha o campo Token nº:')</script>";
            echo "<script>history.back()</script>";
            exit;
            elseif(empty($country_pais)):
            echo "<script>alert('Preencha o campo Pais:')</script>";
            echo "<script>history.back()</script>";
            exit;
            elseif(empty($email_indicador)):
            echo "<script>alert('Preencha o campo E-mail indicador:')</script>";
            echo '<script>history.back()</script>';
            exit;
            elseif(empty($email_investidor)):
            echo "<script>alert('Preencha o campo Seu e-mail:')</script>";
            echo '<script>history.back()</script>';
            exit;
            elseif(empty($telefone)):
            echo "<script>alert('Preencha o campo Seu telefone:')</script>";
            echo "<script>history.back()</script>";
            exit;
            elseif(empty($pri_premio)):
            echo "<script>alert('Preencha o campo 1º Prêmio:')</script>";
            echo '<script>history.back()</script>';
            exit;
            elseif(empty($seg_premio)):
            echo "<script>alert('Preencha o campo 2º Prêmio:')</script>";
            echo "<script>history.back()</script>";
            exit;
            elseif(empty($ter_premio)):
            echo "<script>alert('Preencha o campo 3º Prêmio:')</script>";
            echo "<script>history.back()</script>";
            exit;
            elseif(empty($qua_premio)):
            echo "<script>alert('Preencha o campo 4º Prêmio:')</script>";
            echo "<script>history.back()</script>";
            exit;
            elseif(empty($qui_premio)):
            echo "<script>alert('Preencha o campo 5º Prêmio:')</script>";
            echo "<script>history.back()</script>";
            exit;
            else:
         $num_extracao  = addslashes($_POST['num_extracao']);
         $data_extracao  = addslashes($_POST['data_extracao']);
         $num_token  = addslashes($_POST['num_token']);
         $country_pais  = addslashes($_POST['country_pais']);
         $email_indicador  = addslashes($_POST['email_indicador']);
         $email_investidor  = addslashes($_POST['email_investidor']);
         $telefone  = addslashes($_POST['telefone']);
         $pri_premio  = addslashes($_POST['pri_premio']);
         $seg_premio = addslashes($_POST['seg_premio']);
         $ter_premio = addslashes($_POST['ter_premio']);
         $qua_premio = addslashes($_POST['qua_premio']);
         $qui_premio = addslashes($_POST['qui_premio']);
         $pri_premio = ($pri_premio);
         $seg_premio = ($seg_premio);
         $ter_premio = ($ter_premio);
         $qua_premio = ($qua_premio);
         $qui_premio = ($qui_premio);
endif;

     

$servername = "mysql48-farm1.kinghost.net";
$username = "valeoescrito";
$password = "Kmvd96uJ";
$database = "valeoescrito";

	
	

            $conexao = new mysqli($servername, $username, $password, $database);

    if (!$conexao) {
        die("N&#65533;o foi poss&#65533;vel conectar ao banco de dados" . mysqli_connect_error());
    }

    $string_sql = "INSERT INTO apostar-blockchain-bet-brasil (num_extracao, data_extracao, num_token, country_pais, email_indicador, email_investidor, telefone, pri_premio, seg_premio, ter_premio, qua_premio, qui_premio) VALUES ('{$num_extracao}','{$data_extracao}','{$num_token}','{$country_pais}','{$email_indicador}','{$email_investidor}','{$telefone}','{$pri_premio}','{$seg_premio}','{$ter_premio}','{$qua_premio}','{$qui_premio}')";

    $result = mysqli_query($conexao,$string_sql);

    if(mysqli_affected_rows($conexao) >0){ //verifica se foi afetada alguma linha, nesse caso inserida alguma linha
      echo "BLOCKCHAIN BET BRASIL - VALE O ESCRITO.<br>Seu registro foi realizado com sucesso.<br>Obrigado por confiar em nosso empreendimento!!!"; 
      //Apenas um link para retornar para o formul&#65533;rio de cadastro
    } else {
      echo "Erro, n&#65533;o poss&#65533;vel inserir no banco de dados";
    }

    mysqli_close($conexao); //fecha conex&#65533;o com banco de dados

 
     echo '


</head>
<body>

<div align="center">
</div>

<table align="center" border="0" cellpadding="1" cellspacing="1" style="height: 690px; width: 617px">
	<tbody>
		<tr>
			<td colspan="10" style="text-align: left"><input alt="" size="1" src="OIG1.jpeg" style="height: 160px; width: 650px" type="image" /></td>
		</tr>
		<tr>
			<td colspan="10" style="text-align: center">
			<span style="font-size: 24px"><strong><span style="color: #ff0000">FAZENDO A DIFEREN&Ccedil;A, AJUDANDO AS PESSOAS.</span></strong></span></td>
		</tr>
		<tr>
			<td colspan="10" style="text-align: center">
			<center><span style="font-size: 18px"><strong><span style="color: #4b0082"><span style="font-family: arial, helvetica, sans-serif">CONTEMPLAMOS VOCE COM 5, 4, 3, 2 E ATE COM 1 PONTO APENAS.</span></span></strong></span></center>
			</td>
		</tr>
		<tr>
			<td colspan="10" style="text-align: center"><span style="font-size: 22px"><strong><span style="color: #ff0000"><font face="Arial">SORTEIOS TODA QUARTA-FEIRA PELA LOTERIA FEDERAL</font></span></strong></span></td>
		</tr>
		<tr>
			<td colspan="10" style="text-align: center">
			<div><strong><span style="font-size: 20px"><span style="font-family: arial, helvetica, sans-serif"><span><span size:="">Extra&ccedil;&atilde;o n&ordm;: '.$num_extracao.'&nbsp;&nbsp;***** &nbsp;</span></span></span></span></strong><span style="font-size: 20px"><span style="font-family: arial, helvetica, sans-serif"><span><span size:=""><strong>Corre dia: '.$data_extracao.'</strong></span></span></span></span></div>
			</td>
		</tr>
		<tr>
			<td colspan="10" style="text-align: center"><strong><span style="font-size: 20px"><span style="font-family: arial, helvetica, sans-serif"><span size:="">Token n&ordm;: '.$num_token.' ***** </span></span></span></strong><span style="font-size: 20px"><span style="font-family: arial, helvetica, sans-serif"><span size:=""><strong>Pais: '.$country_pais.'</strong></span></span></span></td>
		</tr>
<tr>
			<td colspan="10" style="text-align: center"><strong><span style="font-size: 20px"><span style="font-family: arial, helvetica, sans-serif"><span size:="20"><span style="color: rgb(169,169,169)">E-mail indicador:&nbsp;</span><a><span style="color: rgb(169,169,169)">'.$email_indicador.'</span></a><span style="color: rgb(169,169,169)">&nbsp;&nbsp;&nbsp;</span></span><span style="color: rgb(169,169,169)">&nbsp;<span size:="">&nbsp;</span></span></span></span></strong></td>
		</tr>
		<tr>
			<td colspan="10" style="text-align: center"><strong><span style="font-size: 20px"><span style="font-family: arial, helvetica, sans-serif"><span size:="20"><span style="color: rgb(169,169,169)">Seu e-mail:&nbsp;</span><a><span style="color: rgb(169,169,169)">'.$email_investidor.'</span></a><span style="color: rgb(169,169,169)">&nbsp;&nbsp;&nbsp;</span></span><span style="color: rgb(169,169,169)">&nbsp;<span size:="">&nbsp;</span></span></span></span></strong></td>
		</tr>
		<tr>
			<td colspan="10" style="text-align: center">
			<div><strong><span style="font-size: 20px"><span style="font-family: arial, helvetica, sans-serif"><span size:="20"><span style="color: rgb(169,169,169)">Seu telefone: </span><a><span style="color: rgb(169,169,169)">'.$telefone.'</span></a><span style="color: rgb(169,169,169)">&nbsp;&nbsp;&nbsp;</span></span></span></span></strong></div>
			</td>
		</tr>
		<tr>

			<td colspan="10" style="text-align: center">
			<table align="center" border="0" cellpadding="1" cellspacing="1" style="height: 85px; width: 700px">
				<tbody>
					<tr>
								
						<td colspan="6"><span style="color: #000080"><span style="font-size: 22px"><strong>VALE O ESCRITO</strong></span></span></td>
					</tr>
					<tr>
						<td><span style="color: #ff0000"><span style="font-size: 18px"><strong><span style="background-color: #ffffff">Colocacao:</span></strong></span></span></td>
						<td><span style="color: #ff0000"><span style="font-size: 18px"><strong><span style="background-color: #ffffff">1&ordm; Pr&ecirc;mio:</span></strong></span></span></td>
						<td><span style="color: #ff0000"><span style="font-size: 18px"><strong><span style="background-color: #ffffff">2&ordm; Pr&ecirc;mio:</span></strong></span></span></td>
						<td><span style="color: #ff0000"><span style="font-size: 18px"><strong><span style="background-color: #ffffff">3&ordm; Pr&ecirc;mio:</span></strong></span></span></td>
						<td><span style="color: #ff0000"><span style="font-size: 18px"><strong><span style="background-color: #ffffff">4&ordm; Pr&ecirc;mio:</span></strong></span></span></td>
						<td><span style="color: #ff0000"><span style="font-size: 18px"><strong><span style="background-color: #ffffff">5&ordm; Pr&ecirc;mio:</span></strong></span></span></td>
					</tr>
					<tr>
						<td><span style="color: #000080"><span style="font-size: 18px"><strong><span pbzloc="341" style="background-color: #ffffff">Progn&oacute;sticos:</span></strong></span></span></td>
						<td><span style="color: #000080"><span style="font-size: 18px"><strong><span style="background-color: #ffffff">&nbsp;&nbsp;'.$pri_premio.'</span></strong></span></span></td>
						<td><span style="color: #000080"><span style="font-size: 18px"><strong><span pbzloc="275" style="background-color: #ffffff">&nbsp;'.$seg_premio.'</span></strong></span></span></td>
						<td><span style="color: #000080"><span style="font-size: 18px"><strong><span style="background-color: #ffffff">&nbsp;'.$ter_premio.'</span></strong></span></span></td>
						<td><span style="color: #000080"><span style="font-size: 18px"><strong><span style="background-color: #ffffff">&nbsp;'.$qua_premio.'</span></strong></span></span></td>
						<td><span style="color: #000080"><span style="font-size: 18px"><strong><span pbzloc="263" style="background-color: #ffffff">&nbsp;'.$qui_premio.'</span></strong></span></span></td>
					</tr>
					<tr>
						<td colspan="6"><span style="font-size: 22px"><span style="color: #ff0000"><span><strong><span>APOSTA REGISTRADA EM BANCO DE DADOS.</span><span></span></strong></span></span></span></td>
					</tr>
				</tbody>
			</table>

			<table align="center" border="0" cellpadding="1" cellspacing="1" style="height: 286px; width: 700px">
				<tbody>
					<tr>
						<td>
						<div style="text-align: center"><span style="color: #808080"><span style="font-size: 14px"><span style="font-family: arial, helvetica, sans-serif; white-space: normal; word-spacing: 0px; text-transform: none; float: none; font-weight: 400; font-style: normal; text-align: center; orphans: 2; widows: 2; display: inline !important; letter-spacing: normal; text-indent: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; font-variant-ligatures: normal; font-variant-caps: normal"><strong>PAGAMENTO&nbsp;VIA PIX.</strong></span></span></span></div>

						<div><span style="color: #808080"><span style="font-size: 14px"><span style="font-family: arial, helvetica, sans-serif; white-space: normal; word-spacing: 0px; text-transform: none; float: none; font-weight: 400; font-style: normal; text-align: center; orphans: 2; widows: 2; display: inline !important; letter-spacing: normal; text-indent: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; font-variant-ligatures: normal; font-variant-caps: normal">Escaneie o QR Code dentro do aplicativo do seu banco.</span></span></span></div>

						<div style="text-align: center"><span style="color: #808080"><span style="font-size: 14px"><span style="font-family: arial, helvetica, sans-serif; white-space: normal; word-spacing: 0px; text-transform: none; float: none; font-weight: 400; font-style: normal; text-align: center; orphans: 2; widows: 2; display: inline !important; letter-spacing: normal; text-indent: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; font-variant-ligatures: normal; font-variant-caps: normal"></span></span></span></div>

						<div style="text-align: center"><span style="color: #808080"><span style="font-size: 20px"><span style="font-family: arial, helvetica, sans-serif; white-space: normal; word-spacing: 0px; text-transform: none; float: none; font-weight: 400; font-style: normal; text-align: center; orphans: 2; widows: 2; display: inline !important; letter-spacing: normal; text-indent: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; font-variant-ligatures: normal; font-variant-caps: normal"><img border="0" height="509" hspace="0" src="img_valeoescrito_serie-intermediaria.jpeg" style="height: 260px; width: 260px" width="260" /></span></span></span></div>
						</td>
						<td>
						<div>
						<div style="font-size: medium; font-family: &quot;Times New Roman&quot;; white-space: normal; word-spacing: 0px; text-transform: none; font-weight: 400; color: rgb(0,0,0); font-style: normal; text-align: center; orphans: 2; widows: 2; letter-spacing: normal; text-indent: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; font-variant-ligatures: normal; font-variant-caps: normal"><span style="color: #808080"><span style="font-size: 14px"><span><strong>ACEITAMOS PAGAMENTO COM CRIPTOMOEDAS.&nbsp;</strong></span></span></span></div>

						<div style="font-size: medium; font-family: &quot;Times New Roman&quot;; white-space: normal; word-spacing: 0px; text-transform: none; font-weight: 400; color: rgb(0,0,0); font-style: normal; text-align: center; orphans: 2; widows: 2; letter-spacing: normal; text-indent: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; font-variant-ligatures: normal; font-variant-caps: normal"><span style="color: #808080"><span style="font-size: 14px"><strong>PAGUE 0,00046 ETH.</strong></span></span></div>
						<div style="font-size: medium; font-family: &quot;Times New Roman&quot;; white-space: normal; word-spacing: 0px; text-transform: none; font-weight: 400; color: rgb(0,0,0); font-style: normal; text-align: center; orphans: 2; widows: 2; letter-spacing: normal; text-indent: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; font-variant-ligatures: normal; font-variant-caps: normal">&nbsp;</div>



						<div style="font-size: medium; font-family: &quot;Times New Roman&quot;; white-space: normal; word-spacing: 0px; text-transform: none; font-weight: 400; color: rgb(0,0,0); font-style: normal; text-align: center; orphans: 2; widows: 2; letter-spacing: normal; text-indent: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; font-variant-ligatures: normal; font-variant-caps: normal"><span style="color: #808080"><span style="font-size: 14px"><strong><span>DEPOSITE NA CARTEIRA 0x9D586CbA6c856B4979C1D2e5115ecdBAc85184E8.</span></strong></span></span></div>

						<div style="font-size: medium; font-family: &quot;Times New Roman&quot;; white-space: normal; word-spacing: 0px; text-transform: none; font-weight: 400; color: rgb(0,0,0); font-style: normal; text-align: center; orphans: 2; widows: 2; letter-spacing: normal; text-indent: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; font-variant-ligatures: normal; font-variant-caps: normal">&nbsp;</div>

						<div style="font-size: medium; font-family: &quot;Times New Roman&quot;; white-space: normal; word-spacing: 0px; text-transform: none; font-weight: 400; color: rgb(0,0,0); font-style: normal; text-align: center; orphans: 2; widows: 2; letter-spacing: normal; text-indent: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; font-variant-ligatures: normal; font-variant-caps: normal"><span style="color: #808080"><span style="font-size: 14px"><strong>CONHE&Ccedil;A-NOS MELHOR</strong></span></span></div>

						<div style="font-size: medium; font-family: &quot;Times New Roman&quot;; white-space: normal; word-spacing: 0px; text-transform: none; font-weight: 400; color: rgb(0,0,0); font-style: normal; text-align: center; orphans: 2; widows: 2; letter-spacing: normal; text-indent: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; font-variant-ligatures: normal; font-variant-caps: normal"><span style="font-size: 16px"><span><span style="color: #0000cd">&nbsp;</span><span style="font-size: 18px"><strong><a href="https://www.valeoescrito.com.br"><span style="color: #0000cd">VALE O ESCRITO</span></a></strong></span></span></span></div>

						<div style="font-size: medium; font-family: &quot;Times New Roman&quot;; white-space: normal; word-spacing: 0px; text-transform: none; font-weight: 400; color: rgb(0,0,0); font-style: normal; text-align: center; orphans: 2; widows: 2; letter-spacing: normal; text-indent: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; font-variant-ligatures: normal; font-variant-caps: normal"><br />
						<span style="color: #808080"><span style="font-size: 14px"><span><strong>COMO FAZER / SABER PARA RECEBER O PR&Ecirc;MIO?<br>ENTRAREMOS EM CONTATO COM VOCE!</strong><br />
						<strong>FIQUE TRANQUILO.</strong></span></span></span></div>


						<div style="font-size: medium; font-family: &quot;Times New Roman&quot;; white-space: normal; word-spacing: 0px; text-transform: none; font-weight: 400; color: rgb(0,0,0); font-style: normal; text-align: center; orphans: 2; widows: 2; letter-spacing: normal; text-indent: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; font-variant-ligatures: normal; font-variant-caps: normal"><br><input alt="" size="1" src="estamos-juntos.jpg" style="height: 57px; width: 86px" type="image" /><br />
						&nbsp;</div>
						</div>
						</td>
					</tr>
				</tbody>
			</table>

			<span style="font-size: 14px"><strong><span style="font-family: arial, helvetica, sans-serif; white-space: normal; word-spacing: 0px; text-transform: none; float: none; font-weight: 400; font-style: normal; text-align: center; orphans: 2; widows: 2; display: inline !important; letter-spacing: normal; text-indent: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; font-variant-ligatures: normal; font-variant-caps: normal"><span style="color: #ff0000">D&uacute;vidas? Envie um e-mail para </span><a href="mailto:suporte@valeoescrito.com.br"><span style="color: #000080"><span>suporte@valeoescrito.com.br</span></span></a><span style="color: #000080">&nbsp;</span><span style="color: #ff0000">WhatsApp&nbsp;</span><span style="color: #000080">+55 (21) 99352-7957</span><span style="color: #ff0000">.</span></span></strong></span></td>
		</tr>
		<tr>
			<td colspan="10"><span style="color: #808080"><span style="font-size: 20px"><strong><span style="font-size: 16px"></span></strong></span></span><span style="color: #000080"><span style="font-size: 20px"><strong><span style="font-size: 16px">&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;Entrega o teu caminho ao Senhor, confie Nele, e o&nbsp;mais Ele far&aacute;&quot; (Salmos 37:5)</span></strong></span></span></td>
	</tr>
</tbody>
</table>

<div style="font-size: medium; font-family: &quot;Times New Roman&quot;; white-space: normal; word-spacing: 0px; text-transform: none; font-weight: 400; color: rgb(0,0,0); font-style: normal; text-align: center; orphans: 2; widows: 2; letter-spacing: normal; text-indent: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; font-variant-ligatures: normal; font-variant-caps: normal"><span style="color: #a9a9a9">&nbsp;</span></div>
    </div>';


    

                  exit;

                  session_start();
                  $_SESSION['num_extracao'] = $num_extracao;
                  $_SESSION['data_extracao'] = $data_extracao;
                  $_SESSION['num_token'] = $num_token;
                  $_SESSION['country_pais'] = $country_pais;
                  $_SESSION['email_indicador'] = $email_indicador;
                  $_SESSION['email_investidor'] = $email_investidor;
                  $_SESSION['telefone'] = $telefone;
                  $_SESSION['pri_premio'] = $pri_premio;
                  $_SESSION['seg_premio'] = $seg_premio;
                  $_SESSION['ter_premio'] = $ter_premio;
                  $_SESSION['qua_premio'] = $qua_premio;
                  $_SESSION['qui_premio'] = $qui_premio;
                  header("location:registrar.php");
              

        ?>



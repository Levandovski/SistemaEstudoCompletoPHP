<?php 
     include "conexao.php"; 
     $recebeEmail = $_POST['email'];
     $filtraEmail = filter_var($recebeEmail,FILTER_SANITIZE_SPECIAL_CHARS);
     $filtraEmail = filter_var($filtraEmail, FILTER_SANITIZE_MAGIC_QUOTES);
	 $suaConexao = mysqli_connect("localhost","root","","empresax");
     $sql_pesq = mysqli_query($suaConexao, "SELECT * FROM usuario WHERE email_tblusuario = '$recebeEmail'") or die (mysql_error());
     $verifica = mysqli_num_rows($sql_pesq);
?>
<!DOCTYPE HTML>
<html lang="br" class="no-js">
     <head>
          <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
          <title>Sistema de Login e Senha Criptografados</title>
          <link href="css/style.css" rel="stylesheet" />
     </head>
     <body>
          
               <?php if ($verifica == 0) { ?>
			        <div id="conteudo">
                    <H2>E-mail inválido!</H2> 
                    <p>Desculpe, mas o e-mail solicitado não está cadastrado.</p>
                    <p>Entre em contato com o administrador do sistema.<br></p>
                    Se quiser tentar novamente, <a href="../">clique aqui</a>.</p>
                    <p>Obrigado.</p>
					</div>
               <?php }
               else {
                    $result = mysqli_fetch_array($sql_pesq);/*Utilizar fetch array sempre com a variavel que recebeu a consulta*/
                    $id_usuario = $result['id_tblusuario'];
                    $nome = $result['nome_tblusuario'];
                    $email = $result['email_tblusuario'];
                    function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false){
                         $lmin = 'abcdefghijklmnopqrstuvwxyz';
                         $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                         $num = '1234567890';
                         $simb = '!@#$%*-';
                         $retorno = '';
                         $caracteres = '';
                         $caracteres .= $lmin;
                         if ($maiusculas) $caracteres .= $lmai;
                         if ($numeros) $caracteres .= $num;
                         if ($simbolos) $caracteres .= $simb;
                         $len = strlen($caracteres);
                         for ($n = 1; $n <= $tamanho; $n++) {
                              $rand = mt_rand(1, $len);
                              $retorno .= $caracteres[$rand-1];
                         }
                         return $retorno;
                    }
                    $novasenha = geraSenha(9, true, false);
                    $senhamd5 = md5($novasenha);
 
                    $query = "UPDATE usuario SET senha_tblusuario = '$senhamd5' where id_tblusuario = ".$id_usuario;
                    $rs = mysqli_query($suaConexao, $query);
                    $formato = "\nContent-type: text/html";
                    $msg = "Olá, $nome. Recebemos uma solicitação para renovar sua senha.<br><br>";
                    $msg .= "Seu usuario: <strong>$usuario</strong><br>";
                    $msg .= "Sua <strong>nova</strong> senha: <strong>$novasenha</strong><br><br>";
                    $msg .= "Caso não tenha solicitado esta ação. Acesse a sua conta e altere sua senha novamente.<br>";
                    $msg .= "<br>";	
                    $msg .= "Obrigado.<br>";
                    mail("$email","Nova Senha","$msg", "From: Sistema <sistema@sistema.com> ".$formato);
               ?>
			   <div id="conteudo">
               <H2>Senha enviada!</H2> 
               <p>Parabéns. Sua senha foi enviada para o e-mail solicitado.</p>
               <p>Após verificar seu e-mail, retorne à página de login.</p>
               <p>Se preferir, <a href="index.php">clique aqui</a>.</p>
               <p>Obrigado!</p>
			   </div>
             <?php } ?>
			 
     </body>
</html>
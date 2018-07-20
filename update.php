<?php 
     include "conexao.php";
     $suaConexao=mysqli_connect("localhost","root","","empresax");
     $recebeId = $_POST['id'];
     $filtraId = filter_var($recebeId,FILTER_SANITIZE_SPECIAL_CHARS);
     $filtraId = filter_var($filtraId, FILTER_SANITIZE_MAGIC_QUOTES);
 
   
     $recebeNome = $_POST['nome'];
     $filtraNome = filter_var($recebeNome,FILTER_SANITIZE_SPECIAL_CHARS);
     $filtraNome = filter_var($filtraNome, FILTER_SANITIZE_MAGIC_QUOTES);
 
     $recebeEmail = $_POST['email'];
     $filtraEmail = filter_var($recebeEmail,FILTER_SANITIZE_SPECIAL_CHARS);
     $filtraEmail = filter_var($filtraEmail, FILTER_SANITIZE_MAGIC_QUOTES);
 
     $oldSenha = $_POST['old_pass'];
     $filtra_oldSenha = filter_var($oldSenha,FILTER_SANITIZE_SPECIAL_CHARS);
     $filtra_oldSenha = filter_var($filtra_oldSenha, FILTER_SANITIZE_MAGIC_QUOTES);
   
     $newSenha = $_POST['new_pass'];
	 $filtra_newSenha = filter_var($newSenha,FILTER_SANITIZE_SPECIAL_CHARS);
     $filtra_newSenha = filter_var($filtra_newSenha, FILTER_SANITIZE_MAGIC_QUOTES);
 
     $conf_newSenha = $_POST['conf_new_pass'];
     $filtra_conf_newSenha = filter_var($conf_newSenha,FILTER_SANITIZE_SPECIAL_CHARS);
     $filtra_conf_newSenha = filter_var($filtra_conf_newSenha, FILTER_SANITIZE_MAGIC_QUOTES);
 
     function criptoSenha($criptoSenha){
     return md5($criptoSenha);
}
 
     
	 $criptoSenha_oldSenha= criptoSenha($filtra_oldSenha);
     $criptoSenha_newSenha = criptoSenha($filtra_newSenha);
	 $criptoSenha_confSenha= criptoSenha($filtra_conf_newSenha);
     $sql = mysqli_query($suaConexao, "SELECT * from usuario WHERE id_tblusuario = $filtraId");
     $result=(mysqli_fetch_assoc($sql));
?>
<!DOCTYPE HTML>
<html>
     <head>
	      <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
          <title>Atualização de dados</title>
          <link href="css/style.css" rel="stylesheet" />
     </head>
     <body>
          <div id="conteudo">
          <h1>Atualização de dados</h1>
          <div class="borda"></div>
               <?php
			         if ($criptoSenha_oldSenha != $result['senha_tblusuario']){
                         echo "<p>Senha antiga informada não confere com a senha armazenada. Por favor, <a href='javascript:history.back();'>volte</a> e tente novamente!</p>";
                         return false;
                    }
                    else{
                         if ($criptoSenha_newSenha != $criptoSenha_confSenha){
                              echo "<p>A nova senha e a confirmação da nova senha não são iguais. Por favor, <a href='javascript:history.back();'>volte</a> e tente novamente!</p>";
                              return false;
                         }
                         else {
  $query = mysqli_query($suaConexao,"UPDATE usuario SET nome_tblusuario = '$filtraNome', senha_tblusuario = '$criptoSenha_newSenha' where id_tblusuario = ".$filtraId);
                              echo "<p>Dados atualizados com sucesso!</p>";
                         }
                    }
               ?>
          </div>
     </body>
</html>
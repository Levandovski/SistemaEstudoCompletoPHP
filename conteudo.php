<?php
     include "conexao.php";
	 $suaConexao =mysqli_connect("localhost","root","","empresax");
     $sql=mysqli_query($suaConexao, "Select * from usuario order by nome_tblusuario");
?>
<!DOCTYPE HTML>
<html>
     <head>
         <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
          <title>Listagem de conte�do</title>
          <link href="css/style_list.css" rel="stylesheet" />
     </head>
     <body>
          <div id="conteudo">
               <h1>Listagem de conte�do</h1>
               <div class="borda"></div>
               <p>Selecione um usu�rio para atualizar seus dados ou para exclu�-lo!</p>
             
			   <div class="DconteudoTextoFora">
			   <div class="DconteudoTextDentro">Nome</div>
			   <div class="DconteudoTextDentro">Email</div>
               <div class="DconteudoTextDentro">A��o</div>
			  </div>
			    <div class="dconteudoListaFora">
               <div class="clear"></div>
               <?php
                    while ($result=mysqli_fetch_array($sql)){
               ?>
                         <div class="dconteudoListaDentro"><?php echo $result['nome_tblusuario']; ?></div>
                         <div class="dconteudoListaDentro"><?php echo $result['email_tblusuario']; ?></div>
                         <div class="dconteudoListaDentro"><a href="fupdate.php?id=<?php echo $result['id_tblusuario']; ?>"> Atualizar </a></div>
                         <div class="dconteudoListaDentro"><a href="excluir.php?id=<?php echo $result['id_tblusuario']; ?>"> Excluir </a></div>
                         <div class="clear"></div>
               <?php } ?>
          </div>
		  </div>
     </body>
</html>
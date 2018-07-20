<!DOCTYPE HTML>
<html>
     <head>
          <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
          <title>Sistema de Login e Senha Criptografados</title>
          <link href="css/style.css" rel="stylesheet" />
     </head>
     <body>
          <div id="conteudo">
               <h1>Sistema de login e senha criptografados - Cadastro de usu�rio</h1>
               <div class="borda"></div>
               <p>Para ter acesso ao conte?do exclusivo, por favor, cadastre-se utilizando o formul�rio abaixo!</p>
               <form method="post" action="cadastraUsuario.php" id="validaAcesso">
                    <fieldset>
                         <legend>Fa�a seu cadastro abaixo!</legend>
                         <label for="nome">Seu nome:</label>
                         <input type="text" name="nome" id="nome" required />
                         <div class="clear"></div>
                         <label for="email">E-mail:</label>
                         <input type="email" name="email" id="email" required />
                         <div class="clear"></div>
                         <label for="senha">Senha:</label>
                         <input type="password" name="senha" id="senha" required />
                         <div class="clear"></div>
                         <input type="submit" value="Efetuar cadastro" />
                    </fieldset>
               </form>
               <p>Se voc� j� possui cadastro, <a href="index.php">clique aqui</a> para acessar o Conte�do Exclusivo!</p>
          </div>
     </body>
</html>
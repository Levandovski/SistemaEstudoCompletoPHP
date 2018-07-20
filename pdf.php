<?php
      /*Nesse segundo exemplo o pdf não vai ficar salvo na pasta e sim vai ser gerado e abrira na aba do navegador para que possa fazer download*/
      include "C:\wamp\mpdf/mpdf.php";
      include "conexao.php";
	  $suaConexao=mysqli_connect("localhost","root","","empresax");
      $sql=mysqli_query($suaConexao, "Select * from usuario order by nome_tblusuario");
      $html= "<html>";
      $html = $html . "<head>";
      $html = $html . "<link href=\"css/style.css\" rel=\"stylesheet\" />";
	  $html = $html . "<link href=\"css/style_list.css\" rel=\"stylesheet\" />";
      $html = $html . "</head>";
      $html = $html . "<body>";
      $html = $html . "<div id=\"conteudo\">";
      /*$html = $html . "<div class=\"negrito\">Gerar relatório em PDF</div>";*/
      $html = $html . "<div class=\"borda\"></div>";
      $html = $html . "<div class=\"clear\"></div>";
      $html = $html . "<div class=\"qtde\">Listagem da tabela: usuario</div>";
      $html = $html . "<div class=\"qtde\">Foram encontrados " . mysqli_num_rows($sql) . " registros</div>";
      $html = $html . "<div class=\"clear\"></div>";
      $html = $html . "<div class=\"clear\"></div>";
	  $html = $html . "<div class=\"DconteudoTextoForaRelatorio\">";
      $html = $html . "<div class=\"DconteudoTextDentroRelatorio\">Reg</div>";
      $html = $html . "<div class=\"DconteudoTextDentroRelatorio\">Nome</div>";
      $html = $html . "<div class=\"DconteudoTextDentroRelatorio\">Email</div>";
	  $html = $html . "</div>";
	  $html = $html . "<div class=\"dconteudoListaForaRelatorio\">";
      $html = $html . "<div class=\"clear\"></div>";
      while ($result=mysqli_fetch_array($sql)){
            $i++;
            $html = $html . "<div class=\"dconteudoListaDentroRelatorio\"> " . $i . "</div>";
            $html = $html . "<div class=\"dconteudoListaDentroRelatorio\"> ". $result['nome_tblusuario'] ."</div>";
            $html = $html . "<div class=\"dconteudoListaDentroRelatorio\"> ". $result['email_tblusuario'] ."</div>";
      }
      $html = $html . "</body>";
      $html = $html . "</html>";
 
      $mpdf=new mPDF();
      $mpdf->WriteHTML($html);
      $mpdf->Output();
      exit;
?>

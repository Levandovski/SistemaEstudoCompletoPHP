<?php
/*Nesse exemplo o pdf fica salvo na pasta do html,e para ele ser gerado é necessario que o primerio pdf gerado esteja fechado, pois da erro*/
     include 'C:\wamp\mpdf\mpdf.php';
 
      $servidor = "localhost";
      $usuario = "root";
      $senha = "";
      $banco = "empresax";
      $conecta = mysqli_connect($servidor, $usuario, $senha, $banco);
 
      $sqlbandas=mysqli_query($conecta, "Select * from bandas");
 
     
      $hmtl =  "<html>";
      $html .=  "<head>";
      $html .=  "<link href=\"css/style.css\" rel=\"stylesheet\" />";
      $html .=  "</head>";
      $html .=  "<body>";
      $html .=  "<div id=\"conteudo\">";
      /*$html .= "<div>Gerar relatório em PDF</div>";   Não é possivel usar a tag <h1> e <strong>, pois da erro no codigo ERRO(UTF-8)*/
     $html .= "<div class=\"borda\"></div>";
      $html .=  "<div class=\"clear\"></div>";
      $html .= "<div class=\"negrito\">Listagem das tabelas: bandas e discos</div>";
      $html .= "<div class=\"borda\"></div>";
      $html .=  "<div class=\"clear\"></div>";
 
      while ($result=mysqli_fetch_array($sqlbandas)){
            $html .= "<div class=\"negrito\">" . $result['nome_bandas'] . "</div>";
            $html .= "<div class=\"borda\"></div>";
            $sqldiscos=mysqli_query($conecta, "Select * from discos WHERE id_bandas = " . $result['id_bandas']);
            $html .=  "<div class=\"qtde\">Foram encontrados " . mysqli_num_rows($sqldiscos) . " discos do " .$result['nome_bandas'] . "</div>";
            while ($resultdiscos=mysqli_fetch_array($sqldiscos)){
     $html .=  "<div class=\"discos\"> ". $resultdiscos['titulo_tbl_discos'] ." <span class=\"qtde\">(" . $resultdiscos['ano_tbl_discos'] . ")</span><br>";
                  $html .= "<img width=\"250px\" height=\"250px\" src=\"". $resultdiscos['capa_tbl_discos'] ."\"></div>";
            }
           $html .= "<div class=\"clear\"></div>";
            $html .= "<div class=\"borda\"></div>";
      }
      $html .= "</body>";
      $html .= "</html>";
 
  $arquivo="Exemplo1.pdf";

$mpdf=new mPDF();
$mpdf->WriteHTML($html);
$mpdf->Output($arquivo,'F');
echo "PDF GERADO COM SUCESSO";
 
?>

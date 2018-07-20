<!DOCTYPE HTML>
<html>
     <head>
          <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
          <title>Criar relatórios com PHP</title>
          <link href="css/style.css" rel="stylesheet" />
		  <link href="css/style_list.css" rel="stylesheet" />
          <script src="js/RGraph.common.core.js" ></script>
          <script src="js/RGraph.common.annotate.js" ></script>
          <script src="js/RGraph.common.context.js" ></script>
          <script src="js/RGraph.common.tooltips.js" ></script>
          <script src="js/RGraph.common.resizing.js" ></script>
          <script src="js/RGraph.bar.js" ></script>
          <?php
               include "conexao.php";
			   $suaConexao=mysqli_connect("localhost","root","","empresax");
               $sql=mysqli_query($suaConexao, "Select * from usuario order by idade_tblusuario");
               $i = 0;
               while($result = mysqli_fetch_array($sql)){
                    $nome[$i] = $result['nome_tblusuario'];
                    $idade[$i] = $result['idade_tblusuario'];
                    $i++;
               }
               $aux=$i;
               $aux=$i;
               $i=0;
               $dadosIdades="";
               while ($i <= $aux-1){
                    if ($i == $aux-1){
                         $dadosIdades = $dadosIdades . $idade[$i] ;
                    }
                    else{
                         $dadosIdades = $dadosIdades . $idade[$i] . ",";
                    }
                    $i++;
               }
               $dadosIdades = join(",", array($dadosIdades));
               $dadosIdades = "[$dadosIdades]";
               echo "<script>" . "\n";
               echo "var dadosIdades = $dadosIdades" . ";\n";
               $i=0;
               while ($i <= $aux-1){
                    echo "var idade$i = $idade[$i]; \n";
                    $i++;
               }
               echo "</script>" . "\n";
               echo "<script>" . "\n";
               echo " window.onload = function ()" . "\n";
               echo " {" . "\n";
               echo "var meuGraficoIdades = new RGraph.Bar('meuCanvasGraficoIdades', dadosIdades);" . "\n";
               echo "meuGraficoIdades.Set('chart.background.barcolor1', 'white');" . "\n";
               echo "meuGraficoIdades.Set('chart.background.barcolor2', 'white');" . "\n";
               echo "meuGraficoIdades.Set('chart.title', 'Como gerar gráficos com PHP');" . "\n";
               echo "meuGraficoIdades.Set('chart.title.vpos', 0.6);" . "\n";
               echo "meuGraficoIdades.Set('chart.labels', [";
               $i=0;
               while ($i <= $aux-1){
                    if ($i == $aux-1){
                         echo "'". $nome[$i] . "'";
                    }
                    else{
                         echo "'". $nome[$i] . "', ";
                    }
                    $i++;
               }
               echo "]);\n";
               echo "  meuGraficoIdades.Set('chart.tooltips', [";
               $i=0;
               while ($i <= $aux-1){
                    if ($i == $aux-1){
                         echo "'$nome[$i] tem ' + idade$i + ' anos'";
                    }
                    else{
                         echo "'$nome[$i] tem ' + idade$i + ' anos', ";
                    }
                    $i++;
               }
               echo "]);\n";
               echo "meuGraficoIdades.Set('chart.text.angle', 45);" . "\n";
               echo "meuGraficoIdades.Set('chart.gutter', 35);" . "\n";
               echo "meuGraficoIdades.Set('chart.shadow', true);" . "\n";
               echo "meuGraficoIdades.Set('chart.shadow.blur', 5);" . "\n";
               echo "meuGraficoIdades.Set('chart.shadow.color', '#aaa');" . "\n";
               echo "meuGraficoIdades.Set('chart.shadow.offsety', -3);" . "\n";
               echo "meuGraficoIdades.Set('chart.colors', ['#00CED1']);" . "\n";
               echo "meuGraficoIdades.Set('chart.key.position', 'gutter');" . "\n";
               echo "meuGraficoIdades.Set('chart.text.size', 10);" . "\n";
               echo "meuGraficoIdades.Set('chart.text.font', 'Georgia');" . "\n";
               echo "meuGraficoIdades.Set('chart.text.angle', 0);" . "\n";
               echo "meuGraficoIdades.Set('chart.grouping', 'stacked');" . "\n";
               echo "meuGraficoIdades.Set('chart.strokecolor', 'rgba(0,0,0,0)');" . "\n";
               echo "meuGraficoIdades.Draw();" . "\n";
               echo "}" . "\n";
               echo "</script>";
          ?>
     </head>
     <body>
          <div id="conteudo">
               <h1>Criar relatório com PHP</h1>
               <div class="borda"></div>
               <div style="width: 750px;">
                    <canvas id="meuCanvasGraficoIdades" width="700" height="350">[No canvas support]</canvas>
               </div>
               <div class="borda"></div>
               <div class="clear"></div>
			   <div class="DconteudoTextoFora">
               <div class="DconteudoTextDentro">Nome</div>
               <div class="DconteudoTextDentro">Email</div>
               <div class="DconteudoTextDentro">Idade</div>
			   </div>
               <div class="clear"></div>
			   <div class="dconteudoListaFora">
               <?php
                    $sql1=mysqli_query($suaConexao, "Select * from usuario order by idade_tblusuario");
                    while ($resulta=mysqli_fetch_array($sql1)){
               ?>
                         <div class="dconteudoListaDentro"><?php echo $resulta['nome_tblusuario']; ?></div>
                         <div class="dconteudoListaDentro"><?php echo $resulta['email_tblusuario']; ?></div>
                         <div class="dconteudoListaDentro"><?php echo $resulta['idade_tblusuario']; ?></div>
                         <div class="clear"></div>
               <?php } ?>
			   </div>
          </div>
     </body>
</html>
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
               $sqlbandas=mysqli_query($suaConexao, "Select * from bandas");
               $i = 1;
               while($result = mysqli_fetch_array($sqlbandas)){
                    $bandas[$i] = $result['nome_bandas'];
                    $idbanda[$i]= $result['id_bandas'];
                    $sqldiscos=mysqli_query($suaConexao, "Select * from discos WHERE id_bandas = $i" );	
                    $result=mysqli_fetch_array($sqldiscos);
                    $qte[$i]=mysqli_num_rows($sqldiscos);
                    $i++;
               }
               $aux=$i;
               $i=1;
               $dadosBandas="";
               while ($i <= $aux-1){
                    if ($i == $aux-1){
                         $dadosBandas = $dadosBandas . $qte[$i] ;
                    }
                    else{
                         $dadosBandas = $dadosBandas . $qte[$i] . ",";
                    }
                    $i++;
               }
               $dadosBandas = join(",", array($dadosBandas));
               $dadosBandas = "[$dadosBandas]";
               echo "<script>" . "\n";
               echo "var dadosBandas = $dadosBandas" . ";\n";
               $i=1;
               while ($i <= $aux-1){
                    echo "var banda$i = $qte[$i]; \n";
                    $i++;
               }
               echo "</script>" . "\n";
               echo "<script>" . "\n";
               echo "	 window.onload = function ()" . "\n";
               echo " {" . "\n";
               echo " var meuGraficobandas = new RGraph.Bar('meuCanvasGraficobandas', dadosBandas);" . "\n";
               echo " meuGraficobandas.Set('chart.background.barcolor1', 'white');" . "\n";
               echo " meuGraficobandas.Set('chart.background.barcolor2', 'white');" . "\n";
               echo " meuGraficobandas.Set('chart.title', 'Como gerar gráficos com PHP');" . "\n";
               echo " meuGraficobandas.Set('chart.title.vpos', 0.6);" . "\n";
               echo " meuGraficobandas.Set('chart.labels', [";
               $i=1;
               while ($i <= $aux-1){
                    if ($i == $aux-1){
                         echo "'". $bandas[$i] . "'";
                    }
                    else{
                         echo "'". $bandas[$i] . "', ";
                    }
                    $i++;
               }
               echo "]);\n";
               echo " meuGraficobandas.Set('chart.tooltips', [";
               $i=1;
               while ($i <= $aux-1){
                    if ($i == $aux-1){
                         echo "'$bandas[$i] tem ' + banda$i + ' discos'";
                    }
                    else{
                         echo "'$bandas[$i] tem ' + banda$i + ' discos', ";
                    }
                    $i++;
               }
               echo "]);\n";
               echo " meuGraficobandas.Set('chart.text.angle', 45);" . "\n";
               echo " meuGraficobandas.Set('chart.gutter', 35);" . "\n";
               echo " meuGraficobandas.Set('chart.shadow', true);" . "\n";
               echo " meuGraficobandas.Set('chart.shadow.blur', 5);" . "\n";
               echo " meuGraficobandas.Set('chart.shadow.color', '#aaa');" . "\n";
               echo " meuGraficobandas.Set('chart.shadow.offsety', -3);" . "\n";
               echo " meuGraficobandas.Set('chart.colors', ['#00CED1']);" . "\n";
               echo " meuGraficobandas.Set('chart.key.position', 'gutter');" . "\n";
               echo " meuGraficobandas.Set('chart.text.size', 10);" . "\n";
               echo " meuGraficobandas.Set('chart.text.font', 'Georgia');" . "\n";
               echo " meuGraficobandas.Set('chart.text.angle', 0);" . "\n";
               echo " meuGraficobandas.Set('chart.grouping', 'stacked');" . "\n";
               echo " meuGraficobandas.Set('chart.strokecolor', 'rgba(0,0,0,0)');" . "\n";
               echo " meuGraficobandas.Draw();" . "\n";
               echo " }" . "\n";
               echo " </script>";
          ?>
     </head>
     <body>
          <div id="conteudo">
               <h1>Criar relatório com PHP</h1>
               <div class="borda"></div>
               <div style="width: 450px;">
                    <canvas id="meuCanvasGraficobandas" width="700" height="350">[No canvas support]</canvas>
               </div>
               <div class="clear"></div>
               <?php
                    $sqlbandas=mysqli_query($suaConexao, "Select * from bandas");
                    while ($resulta=mysqli_fetch_array($sqlbandas)){
               ?>
                         <h1><?php echo $resulta['nome_bandas']; ?></h1>
                         <div class="borda"></div>
						 <div class="dconteudoListaFora">
						 
                    <?php
					     
                         $sqldiscos=mysqli_query($suaConexao, "Select * from discos WHERE id_bandas = " . $resulta['id_bandas']);
                         while ($resultdiscos=mysqli_fetch_array($sqldiscos)){
                    ?>
                              <div class="dconteudoListaDentro"><span class="qtde"><?php echo $resultdiscos['titulo_tbl_discos']; ?></span><br/>
                                   <img  width="230px" height="250px" src="<?php echo $resultdiscos['capa_tbl_discos']; ?>">
                              </div>
                    <?php } ?>
                    <div class="clear"></div>
                    <?php 
                         }
                    ?>
				
               </div>
			   </div>
     </body>
</html>
<?php
include 'C:\wamp\mpdf\mpdf.php';

$saida="<html>";
$saida.="<head>";
$saida.="<link href=\"css/style.css\" rel=\"stylesheet\" />";
$saida.="</head>";
$saida.="<body>";
$saida.="<div id=\"conteudo\">";
$saida.="<h1>Meu primeiro PDF</h1>";

$saida.= "<li>PHP</li>";
$saida.=  "<li>HTML</li>";
$saida.=  "<li>PDF</li>";
$saida.="</ul>";
$saida.= "</body>";
$saida.="</html>";
$arquivo="Exemplo.pdf";

$mpdf=new mPDF();
$mpdf->WriteHTML($saida);
$mpdf->Output($arquivo,'F');
echo "PDF GERADO COM SUCESSO";
?>
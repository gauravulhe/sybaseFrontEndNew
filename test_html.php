<?php
$html = file_get_contents("valid.html");
require_once("html2pdf.class.php");
$html2pdf = new HTML2PDF("P", "A4", "en", array(10, 10, 10, 10));
$html2pdf->setEncoding("ISO-8859-1");
$html2pdf->WriteHTML($html);
$html2pdf->Output("pdf/PDF.pdf", "F"); //output to file
$html2pdf->Output(); //output to browser
?>
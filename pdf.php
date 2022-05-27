<?php

//Con esto lo que haremos será imprimir de la ruta de producto.php el producto que queramos y cambiaremos el valor en el id

use Dompdf\Dompdf;

include_once "dompdf/autoload.inc.php";
$pdf=new Dompdf();
$html=file_get_contents("http://192.168.1.50/prueba/producto.php?id=2");
$pdf->loadHtml($html);
$pdf->setPaper("A4","landingpage");
$pdf->render();
$pdf->stream();

?>
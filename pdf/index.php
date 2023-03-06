<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('logo.png',10,8,20);
    // Arial bold 15
    $this->SetFont('Arial','B',18);
    // Movernos a la derecha
    $this->Cell(75);
    // Título
    $this->Cell(35,10,'Licitaciones',0,0,'C');
    // Salto de línea
    $this->Ln(20);

    $this->Cell(20, 20, 'Id', 1, 0,'C', 0);
    $this->Cell(75, 20, utf8_decode('Licitación'), 1, 0,'C', 0);
    $this->Cell(95, 20, utf8_decode('Descripción'), 1, 1,'C', 0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

//Con esta consulta lo que haremos sera mostrar por pantalla el id, nombre y descripción de la licitación
//siempre y cuando la licitación este disponible y no haya sido subastada
require 'cn.php';
$consulta = "SELECT p.id_producto, p.nombre, p.descripcion
FROM producto p
JOIN subasta s ON p.id_producto = s.id_producto
WHERE s.estado = 0
";
$resultado = $mysqli ->query($consulta);


$pdf = new PDF();
$pdf -> AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',9);

//Con esto mostramos por pantalla el id, el nombre y la descripción 
while($row = $resultado->fetch_assoc()){
    $pdf->Cell(20, 20, $row['id_producto'], 1, 0,'C', 0);
    $pdf->Cell(75, 20, utf8_decode($row['nombre']), 1, 0,'C', 0);
    $pdf->Cell(95, 20, utf8_decode($row['descripcion']), 1, 1,'C', 0);
}

$pdf->Output();
?>
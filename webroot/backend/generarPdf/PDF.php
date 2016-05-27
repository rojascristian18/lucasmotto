<?php
require('tfpdf.php');

class PDF extends tFPDF{

// Cabecera de página
function Header()
{   
    //Fuentes
    $this->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
    $this->AddFont('DejaVu Bold','','DejaVuSansCondensed-Bold.ttf',true);

    // Logo
    $this->Image('backend/generarPdf/logo.jpg',5,10,50);
    // Arial bold 15
    $this->SetFont('DejaVu Bold','',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,35,'Información de la solicitud',0,0,'C');
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('DejaVu Bold','',8);
    // Mensaje de página
    $this->Cell(0,10,'Lucasmotto.cl',0,0,'C');
    // Número de página
    $this->SetFont('DejaVu','',6);
    $this->Cell(0,20,'Página '.$this->PageNo().'/{nb}',0,0,'C');
}
}
?>
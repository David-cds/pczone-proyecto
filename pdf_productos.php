<?php

require('fpdf186/fpdf.php');
include("includes/conexion.php");

class PDF extends FPDF{

    function Header(){

        $this->SetFont('Arial','B',16);

        $this->Cell(0,10,'Listado de Productos PCZone',0,1,'C');

        $this->Ln(5);

        // Cabecera tabla
        $this->SetFillColor(0,168,255);
        $this->SetTextColor(255);

        $this->Cell(15,10,'ID',1,0,'C',true);
        $this->Cell(70,10,'Nombre',1,0,'C',true);
        $this->Cell(30,10,'Precio',1,0,'C',true);
        $this->Cell(25,10,'Stock',1,0,'C',true);
        $this->Cell(40,10,'Categoria',1,1,'C',true);

        $this->SetTextColor(0);
    }

    function Footer(){

        $this->SetY(-15);

        $this->SetFont('Arial','I',8);

        $this->Cell(
            0,
            10,
            'Pagina '.$this->PageNo(),
            0,
            0,
            'C'
        );
    }
}

$pdf = new PDF();

$pdf->AddPage();

$pdf->SetFont('Arial','',11);

$sql = "SELECT productos.*,
categorias.nombre AS categoria

FROM productos

INNER JOIN categorias
ON productos.categoria_id = categorias.id";

$query = $conexion->prepare($sql);

$query->execute();

$productos = $query->fetchAll(PDO::FETCH_ASSOC);

foreach($productos as $producto){

    $pdf->Cell(15,8,$producto["id"],1);

    $pdf->Cell(
        70,
        8,
        utf8_decode($producto["nombre"]),
        1
    );

    $pdf->Cell(
        30,
        8,
        $producto["precio"]." EUR",
        1
    );

    $pdf->Cell(
        25,
        8,
        $producto["stock"],
        1
    );

    $pdf->Cell(
        40,
        8,
        utf8_decode($producto["categoria"]),
        1
    );

    $pdf->Ln();
}

$pdf->Output();
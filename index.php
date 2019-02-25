<?php
error_reporting(0);
ini_set('display_errors', 0);

require_once "db.php";
require_once "fpdf.php";

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image("troll.png",10,6,30);
        // Line break
        $this->Ln(10);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,1,'Generiert am  '. date('d.m.Y - H:i:s'),0,0,'C');
        $this->Ln(10);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        // $this->Cell(80);
        // Title
        $this->Cell(0,10,utf8_decode('Einführung in die Betriebswirtschaftslehre - Fragenkatalog'),1,0,'C');
        // Line break
        $this->Ln(10);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,5,utf8_decode('Die Fragen werden unterschiedlich bewertet.'),1,0,'C');
        $this->Ln(20);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Seite '.$this->PageNo().'/{nb}',0,0,'C');
    }
}
$stmt = $mysqli->prepare("SELECT frage FROM bwl ORDER BY RAND() LIMIT 20");
$stmt->execute();

$stmt->store_result();
$stmt->bind_result($frage);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',13);
$n = 1;

while($stmt->fetch()) {
  $txt = $n.". " . utf8_decode($frage);
  $pdf->MultiCell(0, 10, $txt, 0);
  ++$n;
}

$pdf->Output();
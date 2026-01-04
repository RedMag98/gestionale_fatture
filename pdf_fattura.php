<?php
include "auth.php";
include "connessione.php";
require_once('tcpdf/tcpdf.php');

$id = $_GET['id'];


$sql = "SELECT fatture.*, clienti.nome, clienti.partita_iva, clienti.email 
        FROM fatture 
        JOIN clienti ON fatture.cliente_id = clienti.id
        WHERE fatture.id='$id'";
$result = $conn->query($sql);
$f = $result->fetch_assoc();


$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Fattura '.$f['numero_fattura']);
$pdf->SetMargins(20, 20, 20);
$pdf->SetAutoPageBreak(TRUE, 20);
$pdf->AddPage();


$pdf->SetFont('helvetica', 'B', 18);
$pdf->Cell(0, 12, 'FATTURA', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 12);
$pdf->Ln(4);


$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.4);
$pdf->Line(20, 38, 190, 38);
$pdf->Ln(6);


$pdf->SetFont('helvetica', 'B', 11);
$pdf->Cell(0, 6, 'DATI CLIENTE', 0, 1);

$pdf->SetFont('helvetica', '', 11);
$pdf->Cell(95, 6, 'Cliente: '.$f['nome'], 0, 0);
$pdf->Cell(95, 6, 'Fattura N.: '.$f['numero_fattura'], 0, 1);
$pdf->Cell(95, 6, 'P.IVA: '.$f['partita_iva'], 0, 0);
$pdf->Cell(95, 6, 'Data: '.$f['data'], 0, 1);
$pdf->Cell(95, 6, 'Email: '.$f['email'], 0, 1);

$pdf->Ln(6);


$pdf->SetFont('helvetica', 'B', 11);
$pdf->SetFillColor(230, 230, 230);

$pdf->Cell(40, 8, "Descrizione", 1, 0, 'C', 1);
$pdf->Cell(25, 8, "Qtà", 1, 0, 'C', 1);
$pdf->Cell(30, 8, "Prezzo Unit.", 1, 0, 'C', 1);
$pdf->Cell(20, 8, "IVA", 1, 0, 'C', 1);
$pdf->Cell(30, 8, "Importo", 1, 1, 'C', 1);

$pdf->SetFont('helvetica', '', 11);


$pdf->Cell(40, 8, $f['descrizione'], 1);
$pdf->Cell(25, 8, $f['quantita'], 1, 0, 'C');
$pdf->Cell(30, 8, number_format($f['prezzo_unitario'],2).' €', 1, 0, 'R');
$pdf->Cell(20, 8, $f['iva'].' %', 1, 0, 'C');
$pdf->Cell(30, 8, number_format($f['importo'],2).' €', 1, 1, 'R');

$pdf->Ln(8);


$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(115, 8, '', 0);
$pdf->Cell(40, 8, 'Totale senza IVA:', 1, 0, 'R', 1);
$pdf->Cell(30, 8, number_format($f['importo'], 2).' €', 1, 1, 'R', 1);  

$pdf->Ln(4);


$pdf->Cell(115, 8, '', 0);
$pdf->Cell(40, 8, 'TOTALE:', 1, 0, 'R', 1);
$pdf->Cell(30, 8, number_format($f['totale'],2).' €', 1, 1, 'R', 1);

$pdf->Ln(10);


$pdf->SetFont('helvetica', 'B', 11);
$pdf->Cell(0, 6, 'MODALITÀ DI PAGAMENTO', 0, 1);

$pdf->SetFont('helvetica', '', 11);
$pdf->Cell(0, 6, $f['modalita_pagamento'], 0, 1);

$pdf->Output('Fattura_'.$f['numero_fattura'].'.pdf', 'I');
?>

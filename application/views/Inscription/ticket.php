<?php
$pdf = new CI_FPDF('L','mm','A3');
$pdf->AddPage();
    // Police Arial gras 15
    $pdf->SetFont('Times','B',15);
    // Décalage à droite
    $pdf->Cell(90);
    // Titre
    $pdf->Cell(230,10,iconv("UTF-8", "ISO-8859-1", "Planche de ticket pour l'équipe"));
    // Saut de ligne
    $pdf->Ln(15);
		$pdf->SetFont('Times','B',12);
		$pdf->Cell(50);
		$pdf->Cell(50);
		$pdf->Ln(15);
		$pdf->SetFont('Times','B',7);
		$pdf->Cell(24,15,iconv("UTF-8", "ISO-8859-1", "Situation obligatoire"),1,0,'C');
		$pdf->MultiCell(35,8,iconv("UTF-8", "ISO-8859-1", "Situation professionnelle (intitulé et liste des documents et productions associés)"),0,'C');
		$pdf->Ln(-24);
		$pdf->Cell(60);
		$pdf->cell(90,15,iconv("UTF-8", "ISO-8859-1", "P1 Production de services"),1,0,'C');
		$pdf->cell(42,15,iconv("UTF-8", "ISO-8859-1", "P2 Fourniture de services"),1,0,'C');
		$pdf->cell(66,15,iconv("UTF-8", "ISO-8859-1", "P3 Conception et maintenance de solutions d'infrastructure"),1,0,'C');
		$pdf->cell(24,15,iconv("UTF-8", "ISO-8859-1", "P4"),1,0,'C');
		$pdf->cell(60,15,iconv("UTF-8", "ISO-8859-1", "P5 Gestion de patrimoine informatique"),1,0,'C');
		$pdf->Ln(15);
		$pdf->cell(6,75,"",1,0,'C');
		$pdf->cell(6,75,"",1,0,'C');
		$pdf->cell(6,75,"",1,0,'C');
		$pdf->cell(6,75,"",1,0,'C');
		$pdf->TourneTexte(90,13,128,iconv("UTF-8", "ISO-8859-1","Production d'une solution logicielle et d'infrastructure"));
		$pdf->TourneTexte(90,19,128,iconv("UTF-8", "ISO-8859-1","Prise en charge d'incidents et de demandes d'assistance"));
		$pdf->TourneTexte(90,25,128,iconv("UTF-8", "ISO-8859-1","Élaboration de documents relatifs à la production"));
		$pdf->TourneTexte(90,31,128,iconv("UTF-8", "ISO-8859-1","Mise en place d'un dispositif de veille technologique"));
    $i = 75;
      $pdf->Cell(36);
		$pdf->Output();
?>

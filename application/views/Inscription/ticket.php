<?php
$pdf = new CI_FPDF('L','mm','A3');
$NOEQUIPE = null;
$i = 0;
$x = 30;
$y = 55;
$j = 0;
$numéroTicket = 0;

foreach ($LesEquipes as $UneEquipe) {
	if ($UneEquipe['NOEQUIPE'] !=$NOEQUIPE) {
		$NOEQUIPE == $UneEquipe['NOEQUIPE'];
		$i = 0;
		$x = 30;
		$y = 55;
		$j = 0;
		$pdf->AddPage();
		$pdf->SetFont('Times','B',20);
		$pdf->Cell(140);
		$pdf->Cell(230,10,iconv("UTF-8", "ISO-8859-1", "Planche de ticket pour l'équipe \"".$UneEquipe['NOMEQUIPE']."\""));
		$pdf->Ln(15);
	}
		$NOEQUIPE = $UneEquipe['NOEQUIPE'];
		$numéroTicket++;
		$i++;
		$pdf->SetFont('Times','B',15);
		if ($UneEquipe['REPASSURPLACE'] == 1) {
			$REPAS = 'REPAS SUR PLACE';
		}
		else {
			$REPAS = 'PAS DE REPAS';
		}
		$pdf->TourneTexte(0,$x-15,$y-20,iconv("UTF-8", "ISO-8859-1",$numéroTicket));
		$pdf->cell(95,75,iconv("UTF-8", "ISO-8859-1",$UneEquipe['NOM']." ".$UneEquipe['PRENOM']." ".$UneEquipe['DATEDENAISSANCE']),1,0,'C');
		$pdf->TourneTexte(0,$x,$y-10,iconv("UTF-8", "ISO-8859-1",'TICKET PERSONNEL'));
		$pdf->TourneTexte(0,$x,$y,iconv("UTF-8", "ISO-8859-1",$REPAS));
		$CHEMINIMAGEAFFICHETTE = $this->session->AnneeEnCours['CHEMINIMAGEAFFICHETTE'];
		$cheminImage = img_url($CHEMINIMAGEAFFICHETTE);
		$pdf->Image($cheminImage,$x,$y+15,50,20);
		$pdf->Cell(3);
		$x += 100;
		if ($i == ($j+4)) {
			$j ==$i;
			$y += 78;
			$x = 30;
			$pdf->Ln(80);
		}
}
		$pdf->Output();
?>

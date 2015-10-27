<?php
class TaxaView extends RelatorioController {

	function Dados($corretor) {

		$this->setFillColor(200);
		$this->setFont('Arial', 'B', 9);

		$this->Cell(95, 5, "Corretor: ".$corretor->codigo_interno, 'TL', 0, "L", 0);
		$this->Cell(95, 5, "Periodo: ".Input::get('periodo'), 'TR', 0, "L", 0);
		$this->Ln();
		$this->Cell(95, 5, "Nome: ".$corretor->nome, "BL", 0, "L", 0);
		$this->Cell(95, 5, "", "BR", 0, "L", 0);
		$this->Ln(8);
		
	}

}

$pdf = new TaxaView();
$pdf->AddPage();
$pdf->Dados($corretor);
$pdf->Output();

exit;

?>
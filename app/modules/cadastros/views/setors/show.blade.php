<?php

Class Rel extends Fpdf {

	function Header() {
		$this->SetFont('Arial', 'B', 16);
		$this->SetFillColor(200);
		$this->image(public_path().'/img/logo.png', 11, 11, 25, 11);
		$this->Cell(190, 8, 'Frizelo Frigorificos Ltda', 'LTR', 0, 'C');
		$this->SetFont('Arial', '', 7);
		$this->Ln();
		$this->Cell(190, 5, 'ROD. BR-262 - KM 375, ZONA SUBURBANA, TERENOS-MS FONE: (67) - 3246-8100', 'BLR', 0, 'C', 0);
		$this->Ln();

	}

	function Dados($setor) {
		$this->SetFillColor(200);
		$this->SetFont('Arial', '', 10);
		$this->Cell(190, 5, utf8_decode($setor->descricao), 1, 'L', 'L', 1);
		$this->Ln();
		$id = 1;

		foreach ($setor->postoTrabalhos as $posto) {
			$this->SetFont('Arial', '', 8);
			$this->Cell(70, 4, $id.' - '.utf8_decode($posto->descricao), 0, 0, 'L', 0);
			$this->SetFont('Times', '', 6);
			$this->MultiCell(120, 4, utf8_decode(implode($posto->atividades->lists('descricao'), '/ ')), 'B', 'L', 0);
			$this->Ln();
			$id = $id+1;
		}
	}

	function footer() {

		$this->SetY(-15);
		$this->SetFont("Arial", "I", 8);
		$this->SetDrawColor(200);
		$this->Cell(0, 4, utf8_decode("Página ").$this->PageNo()." - Processado em: ".date('d/m/Y h:i'), 0, 0, "C");
	}
}

$fpdf = new Rel();
$fpdf->AddPage();
$fpdf->Dados($setor);
$fpdf->Output();
exit;

?>

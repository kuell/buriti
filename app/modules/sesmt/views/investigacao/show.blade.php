<?php
Class ColaboradorReport extends Fpdf {

	public function Header() {
		$this->SetFont('Arial', 'B', 16);
		$this->SetFillColor(200);
		$this->image(public_path().'/img/logo.png', 11, 11, 25, 11);
		$this->Cell(140, 8, 'Frizelo Frigorificos Ltda', 'LTR', 0, 'C');
		$this->SetFont('Arial', '', 9);
		$this->MultiCell(50, 8, utf8_decode('Matrícula: '), 'TR', 1);
		$this->SetFont('Arial', '', 6);
		$this->Cell(140, 5, 'ROD. BR-262 - KM 375, ZONA SUBURBANA, TERENOS-MS FONE: (67) - 3246-8100', 'BLR', 0, 'C', 0);
		$this->SetFont('Arial', '', 9);
		$this->MultiCell(50, 5, utf8_decode('Situação: '), 'BR', 1);
		$this->Ln();
		$this->Cell(145, 6, utf8_decode('Nome: '), 'BRLT', 0);
		$this->Cell(45, 6, utf8_decode('Admissão: '), 'LTBR', 0);
		$this->Ln();
		$this->Cell(30, 6, utf8_decode('Sexo: '), 'BRLT', 0);
		$this->Cell(45, 6, utf8_decode('Data Nascimento: '), 'BRLT', 0);
		$this->Cell(115, 6, utf8_decode('Setor: '), 'LTBR', 0);
		$this->Ln();
		$this->Cell(70, 6, utf8_decode('Função: '), 'BRLT', 0);
		$this->Cell(120, 6, utf8_decode('Posto de Trabalho: '), 'BRLT', 0);
		$this->Ln(7);

	}

	public function Dados($ocorrencia) {

	}

}

$fpdf = new ColaboradorReport();
$fpdf->AddPage();
$fpdf->Dados($ocorrencia);
$fpdf->Output();
exit;

?>
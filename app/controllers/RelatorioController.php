<?php

/**
 *
 */
class RelatorioController extends Fpdf {

	public function Header() {
		$this->SetFont('Arial', 'B', 16);
		$this->SetFillColor(200);
		$this->image(public_path().'/img/logo.png', 11, 11, 25, 11);
		$this->Cell(190, 8, 'Frizelo Frigorificos Ltda', 'LTR', 0, 'C');
		$this->Ln();
		$this->SetFont('Arial', '', 6);
		$this->Cell(190, 5, 'ROD. BR-262 - KM 375, ZONA SUBURBANA, TERENOS-MS FONE: (67) - 3246-8100', 'BLR', 0, 'C', 0);
		$this->SetFont('Arial', '', 9);
		$this->Ln(7);

	}

	public function Footer() {
		$this->SetY(-15);
		$this->SetFont("Arial", "I", 8);
		$this->SetDrawColor(200);
		$this->Cell(0, 4, utf8_decode("Página ").$this->PageNo()."Processado em ".date('d-m-Y h:i'), 0, 0, "C");
	}

}
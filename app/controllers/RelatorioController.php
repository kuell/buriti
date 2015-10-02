<?php

/**
 *
 */
class RelatorioController extends Fpdf {

	public $tituloDoc = '';
	public $angle     = 0;

	public function Header() {
		$this->SetFont('Arial', 'B', 16);
		$this->SetFillColor(200);
		$this->image(public_path().'/img/logo.png', 11, 11, 25, 11);
		$this->Cell(0, 8, 'Frizelo Frigorificos Ltda', 'LTR', 0, 'C');
		$this->Ln();
		$this->SetFont('Arial', '', 6);
		$this->Cell(0, 5, 'ROD. BR-262 - KM 375, ZONA SUBURBANA, TERENOS-MS FONE: (67) - 3246-8100', 'BLR', 0, 'C', 0);
		$this->SetFont('Arial', '', 9);
		$this->Ln(7);
		if ($this->tituloDoc != '') {
			$this->Cell(0, 5, utf8_decode($this->tituloDoc), 'BLTR', 0, 'C', 0);
			$this->Ln();
		}

	}

	public function Footer() {
		$this->SetY(-15);
		$this->SetFont("Arial", "I", 6);
		$this->SetDrawColor(200);
		$this->Cell(0, 4, utf8_decode("Página ").$this->PageNo()." | Processado em ".date('d/m/Y H:i').' | Usuario: '.strtoupper(Auth::user()->user), 0, 0, "C");
	}

	// Rotação de Celulas
	function Rotate($angle, $x = -1, $y = -1) {
		$this->SetAutoPageBreak(false);

		if ($x == -1) {
			$x = $this->x;
		}

		if ($y == -1) {
			$y = $this->y;
		}

		if ($this->angle != 0) {
			$this->_out('Q');
		}

		$this->angle = $angle;
		if ($angle != 0) {
			$angle *= M_PI/180;
			$c  = cos($angle);
			$s  = sin($angle);
			$cx = $x*$this->k;
			$cy = ($this->h-$y)*$this->k;
			$this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm', $c, $s, -$s, $c, $cx, $cy, -$cx, -$cy));
		}
	}

	function _endpage() {
		if ($this->angle != 0) {
			$this->angle = 0;
			$this->_out('Q');
		}
		parent::_endpage();
	}

	function CellRotatedText($x, $y, $txt, $angle) {
		//Text rotated around its origin
		$this->Rotate($angle, $x, $y);
		$this->Text($x, $y, $txt);
		$this->Rotate(0);
	}

	function CellRotatedImage($file, $x, $y, $w, $h, $angle) {
		//Image rotated around its upper-left corner
		$this->Rotate($angle, $x, $y);
		$this->Image($file, $x, $y, $w, $h);
		$this->Rotate(0);
	}

	//Fim Rotação de Celulas

}
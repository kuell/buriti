<?php
class BalancoFiscalView extends RelatorioController {

	function Dados() {
		$this->AddPage();

		$w = [95, 41, 25];
		$this->SetFillColor(0);
		$this->SetTextColor(250);

		$this->Cell($w[0], 6, utf8_decode('Corretor'), 1, 0,  'L', 1);
		$this->Cell($w[1], 6, utf8_decode('Romaneio de Expedição'), 1, 0,  'L', 1);
		$this->Cell($w[1], 6, utf8_decode('Romaneio Fiscal'), 1, 0,  'L', 1);
		$this->Cell($w[2], 6, utf8_decode('ICMS'), 1, 0,  'L', 1);
		$this->Cell($w[2], 6, utf8_decode('Pauta Fiscal'), 1, 0,  'L', 1);
		$this->Cell($w[2], 6, utf8_decode('Saldo (KG)'), 1, 0,  'L', 1);
		$this->Cell($w[2], 6, utf8_decode('Corte (%)'), 1, 0,  'L', 1);
		$this->Ln();

		$this->SetFont('Arial', '', 8);
		$this->SetFillColor('220');
		$this->SetTextColor(0);
		$this->SetDrawColor(150);
		$fill = 0;

		$romaneio = 0;
		$fiscal = 0;
		$valor_fiscal = 0;

		foreach (Corretor::all() as $corretor) {

			$this->Cell($w[0], 6, utf8_decode($corretor->codigo_interno.' - '.$corretor->nome), 1, 0,  'L', $fill);
			$this->Cell($w[1], 6, Format::valorView($corretor->peso_romaneio, 2), 1, 0,  'R', $fill);
			$this->Cell($w[1], 6, Format::valorView($corretor->peso_fiscal, 2), 1, 0,  'R', $fill);
			$this->Cell($w[2], 6, 'R$ '.Format::valorView($corretor->icms, 2), 1, 0,  'R', $fill);
			$this->Cell($w[2], 6, Format::valorView($corretor->pauta_fiscal, 2), 1, 0,  'R', $fill);
			$this->Cell($w[2], 6, Format::valorView($corretor->peso_fiscal - $corretor->peso_romaneio, 2), 1, 0,  'R', $fill);
			$this->Cell($w[2], 6, Format::valorView($corretor->corte , 2).' %', 1, 0,  'R', $fill);
			$this->Ln();

			$romaneio = $romaneio + $corretor->peso_romaneio;
			$fiscal = $fiscal + $corretor->peso_fiscal;
			$valor_fiscal = $valor_fiscal + $corretor->icms;

			$fill = !$fill;
		}

		$this->SetFillColor(0);
		$this->SetTextColor(250);

		$this->Cell($w[0], 6, utf8_decode('TOTAIS'), 1, 0,  'L', $fill);
		$this->Cell($w[1], 6, Format::valorView($romaneio, 2), 1, 0,  'R', $fill);
		$this->Cell($w[1], 6, Format::valorView($fiscal, 2), 1, 0,  'R', $fill);
		$this->Cell($w[2], 6, 'R$ '.Format::valorView($valor_fiscal, 2), 1, 0,  'R', $fill);
		$this->Cell($w[2], 6, Format::valorView($valor_fiscal / $fiscal, 2), 1, 0,  'R', $fill);
		$this->Cell($w[2], 6, Format::valorView($fiscal - $romaneio, 2), 1, 0,  'R', $fill);
		$this->Cell($w[2], 6, Format::valorView(($fiscal - $romaneio)/$romaneio * 100 , 2).' %', 1, 0,  'R', $fill);

	}
}

$pdf = new BalancoFiscalView('L');
$pdf->Dados();
$pdf->Output();
exit;
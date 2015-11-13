<?php
class TaxaView extends RelatorioController {

	function Dados($corretor) {

		$totalReceber = 0;
		$totalPagar   = 0;

		$this->setFont('Arial', 'B', 11);

		$this->setFillColor(150);
		$this->Cell(95, 5, "Corretor: ".$corretor->codigo_interno, 'TL', 0, "L", 0);
		$this->Cell(95, 5, "Periodo: ".Input::get('periodo'), 'TR', 0, "L", 0);
		$this->Ln();
		$this->Cell(95, 5, "Nome: ".$corretor->nome, "BL", 0, "L", 0);
		$this->Cell(95, 5, "", "BR", 0, "L", 0);
		$this->Ln(8);

		$taxas = $corretor->getTaxas();
		$this->setFont('Arial', '', 10);

		$totalTaxa = 0 ;

		if (!empty($taxas[0])) {
			$this->Cell(0, 5, '::: TAXAS :::', 1, 0, "C", 1);
			$this->Ln();

			$this->setFillColor(200);

			$this->Cell(100, 5, utf8_decode('DESCRIÇÃO'), 1, 0, "L", 1);
			$this->Cell(30, 5, utf8_decode('QTDE'), 1, 0, "C", 1);
			$this->Cell(30, 5, utf8_decode('PESO'), 1, 0, "C", 1);
			$this->Cell(30, 5, utf8_decode('VALOR'), 1, 0, "C", 1);

			$this->setFont('Arial', '', 10);

			$this->Ln();

			$totalQtd   = 0;
			$totalPeso  = 0;
			$totalValor = 0;

			foreach ($taxas[0] as $item => $taxa) {

				$qtd   = 0;
				$peso  = 0;
				$valor = 0;

				foreach ($taxa as $val) {
					$qtd   = $qtd+$val['qtd'];
					$peso  = $peso+$val['peso'];
					$valor = $valor+$val['valor'];
				}

				$this->Cell(100, 5, $item, 1, 0, "L", 0);
				$this->Cell(30, 5, number_format($qtd, 0, ',', '.'), 1, 0, "C", 0);
				$this->Cell(30, 5, number_format($peso, 2, ',', '.'), 1, 0, "C", 0);
				$this->Cell(30, 5, number_format($valor, 2, ',', '.'), 1, 0, "R", 0);
				$this->Ln();

				$totalQtd   = $qtd+$totalQtd;
				$totalPeso  = $peso+$totalPeso;
				$totalValor = $valor+$totalValor;
			}
	
			$totalTaxa = $totalValor;

			$this->Cell(100, 5, 'TOTAIS', 1, 0, "C", 1);
			$this->Cell(30, 5, number_format($totalQtd, 0, ',', '.'), 1, 0, "C", 1);
			$this->Cell(30, 5, number_format($totalPeso, 2, ',', '.'), 1, 0, "C", 1);
			$this->Cell(30, 5, number_format($totalValor, 2, ',', '.'), 1, 0, "R", 1);
			$this->Ln();
			$this->Ln();

		}
		####### ITEM ########

		$this->setFillColor(150);

		if (!empty($taxas[1])) {

			$this->Cell(0, 5, '::: ITEM :::', 1, 0, "C", 1);
			$this->Ln();

			$totalQtd     = 0;
			$totalPeso    = 0;
			$totalReceber = 0;
			$totalPagar   = 0;

			$this->setFillColor(200);

			$this->Cell(70, 5, utf8_decode('DESCRIÇÃO'), 1, 0, "L", 1);
			$this->Cell(25, 5, utf8_decode('QTDE'), 1, 0, "C", 1);
			$this->Cell(25, 5, utf8_decode('PESO'), 1, 0, "C", 1);
			$this->Cell(35, 5, utf8_decode('RECEBER'), 1, 0, "C", 1);
			$this->Cell(35, 5, utf8_decode('PAGAR'), 1, 0, "C", 1);
			$this->Ln();
			
			$pesoFiscal = 0;

			foreach ($taxas[1] as $item => $taxa) {
								
				$this->setFont('Arial', '', 10);

				$qtd  = 0;
				$peso = 0;

				foreach ($taxa as $key => $val) {
					$qtd  = $qtd+$val['qtd'];
					$peso = $peso+$val['peso'];
					if($val['fiscal'] == 0){
						$pesoFiscal = $peso + $pesoFiscal;
					}
				}
				if(empty($taxa[2]['valor'])){
					$taxa[2]['valor'] = 0;
				}
				if(empty($taxa[1]['valor'])){
					$taxa[1]['valor'] = 0;
				}				
			
				$this->Cell(70, 5, $item, 1, 0, "L", 0);
				$this->Cell(25, 5, number_format($qtd, 0, ',', '.'), 1, 0, "C", 0);
				$this->Cell(25, 5, number_format($peso, 2, ',', '.'), 1, 0, "C", 0);
				
				$this->Cell(35, 5, 'R$ '.number_format($taxa[2]['valor'], 2, ',', '.'), 1, 0, "R", 0);
				$this->Cell(35, 5, 'R$ '.number_format($taxa[1]['valor'], 2, ',', '.'), 1, 0, "R", 0);
				$this->Ln();

				$totalQtd     = $qtd+$totalQtd;
				$totalPeso    = $peso+$totalPeso;
				$totalReceber = $taxa[2]['valor']+$totalReceber;
				$totalPagar   = $taxa[1]['valor']+$totalPagar;

			}

			$this->Cell(70, 5, 'TOTAIS', 1, 0, "C", 1);
			$this->Cell(25, 5, number_format($totalQtd, 0, ',', '.'), 1, 0, "C", 1);
			$this->Cell(25, 5, number_format($totalPeso, 2, ',', '.'), 1, 0, "C", 1);
			$this->Cell(35, 5, 'R$ '.number_format($totalReceber, 2, ',', '.'), 1, 0, "R", 1);
			$this->Cell(35, 5, 'R$ '.number_format($totalPagar, 2, ',', '.'), 1, 0, "R", 1);

			$this->Ln();
			$this->Ln();
		}

		####### ROMANEIO ########

		$this->setFont('Arial', '', 10);
		$this->setFillColor(150);

		if (!empty($taxas[2])) {
			$this->Cell(0, 5, '::: ROMANEIO :::', 1, 0, "C", 1);
			$this->Ln();

			$this->setFillColor(200);

			$this->Cell(100, 5, utf8_decode('DESCRIÇÃO'), 1, 0, "L", 1);
			$this->Cell(30, 5, utf8_decode('QTDE'), 1, 0, "C", 1);
			$this->Cell(30, 5, utf8_decode('PESO'), 1, 0, "C", 1);
			$this->Cell(30, 5, utf8_decode('SALDO'), 1, 0, "C", 1);

			$this->setFont('Arial', '', 10);

			$this->Ln();

			$totalQtd   = 0;
			$totalPeso  = 0;
			$totalValor = 0;

			foreach ($taxas[2] as $item => $taxa) {

				$qtd   = 0;
				$peso  = 0;
				$valor = 0;

				foreach ($taxa as $val) {
					$qtd   = $qtd+$val['qtd'];
					$peso  = $peso+$val['peso'];
					$valor = $valor+$val['valor'];
				}

				$this->Cell(100, 5, $item, 1, 0, "L", 0);
				$this->Cell(30, 5, number_format($qtd, 0, ',', '.'), 1, 0, "C", 0);
				$this->Cell(30, 5, number_format($peso, 2, ',', '.'), 1, 0, "C", 0);
				$this->Cell(30, 5, '-', 1, 0, "R", 0);
				$this->Ln();

				$totalQtd   = $qtd+$totalQtd;
				$totalPeso  = $peso+$totalPeso;
				$totalValor = $valor+$totalValor;
			}

			$this->Cell(100, 5, 'TOTAIS', 1, 0, "C", 1);
			$this->Cell(30, 5, number_format($totalQtd, 0, ',', '.'), 1, 0, "C", 1);
			$this->Cell(30, 5, number_format($totalPeso, 2, ',', '.'), 1, 0, "C", 1);
			$this->Cell(30, 5, number_format($pesoFiscal-$totalPeso, 2, ',', '.'), 1, 0, "R", 1);
			$this->Ln();
			$this->Ln();

		}

		$this->Cell(90, 5, '::: RESUMO :::', 'TB', 0, "C", 1);
		$this->Ln();

		$this->Cell(45, 5, 'TOTAL A RECEBER', 'TB', 0, "L", 0);
		$this->Cell(45, 5, 'R$ '.number_format($totalReceber, 2, ',', '.'), 'TB', 0, "R", 0);
		$this->Ln();

		$this->Cell(45, 5, 'TOTAL A PAGAR', 'TB', 0, "L", 0);
		$this->Cell(45, 5, 'R$ '.number_format($totalPagar+$totalTaxa, 2, ',', '.'), 'TB', 0, "R", 0);
		$this->Ln();

		$this->Cell(45, 5, 'SALDO', 'TB', 0, "L", 1);
		$this->Cell(45, 5, 'R$ '.number_format($totalReceber-($totalPagar+$totalTaxa), 2, ',', '.'), 'TB', 0, "R", 1);
		$this->Ln();

	}

}

$pdf = new TaxaView();
$pdf->AddPage();
$pdf->Dados($corretor);
$pdf->Output();

exit;

?>

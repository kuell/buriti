<?php

/**
 *
 */
class ExamesView extends RelatorioController {
	public function Dados($exames) {

		$this->AddPage();

		if (!empty($exames)) {
			$this->Cell(130, 10, utf8_decode('RESPONSÁVEL: DR PEDRO LUIZ GOMES'), 'TRL', 0, 1);
			$this->Cell(60, 10, utf8_decode('DATA: '.date('d/m/Y')), 'TRL', 0, 1);
			$this->Ln();

			$this->Cell(130, 10, utf8_decode('CRM Nº: 1566 - MÉDICO DO TRABALHO'), 'BRL', 0, 1);
			$this->Cell(60, 10, utf8_decode('ASSINATURA: '), 'RLB', 0, 1);
			$this->Ln();

			$this->setors($exames);
		} else {
			$this->Cell(0, 10, utf8_decode('Nenhuma informação retornada!'), 1, 0, 'C', 0);
		}
	}

	public function setors($exames) {
		$this->SetFillColor(200);

		$total    = 0;
		$alterado = 0;

		foreach ($exames as $setor => $postos) {
			$this->Cell(190, 5, utf8_decode($setor), 1, 0, 'C', 1);
			$this->Ln();

			foreach ($postos as $posto => $descricaos) {

				$this->Cell(50, 4, utf8_decode('Posto de Trabalho'), 1, 0, 'C', 1);
				$this->Cell(80, 4, utf8_decode('Tipo de Exame'), 1, 0, 'C', 1);
				$this->Cell(15, 4, utf8_decode('Total'), 1, 0, 'C', 1);
				$this->Cell(15, 4, utf8_decode('Alterados'), 1, 0, 'C', 1);

				$this->SetFont('Arial', '', 6);
				$this->Cell(21, 4, utf8_decode('Alterados * 100/Total'), 1, 0, 0, 1);

				$this->SetFont('Arial', '', 9);
				$this->Ln();

				$this->Cell(50, 4, utf8_decode($posto), 1, 0);

				$cont = 0;

				foreach ($descricaos as $descricao => $val) {
					if ($cont != 0) {
						$this->Cell(50, 4, '', 0, 0);
						$this->Cell(80, 4, utf8_decode($descricao), 'BL', 0);
						$this->Cell(15, 4, utf8_decode($val['total']), 1, 0);
						$this->Cell(15, 4, utf8_decode($val['alterado']), 1, 0);
						$this->Cell(21, 4, utf8_decode($val['alterado']*100/$val['total']).' %', 1, 0, 'R');
					} else {
						$this->Cell(80, 4, utf8_decode($descricao), 'BLT', 0);
						$this->Cell(15, 4, utf8_decode($val['total']), 1, 0);
						$this->Cell(15, 4, utf8_decode($val['alterado']), 1, 0);
						$this->Cell(21, 4, utf8_decode($val['alterado']*100/$val['total'].' %'), 1, 0, 'R');
					}

					$total    = $total+$val['total'];
					$alterado = $alterado+$val['alterado'];

					$this->Ln();
					$cont++;
				}

				$this->Ln();
			}

			$this->AddPage();
		}

		$this->Cell(190, 7, utf8_decode('Total de Exames'), 1, 0, 'C', 1);
		$this->Ln();

		$this->Cell(80, 7, utf8_decode('Total de Exames Realizados '), 'BLT', 0, 1);
		$this->Cell(40, 7, $total, 1, 0);
		$this->Ln();

		$this->Cell(80, 7, utf8_decode('Total de Exames Realizados - Alterados '), 'BLT', 0, 1);
		$this->Cell(40, 7, $alterado, 1, 0);
		$this->Ln();

		$this->Cell(80, 7, utf8_decode('Alterados * 100 / Total Realizados'), 'BLT', 0, 1, 1);
		$this->Cell(40, 7, number_format($alterado*100/$total, 2, ',', '.').' %', 1, 0, 1, 1);
		$this->Ln();

	}

}

$pdf            = new ExamesView();
$pdf->tituloDoc = 'PROGRAMA DE CONTROLE MÉDICO DE SAÚDE OCUPACIONAL RELATÓRIO ANUAL - '.Request::segment(4);

$pdf->Dados($exames);
$pdf->Output();
exit;

?>
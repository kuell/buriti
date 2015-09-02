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
		foreach ($exames as $setor => $postos) {
			$this->SetFillColor(150);

			$this->Cell(190, 5, utf8_decode($setor), 1, 0, 'C', 1);
			$this->Ln();

			$this->SetFillColor(200);

			$this->Cell(50, 4, utf8_decode('Posto de Trabalho'), 1, 0, 'C', 1);
			$this->Cell(80, 4, utf8_decode('Tipo de Exame'), 1, 0, 'C', 1);
			$this->Cell(15, 4, utf8_decode('Total'), 1, 0, 'C', 1);
			$this->Cell(15, 4, utf8_decode('Alterados'), 1, 0, 'C', 1);

			$this->SetFont('Arial', '', 6);
			$this->Cell(21, 4, utf8_decode('Alterados * 100/Total'), 1, 0, 0, 1);
			$this->Ln();

			foreach ($postos as $posto => $descricaos) {

				$this->SetFillColor(240);
				$this->SetFont('Arial', '', 9);

				$this->Cell(50, 4, utf8_decode($posto), 1, 0, 0, 1);

				$cont = 0;

				foreach ($descricaos as $descricao => $val) {
					if ($cont != 0) {
						$this->Cell(50, 4, '', 0, 0);
						$this->Cell(80, 4, utf8_decode($descricao), 'BL', 0);
						$this->Cell(15, 4, utf8_decode($val['total']), 1, 0);
						$this->Cell(15, 4, utf8_decode($val['alterado']), 1, 0);
						$this->Cell(21, 4, number_format($val['alterado']*100/$val['total'], 2, ',', '.').' %', 1, 0, 'R');
					} else {
						$this->Cell(80, 4, utf8_decode($descricao), 'BLT', 0);
						$this->Cell(15, 4, utf8_decode($val['total']), 1, 0);
						$this->Cell(15, 4, utf8_decode($val['alterado']), 1, 0);
						$this->Cell(21, 4, number_format($val['alterado']*100/$val['total'], 2, ',', '.').' %', 1, 0, 'R');
					}

					if (empty($total[$descricao])) {
						$total[$descricao] = 0;
					}
					if (empty($alterado[$descricao])) {
						$alterado[$descricao] = 0;
					}

					$total[$descricao]    = $total[$descricao]+$val['total'];
					$alterado[$descricao] = $alterado[$descricao]+$val['alterado'];

					$this->Ln();
					$cont++;
				}

				$this->Ln();
			}

			$this->AddPage();
		}

		$this->Cell(190, 7, utf8_decode('Total de Exames Realizados'), 1, 0, 'C', 1);
		$this->Ln();

		$this->Cell(80, 6, utf8_decode('Descrição'), 'BLT', 0, 'C', 1);
		$this->Cell(30, 6, 'Realizados', 'BLT', 0, 'C', 1);
		$this->Cell(30, 6, 'Alterados', 'BLT', 0, 'C', 1);
		$this->Cell(40, 6, 'Alterados*100/Realizados', 1, 0, 'C', 1);
		$this->Ln();

		foreach ($total as $key => $value) {
			$this->Cell(80, 6, utf8_decode($key), 'BLT', 0, 'L');
			$this->Cell(30, 6, $value, 'BLT', 0, 'C');
			$this->Cell(30, 6, $alterado[$key], 'BLT', 0, 'C');
			$this->Cell(40, 6, number_format($alterado[$key]*100/$value, 2, ',', '.').' %', 1, 0, 'C');
			$this->Ln();
		}
	}

}

$pdf            = new OcorrenciasQueixa();
$pdf->tituloDoc = 'PROGRAMA DE CONTROLE MÉDICO DE SAÚDE OCUPACIONAL RELATÓRIO ANUAL - '.Request::segment(4);

$pdf->Dados($exames);
$pdf->Output();
exit;

?>
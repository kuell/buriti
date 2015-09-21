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

	public function footer() {

	}

	public function setors($exames) {
		foreach (Setor::orderBy('descricao')->get() as $setor) {
			if (!empty($setor->postoTrabalhos->count())) {
				$this->SetFillColor(150);

				$this->Cell(190, 5, utf8_decode($setor->descricao), 1, 0, 'C', 1);
				$this->Ln();

				$this->SetFillColor(200);

				$this->Cell(50, 4, utf8_decode('Posto de Trabalho'), 1, 0, 'C', 1);
				$this->Cell(80, 4, utf8_decode('Tipo de Exame'), 1, 0, 'C', 1);
				$this->Cell(15, 4, utf8_decode('Total'), 1, 0, 'C', 1);
				$this->Cell(15, 4, utf8_decode('Alterados'), 1, 0, 'C', 1);

				$this->SetFont('Arial', '', 6);
				$this->Cell(21, 4, utf8_decode('Alterados * 100/Total'), 1, 0, 0, 1);
				$this->Ln();

				foreach ($setor->postoTrabalhos()->orderBy('descricao')->get() as $posto) {
					$aso = Aso::where('colaborador_setor_id', $setor->id)->where('posto_id', $posto->id)->lists('id');

					if (count($posto->asos) && AsoExame::whereIn('relacao_id', $aso)->count() != 0) {

						$this->SetFillColor(240);
						$this->SetFont('Arial', '', 9);
						$this->Cell(50, 4, utf8_decode($posto->descricao), 1, 0, 'L', 1);

						$count = 0;

						foreach (Exame::all() as $exame) {
							$exames   = AsoExame::where('exame_id', $exame->id)->whereIn('relacao_id', $aso)->count();
							$alterado = AsoExame::where('exame_id', $exame->id)
							                                              ->whereIn('relacao_id', $aso)
							                                              ->whereNotIn('resultado', ['normal', 'NÃO REAGENTE', 'NORMAL', 'norm', 'NORMA'])->count();

							if ($exames != 0) {
								if ($count == 0) {
									$this->Cell(80, 4, utf8_decode($exame->descricao), 1, 0, 'L', 0);
									$this->Cell(15, 4, $exames, 1, 0, 'L', 0);
									$this->Cell(15, 4, $alterado, 1, 0, 'L', 0);

									$this->Cell(21, 4, number_format($alterado*100/$exames, 2, ',', '.').' %', 1, 0, 'R', 0);

									$this->Ln();

								} else {
									$this->Cell(50, 4, '', 0, 0, 'L', 0);
									$this->Cell(80, 4, utf8_encode($exame->descricao), 1, 0, 'L', 0);
									$this->Cell(15, 4, $exames, 1, 0, 'L', 0);
									$this->Cell(15, 4, $alterado, 1, 0, 'L', 0);

									$this->Cell(21, 4, number_format($alterado*100/$exames, 2, ',', '.').' %', 1, 0, 'R', 0);

									$this->Ln();
								}
								if (empty($totalExame[$exame->descricao])) {
									$totalExame[$exame->descricao] = 0;
								}
								if (empty($totalAlterados[$exame->descricao])) {
									$totalAlterados[$exame->descricao] = 0;
								}
								$totalExame[$exame->descricao]     = $exames+$totalExame[$exame->descricao];
								$totalAlterados[$exame->descricao] = $alterado+$totalAlterados[$exame->descricao];

								$count = $count+1;
							}
						}

						$this->Ln();
					}
				}

				$this->AddPage();
			}
		}

		$this->Cell(190, 7, utf8_decode('Total de Exames Realizados'), 1, 0, 'C', 1);
		$this->Ln();
		$this->Cell(80, 6, utf8_decode('Descrição'), 'BLT', 0, 'C', 1);
		$this->Cell(30, 6, 'Realizados', 'BLT', 0, 'C', 1);
		$this->Cell(30, 6, 'Alterados', 'BLT', 0, 'C', 1);
		$this->Cell(40, 6, 'Alterados*100/Realizados', 1, 0, 'C', 1);
		$this->Ln();
		foreach ($totalExame as $exame => $valor) {
			$this->Cell(80, 6, utf8_decode($exame), 'BLT', 0, 'L');
			$this->Cell(30, 6, $totalExame[$exame], 'BLT', 0, 'C');
			$this->Cell(30, 6, $totalAlterados[$exame], 'BLT', 0, 'C');
			$this->Cell(40, 6, number_format($totalAlterados[$exame]*100/$totalExame[$exame], 2, ',', '.').' %', 1, 0, 'C');
			$this->Ln();
		}
	}

}

$pdf            = new ExamesView();
$pdf->tituloDoc = 'PROGRAMA DE CONTROLE MÉDICO DE SAÚDE OCUPACIONAL RELATÓRIO ANUAL - '.Request::segment(4);

$pdf->Dados($exames);
$pdf->Output();
exit;

?>
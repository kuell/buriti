<?php

/**
 *
 */
class OcorrenciasQueixaView extends RelatorioController {

	public function footer() {
		return null;
	}

	public function Dados($queixas) {
		$this->setors($queixas);
		$this->postos($queixas);
	}

	public function setors($queixas) {
		$this->AddPage('L', 'A4');
		$this->setFillColor(150);

		$this->Cell(50, 27, utf8_decode('SETORES '), 1, 0, 'C', 1);
		$this->Ln();

		$this->Rotate(90);
		$this->Ln(50);

		$this->setFont('Arial', '', 6);

		$qs = null;

		foreach ($queixas->get() as $queixa) {
			$this->setFillColor(230);
			$this->Cell(27, 5, utf8_decode($queixa->descricao), 1, 0, 'l', 1);
			$qs[] = $queixa;
			$this->Ln();

		}
		$this->Cell(27, 8, utf8_decode('TOTAL DO SETOR'), 1, 0, 'l', 1);

		$linhas = -($queixas->count()*5+50);

		$this->Ln($linhas);

		$this->Rotate(0);

		foreach (Setor::orderBy('descricao')->get() as $setor) {

			$this->setFont('Arial', '', 5);

			$totalQueixaSetor = 0;

			$this->Cell(50, 4, utf8_decode($setor->descricao), 1, 0, 'L', 0);

			foreach ($qs as $q) {
				$totalQueixa = Ocorrencia::where('setor_id', $setor->id)->where('queixa_id', $q->id)->count();
				$this->Cell(5, 4, $totalQueixa, 1, 0, 'C', 0);

				if (empty($totalQueixas[$q->id])) {
					$totalQueixas[$q->id] = 0;
				}
				$totalQueixas[$q->id] = $totalQueixa+$totalQueixas[$q->id];

				$totalQueixaSetor = $totalQueixaSetor+$totalQueixa;
			}

			$this->Cell(8, 4, $totalQueixaSetor, 1, 0, 'C', 1);
			$this->Ln();
		}

		$this->Cell(50, 4, utf8_decode('TOTAL DA QUEIXA'), 1, 0, 'L', 0);

		foreach ($totalQueixas as $total) {
			$this->Cell(5, 4, $total, 1, 0, 'C', 1);
		}
	}

	public function postos($queixas) {
		foreach (Setor::orderBy('descricao')->get() as $setor) {
			if (!empty($setor->postoTrabalhos->count())) {
				$this->AddPage();

				$this->setFillColor(150);
				$this->Cell(0, 5, utf8_decode('SETOR - '.$setor->descricao), 1, 0, 'C', 1);
				//$this->Ln(15);
				$this->Ln();

				$this->setFont('Arial', '', 6);

				$this->Cell(50, 30, 'POSTO DE TRABALHO', 1, 0, 'l', 0);
				$this->Ln();
				//-- Lista de Causas --//

				$this->Rotate(90);
				$this->Ln(50);

				$qs = null;

				foreach ($queixas->get() as $queixa) {
					$this->setFillColor(230);
					$this->Cell(30, 4, utf8_decode($queixa->descricao), 1, 0, 'l', 1);
					$qs[] = $queixa;
					$this->Ln();

				}

				$this->Cell(30, 4, utf8_decode('TOTAL DO POSTO'), 1, 0, 'l', 1);

				$this->Rotate(0);
				$this->SetAutoPageBreak(true, 5);

				$linhas = -($queixas->count()*4+50);
				//-- Fim ista de Causas --//
				$this->Ln($linhas);

				unset($totalQueixas);

				foreach ($setor->postoTrabalhos as $posto) {
					$this->setFillColor(200);
					$this->Cell(50, 4, utf8_decode(substr($posto->descricao, 0, 37)), 1, 0, 'l', 0);
					$totalQueixaPosto = 0;

					foreach ($qs as $q) {
						$totalQueixa = Ocorrencia::where('setor_id', $setor->id)->where('posto_id', $posto->id)->where('queixa_id', $q->id)->count();
						$this->Cell(4, 4, $totalQueixa, 1, 0, 'C', 0);

						if (empty($totalQueixas[$q->id])) {
							$totalQueixas[$q->id] = 0;
						}
						$totalQueixas[$q->id] = $totalQueixa+$totalQueixas[$q->id];

						$totalQueixaPosto = $totalQueixaPosto+$totalQueixa;
					}

					$this->Cell(4, 4, $totalQueixaPosto, 1, 0, 'C', 1);
					$this->Ln();

				}

				$this->Cell(50, 4, utf8_decode('TOTAL DA QUEIXA'), 1, 0, 'l', 1);

				foreach ($totalQueixas as $total) {
					$this->Cell(4, 4, $total, 1, 0, 'C', 1);
				}

				$this->Ln();
			}
		}
	}

}

$pdf            = new OcorrenciasQueixaView('P');
$pdf->tituloDoc = 'LEVANTAMENTO ESTATISTICO DE ATENDIMENTO MÉDICO SESMT';

$pdf->Dados($queixas);
$pdf->Output();
exit;

?>
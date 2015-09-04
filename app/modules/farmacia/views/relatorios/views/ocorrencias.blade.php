<?php

/**
 *
 */
class OcorrenciasQueixaView extends RelatorioController {
	public function Dados($queixas) {
		foreach (Setor::orderBy('descricao')->get() as $setor) {
			if (!empty($setor->postoTrabalhos->count())) {
				$this->AddPage();

				$this->setFillColor(150);
				$this->Cell(0, 5, utf8_decode('SETOR - '.$setor->descricao), 1, 0, 'C', 1);
				//$this->Ln(15);
				$this->Ln();

				$this->setFont('Arial', '', 6);

				$this->Cell(50, 25, 'POSTO DE TRABALHO', 1, 0, 'l', 0);
				$this->Ln();
				//-- Lista de Causas --//

				$this->Rotate(90);
				$this->Ln(50);

				$qs = null;

				foreach ($queixas->get() as $queixa) {
					$this->setFillColor(230);
					$this->Cell(25, 5, utf8_decode($queixa->descricao), 1, 0, 'l', 1);
					$qs[] = $queixa;
					$this->Ln();
				}

				$this->Cell(25, 5, utf8_decode('TOTAL DO POSTO'), 1, 0, 'l', 1);

				$this->Rotate(0);

				$linhas = -($queixas->count()*5+50);
				//-- Fim ista de Causas --//
				$this->Ln($linhas);

				unset($totalQueixas);

				foreach ($setor->postoTrabalhos as $posto) {
					$this->setFillColor(200);
					$this->Cell(50, 5, utf8_decode(substr($posto->descricao, 0, 37)), 1, 0, 'l', 0);
					$totalQueixaPosto = 0;

					foreach ($qs as $q) {
						$totalQueixa = Ocorrencia::where('setor_id', $setor->id)->where('posto_id', $posto->id)->where('queixa_id', $q->id)->count();
						$this->Cell(5, 5, $totalQueixa, 1, 0, 'C', 0);

						if (empty($totalQueixas[$q->id])) {
							$totalQueixas[$q->id] = 0;
						}
						$totalQueixas[$q->id] = $totalQueixa+$totalQueixas[$q->id];

						$totalQueixaPosto = $totalQueixaPosto+$totalQueixa;
					}
					$this->Cell(5, 5, $totalQueixaPosto, 1, 0, 'C', 1);
					$this->Ln();

				}

				$this->Cell(50, 5, utf8_decode('TOTAL DA QUEIXA'), 1, 0, 'l', 1);

				foreach ($totalQueixas as $total) {
					$this->Cell(5, 5, $total, 1, 0, 'C', 1);
				}

				$this->Ln();
			}
		}
	}
}

$pdf            = new OcorrenciasQueixaView('L');
$pdf->tituloDoc = 'LEVANTAMENTO ESTATISTICO DE ATENDIMENTO MÉDICO SESMT';

$pdf->Dados($queixas);
$pdf->Output();
exit;

?>
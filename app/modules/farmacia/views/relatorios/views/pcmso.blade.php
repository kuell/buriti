<?php

/**
 *
 */
class PCMSO extends RelatorioController {
	public function Dados($ocorrencias) {
		foreach (Setor::all() as $setor) {
			if (!empty($setor->postoTrabalhos()->count())) {

				$this->AddPage();

				$this->Cell(0, 5, $setor->descricao, 1, 0, 'L', 0);
				$this->Ln();

				foreach ($setor->postoTrabalhos as $posto) {

					if (!empty($ocorrencias[$setor->descricao][$posto->descricao])) {
						$this->Cell(100, 5, utf8_decode($posto->descricao), 1, 0, 'L', 0);
						$this->Cell(40, 5, $ocorrencias[$setor->descricao][$posto->descricao], 1, 0, 'L', 0);
						$this->Ln();
					}

				}

			}
		}

	}

}

$pdf            = new PCMSO();
$pdf->tituloDoc = 'Relatório Anual PCMSO';

$pdf->Dados($ocorrencias);
$pdf->Output();
exit;

?>
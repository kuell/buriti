<?php

class ColaboradorExames extends RelatorioController {
	public function Dados($setors) {

		$this->AddPage();

		foreach ($setors as $setor) {
			// Se o Setor não tiver posto não lista //
			if (count($setor->posto_trabalhos) != 0) {

				$this->setFont('Arial', 'B', 10);
				$this->setFillColor(170);

				$this->Cell(190, 5, utf8_decode($setor->descricao), 'TRL', 0, 1, 1);
				$this->Ln();

				foreach ($setor->posto_trabalhos as $posto) {
					// Se o posto não tiver colaborador não lista //
					if (count($posto->colaboradors) != 0) {
						$this->setFont('Arial', '', 9);
						$this->setFillColor(200);

						$this->Cell(190, 5, utf8_decode($posto->descricao), 1, 0, 1, 1);
						$this->Ln();
						$this->setFillColor(230);
						$this->Cell(80, 5, utf8_decode('Nome do Colaborador'), 'TRL', 0, 'L', 1);
						$this->Cell(20, 5, utf8_decode('Admissão'), 'TRL', 0, 'L', 1);
						$this->Cell(20, 5, utf8_decode('Periodico'), 'TRL', 0, 'L', 1);
						$this->Ln();

						foreach ($posto->colaboradors as $colaborador_posto) {
							$this->Cell(80, 5, utf8_decode($colaborador_posto->colaborador->nome), 1, 0, 'L', 0);
							$this->Cell(20, 5, utf8_decode($colaborador_posto->colaborador->data_admissao), 1, 0, 'L', 0);
							$this->Cell(20, 5, utf8_decode($colaborador_posto->colaborador->periodico), 1, 0, 'L', 0);
							$this->Ln();
						}
					}
				}

				// Pula mais uma linha ao terminio do setor //
				$this->Ln(10);
			}

		}
	}
}

$pdf            = new ColaboradorExames();
$pdf->tituloDoc = 'RELATORIO DE COLABORADORES / EXAMES';

$pdf->Dados($setors);
$pdf->Output();
exit;

?>
<?php

class SetorAcidentesView extends RelatorioController {

	function Dados($setors) {
		$this->AddPage();
		$this->setFillColor(200);

		foreach ($setors as $setor) {

			foreach ($setor->posto_trabalhos as $posto) {
				if (!empty($posto->ocorrencias()->where('sesmt', true)->count())) {

					$this->Cell(0, 5, $setor->descricao, 1, 0, 'C', 1);
					$this->Ln();
					$this->setFont('Arial', '', 7);

					$this->Cell(70, 5, utf8_decode('POSTO DE TRABALHO'), 1, 0, 'L', 1);
					$this->Cell(15, 5, utf8_decode('FUN/MÉD'), 1, 0, 'L', 1);
					$this->Cell(15, 5, utf8_decode('TOTAL AT'), 1, 0, 'L', 1);
					$this->Cell(15, 5, utf8_decode('DIAS PERD.'), 1, 0, 'L', 1);
					$this->Cell(15, 5, utf8_decode('AFAST.< 15'), 1, 0, 'L', 1);
					$this->Cell(15, 5, utf8_decode('SEM AFAST'), 1, 0, 'L', 1);
					$this->Ln();
				}
			}

			foreach ($setor->posto_trabalhos as $posto) {
				if ($posto->ocorrencias()->where('sesmt', true)->count()) {

					$this->Cell(70, 5, substr(utf8_decode($posto->descricao), 0, 45), 1, 0, 'L', 0);
					$this->Cell(15, 5, substr(utf8_decode($posto->colaboradors()->count()), 0, 45), 1, 0, 'C', 0);
					$this->Cell(15, 5, $posto->ocorrencias()->where('sesmt', true)->count(), 1, 0, 'C', 0);
					$this->Cell(15, 5, $posto->getQuantDiasPerdidos(), 1, 0, 'C', 0);

					$this->Ln();
				}

			}

			$this->setFont('Arial', '', 9);
			$this->Ln();

		}

	}

}

$pdf            = new SetorAcidentesView('L');
$pdf->tituloDoc = 'Relatório de Acidentes de trablho com vitimas';
$pdf->Dados($setors);

$pdf->Output();

exit;

?>
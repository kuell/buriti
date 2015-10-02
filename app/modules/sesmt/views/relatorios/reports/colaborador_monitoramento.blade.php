<?php

class ColaboradorMonitoramentoView extends RelatorioController {

	function Dados($setor) {
		$this->AddPage();
		$this->setFillColor(200);

		$periodo    = explode(' - ', Input::get('periodo'));
		$periodo[0] = Format::dbDate($periodo[0]);
		$periodo[1] = Format::dbDate($periodo[1]);

		$this->Cell(0, 5, $setor->descricao, 0, 0, 'C', 1);
		$this->Ln();
		foreach ($setor->colaboradores()->orderBy('nome')->get() as $colaborador) {
			if ($colaborador->monitoramentos($periodo[0], $periodo[1])->count()) {
				$this->SetFont('Arial', '', 8);
				$this->Cell(0, 5, utf8_decode($colaborador->nome.' - '.$colaborador->posto_trabalho_descricao), 1, 0, 'L', 0);
				$this->Ln();

				$this->SetFont('Arial', '', 6);
				$count = 0;
				foreach ($colaborador->monitoramentos($periodo[0], $periodo[1]) as $monitoramento) {
					$this->Cell(38, 4, date('d/m/Y', strtotime($monitoramento->created_at)).' - '.utf8_decode(substr($monitoramento->diagnostico, 0, 17)), 0, 0, 'L', 0);

					$count = $count+1;

					if ($count == 5) {
						$this->Ln();
						$count = 0;
					}
				}
				$this->Ln();
			}

		}

	}

}

$pdf            = new ColaboradorMonitoramentoView();
$pdf->tituloDoc = 'Monitoramento de Pressão Arterial Ref: '.Input::get('periodo');
$pdf->Dados($setor);

$pdf->Output();

exit;

?>
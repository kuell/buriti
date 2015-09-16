<?php

class ColaboradorPorPostoView extends RelatorioController {

	function Dados($colaboradors) {

		$this->SetFont('Arial', '', 7);

		foreach ($colaboradors as $colaborador) {
			$this->Cell(70, 4, utf8_decode($colaborador->nome), 'R', 0, 'L', 0);
			$this->Cell(15, 4, $colaborador->data_admissao, 0, 0, 0, 0);
			$this->Cell(32, 4, utf8_decode(($colaborador->setor_descricao)), 0, 0, 1, 0);
			$this->Cell(32, 4, empty($colaborador->posto_descricao->descricao)?null:$colaborador->posto_descricao->descricao, 'L', 0, 'L', 0);

			$this->Ln();
		}

	}
}

$fpdf            = new ColaboradorPorPostoView();
$fpdf->tituloDoc = "Colaboradores Por Posto de Trabalho";
$fpdf->AddPage();
$fpdf->Dados($colaboradors);

$fpdf->Output();
exit;
?>
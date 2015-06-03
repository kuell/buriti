<?php
Class ColaboradorReport extends RelatorioController {

	public function Dados($ocorrencia) {

	}

}

$fpdf = new ColaboradorReport();
$fpdf->AddPage();
$fpdf->Dados($ocorrencia);
$fpdf->Output();
exit;

?>
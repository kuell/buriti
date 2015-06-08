<?php
Class ColaboradorReport extends RelatorioController {

	public function Dados($ocorrencia) {

		$this->classificacaoOcorrencia($ocorrencia);
		$this->coletaInformacoesOcorrencia($ocorrencia);
/*
		$this->Cell(145, 5, utf8_decode('Nome / Matricula: '.$ocorrencia->colaborador->nome.' / '.$ocorrencia->colaborador->codigo_interno), 0, 0);
		$this->Cell(35, 5, utf8_decode('Função: '.$ocorrencia->colaborador->funcao), 0, 0);
		$this->Ln();
		$this->Cell(45, 5, 'Data Nascimento: '.$ocorrencia->colaborador->data_nascimento, 0, 0);
		//$this->Cell(145, 5, utf8_decode('Turno: (   ) Diúrno (   ) Noturno'), 0, 0);
		//$this->Cell(145, 5, utf8_decode('Cipeiro da Area: __________________________'), 0, 0);
		$this->Cell(100, 5, utf8_decode('Responsavel pelo Setor: '.$ocorrencia->colaborador->setor->descricao), 0, 0);
*/
	}

	
	private function classificacaoOcorrencia($ocorrencia){
		$this->SetFillColor(230);
		$this->MultiCell(190, 5, utf8_decode('Classificação da Ocorrência'), 'TLR', 'C', 1);
		$this->SetFont('Arial', '', 7);

		$this->Cell(40, 5, utf8_decode('Nº da Ocorrencia: '.$ocorrencia->id), 'L', 0);
		$this->Cell(50, 5, utf8_decode('Data da Ocorrencia: '.$ocorrencia->data_hora), 0, 0);
		$this->Cell(100, 5, utf8_decode('Data da Emissão: '.date('d/m/Y H:i')), 'R', 0);
		$this->Ln();


		$this->Cell(190, 5, utf8_decode('Tipo de Ocorrencia: (     )INCAPACITANTE	(     )NÃO INCAPACITANTE	(     )COM DANOS MATERIAIS	(     )COM DANOS AMBIENTAIS'), 'RL', 0);
		$this->Ln();

		$this->Cell(100, 5, utf8_decode('Inicio Afatastamento: ____/____/____  - Fim Afastamento: ____/____/____'), 'L', 0);
		$this->Cell(90, 5, utf8_decode('Classificação da Ocorrencia: (     )ASA	(     )ACA	(     )R.I.	'), 'R', 0);
		$this->Ln();

		$this->Cell(140, 5, utf8_decode('Potencial de Risco da Ocorrencia: (     )GRAVE	(     )ALTA	(     )MÉDIA	(     )BAIXA	(     )INSIGNIFICANTE	(     )SEM RISCO'), 'L', 0);
		$this->Cell(50, 5, utf8_decode('Local: ___________________________	'), 'R', 0);
		$this->Ln();
		$this->Cell(190, 0, '', 'T');
		$this->Ln();
	}
	
	public function coletaInformacoesOcorrencia($ocorrencia){
		$this->SetFillColor(230);
		$this->MultiCell(190, 5, utf8_decode('Coleta de Informações da Ocorrência'), 'TLR', 'C', 1);
		$this->SetFont('Arial', '', 6);

		$this->Cell(85, 5, utf8_decode('Dia da Semana: [   ]SEG	[   ]TER	[   ]QUA	[   ]QUI	[   ]SEX	[   ]SAB 	[   ]DOM'), 'L', 0);
		$this->Cell(35, 5, utf8_decode('Feriado? (     )SIM  (     )NÃO '), 0, 0);
		$this->Cell(20, 5, utf8_decode('Hora: '.$ocorrencia->hora), 0, 0);
		$this->Cell(50, 5, utf8_decode('Após quantas horas de trabalho ? _______'), 'R', 0);
		$this->Ln();

		$this->MultiCell(190, 5, utf8_decode('Descrição do Acidente: '.$ocorrencia->relato), 'LR', 'L', 1);
		$this->Cell(50, 5, 'Testemunha(s)', 'L', 0, 'L', 0);
		$this->Cell(50, 5, 'Cargo', 0, 0, 'L', 0);
		$this->Ln();
		for($i = 0; $i < 5; $i++){
			$this->Cell(50, 5, '_______________________________', 'L', 0, 'L', 0);
			$this->Cell(50, 5, '__________________', 0, 0, 'L', 0);
			$this->Ln();
		}

		
		
		

	}


}

$fpdf = new ColaboradorReport();
$fpdf->AddPage();
$fpdf->Dados($ocorrencia);
$fpdf->Output();
exit;

?>
<?php

Class ColaboradorReport extends RelatorioController {

	public function Dados($ocorrencia) {
		$this->informacoesColaborador($ocorrencia->colaborador);
		$this->classificacaoOcorrencia($ocorrencia);
		$this->coletaInformacoesOcorrencia($ocorrencia);
		$this->caracterizacaoOcorrencia($ocorrencia);
		$this->analiseDeAtos($ocorrencia);
		$this->acompanhamentoDeMedidas($ocorrencia);
		$this->cienciaDaGerencia($ocorrencia);
	}

	private function classificacaoOcorrencia($ocorrencia) {
		$this->SetFillColor(190);
		$this->SetFont('Arial', '', 8);
		$this->MultiCell(190, 5, utf8_decode('Classificação da Ocorrência'), 'TLR', 'C', 1);
		$this->SetFont('Arial', '', 6);

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

	public function coletaInformacoesOcorrencia($ocorrencia) {
		$this->SetFillColor(190);
		$this->SetFont('Arial', '', 8);
		$this->MultiCell(190, 5, utf8_decode('Coleta de Informações da Ocorrência'), 'TLR', 'C', 1);
		$this->SetFont('Arial', '', 6);
		$this->SetFillColor(240);

		$this->Cell(85, 5, utf8_decode('Dia da Semana: [   ]SEG	[   ]TER	[   ]QUA	[   ]QUI	[   ]SEX	[   ]SAB 	[   ]DOM'), 'L', 0);
		$this->Cell(35, 5, utf8_decode('Feriado? (     )SIM  (     )NÃO '), 0, 0);
		$this->Cell(20, 5, utf8_decode('Hora: '.$ocorrencia->hora), 0, 0);
		$this->Cell(50, 5, utf8_decode('Após quantas horas de trabalho ? _______'), 'R', 0);
		$this->Ln();

		$this->MultiCell(190, 3, utf8_decode('Descrição do Acidente: '.$ocorrencia->relato), 'LR', 'L', 1);
		$this->Cell(50, 5, 'Testemunha(s)', 'L', 0, 'L', 0);
		$this->Cell(50, 5, 'Cargo', 0, 0, 'L', 0);
		$this->Ln();

		for ($i = 0; $i < 5; $i++) {
			$this->Cell(50, 5, '__________________________________', 'L', 0, 'L', 0);
			$this->Cell(50, 5, '_______________________________', 0, 0, 'L', 0);
			$this->Ln();
		}
		$this->SetFont('Arial', 'B', 5);
		$this->Cell(90, -3.3, '', 0, 0, 'L', 0);
		$this->Cell(100, -3.3, utf8_decode('O RESPONSAVEL PELO SERVIÇO ESTAVA PRESENTE? (     )SIM  (     )NÃO'), 'LR', 'L', 1, 0);
		$this->Ln();
		$this->Cell(90, -3.3, '', 0, 0, 'L', 0);
		$this->Cell(100, -3.3, utf8_decode('AS FERRAMENTAS ESTAVAM EM PERFEITAS CONDIÇÕES? (     )SIM  (     )NÃO'), 'LR', 'L', 1, 0);
		$this->Ln();
		$this->Cell(90, -3.3, '', 0, 0, 'L', 0);
		$this->Cell(100, -3.3, utf8_decode('FALTOU EQUIPAMENTO DE SEGURANÇA? (     )SIM  (     )NÃO - SE NÃO, ERA ADEQUADO? (     )SIM  (     )NÃO'), 'LR', 'L', 1, 0);
		$this->Ln();
		$this->Cell(90, -3.3, '', 0, 0, 'L', 0);
		$this->Cell(100, -3.3, utf8_decode('O COLABORADOR TRABALHAVA SOZINHO? (     )SIM  (     )NÃO '), 'LR', 'L', 1, 0);
		$this->Ln();
		$this->Cell(90, -3.3, '', 0, 0, 'L', 0);
		$this->Cell(100, -3.3, utf8_decode('COLABORADOR REINCIDENTE? (     )SIM  (     )NÃO '), 'LR', 'L', 1, 0);
		$this->Ln();
		$this->Cell(90, -3.3, '', 0, 0, 'L', 0);
		$this->Cell(100, -3.3, utf8_decode('FEZ ANÁLISE PRELIMINAR DE RISCO? (     )SIM  (     )NÃO '), 'LR', 'L', 1, 0);
		$this->Ln();
		$this->Cell(90, -3.3, '', 0, 0, 'L', 0);
		$this->Cell(100, -3.3, utf8_decode('HOUVE INSTRUÇÃO ESPECIFICA PARA A TAREFA? (     )SIM  (     )NÃO '), 'LR', 'L', 1, 0);
		$this->Ln();
		$this->Cell(90, -3.3, '', 0, 0, 'L', 0);
		$this->Cell(100, -3.3, utf8_decode('RECEBEU TREINAMENTO PARA A FUNÇÃO? (     )SIM  (     )NÃO '), 'LR', 'L', 1, 0);
		$this->Ln();
		$this->Cell(90, -3.3, '', 0, 0, 'L', 0);
		$this->Cell(100, -3.3, utf8_decode('RECEBEU TREINAMENTO PREVENCIONISTA? (     )SIM  (     )NÃO '), 'LR', 'L', 1, 0);
		$this->Ln(26.6);

		$this->SetFont('Arial', '', 5.5);
		$this->Cell(60, 3, 'FATORES PESSOAIS RELATADOS PELOS ENTREVISTADOS:', 'LT', 0, 'L', 0);
		$this->Cell(130, 3, utf8_decode('[   ]IMPRUDENCIA    [   ]NEGLIGENCIA    [   ]IMPERICIA [   ]CONDUTA ARRISCADA        [   ]CONDIÇÃO INSEGURA'), 'RT', 0, 'L', 0);
		$this->Ln();
		$this->Cell(90, 3, 'FATORES DE TRABALHO RELATADOS PELOS ENTREVISTADOS / CONSTATADOS EM CAMPO:', 'LB', 0, 'L', 0);
		$this->Cell(100, 3, utf8_decode('[   ]PADRÕES DE TRABALHO INCOMPLETO    [   ]CONDIÇÕES DE ALTO RISCO    '), 'RB', 0, 'L', 0);
		$this->Ln();

	}

	public function informacoesColaborador($colaborador) {
		$this->SetFillColor(190);
		$this->SetFont('Arial', '', 8);
		$this->MultiCell(190, 5, utf8_decode('Informações do colaborador'), 'TLR', 'C', 1);

		$this->SetFont('Arial', '', 7);
		$this->MultiCell(190, 5, utf8_decode('Nome: '.$colaborador->nome.'		Data Nascimento: '.$colaborador->data_nascimento.'		Idade: '.$colaborador->idade.' anos'), 'LR', 'L', 0);
		$this->Cell(190, 4, utf8_decode('Matrícula: '.$colaborador->codigo_interno.'		Data Admissão: '.$colaborador->data_admissao.'		Função: '.$colaborador->funcao.'		Contato: '.$colaborador->contato), 'LR', 'L', 1, 0);
		$this->Ln();

		$this->Cell(190, 4, utf8_decode('Setor: '.$colaborador->setor->descricao.'		Supervisor: '.$colaborador->setor->encarregado.'		Horas de Trabalho Padrão: '.$colaborador->setor->padrao_horatrabalho.'		Tempo de Função: _____ anos	Tempo de Empresa: '.$colaborador->tempo_empresa), 'LR', 'L', 1, 0);
		$this->Ln();
		$this->Cell(50, 4, utf8_decode('Possui Férias vencidas? [   ]SIM	[   ]NÃO'), 'L', 'L', 1, 0);
		$this->Cell(140, 4, utf8_decode('Fez hora extra 7 dias antes da ocorrencia? [   ]SIM	[   ]NÃO'), 'R', 'L', 1, 0);
		$this->Ln();

		$this->Cell(110, 4, utf8_decode('Utilizava algum E.P.I.? [   ]SIM	[   ]NÃO		Qual?_________________________________________'), 'L', 'L', 1, 0);
		$this->Cell(80, 4, utf8_decode('Agente da Lesão: __________________________________________'), 'R', 'L', 1, 0);
		$this->Ln();

	}

	public function caracterizacaoOcorrencia($ocorrencia) {
		$this->SetFillColor(190);
		$this->SetFont('Arial', '', 8);
		$this->MultiCell(190, 5, utf8_decode('Caracterização da Lesão Humana(Preencher Somente em Caso de Lesão)'), 'TLR', 'C', 1);

		$this->SetFont('Arial', '', 5);
		$this->SetFillColor(240);

		$this->Cell(190, 2.5, utf8_decode('Natureza da Lesão'), 'LR', 'L', 1, 1);
		$this->Ln();
		$this->MultiCell(190, 2.5, utf8_decode(implode('[    ]  - ', NaturezaLesao::all()->lists('descricao'))).'[    ]', 'LR', 'L');

		$this->Cell(190, 2.5, utf8_decode('Partes do Corpo'), 'RL', 'L', 1, 1);
		$this->Ln();
		$this->MultiCell(190, 2.5, utf8_decode(implode(ParteCorpo::whereNull('pai_id')->lists('descricao'), '[    ] - ')).'[    ]', 'LR', 'L');

		$this->Cell(190, 2.5, utf8_decode('Periodo esperado de incapacitação(Afastamento / Restrição)'), 'LR', 0, 'L', 1, 0);
		$this->Ln();
		$this->MultiCell(190, 2.5, utf8_decode('[   ]0 dia - [   ]1 dia - [   ]2 dias - [   ]7 a 15 dias - [   ]16 a 30 dias - [   ]30 a 45 dias - [   ]45 a 60 dias - [   ]60 dias a 1 ano - [   ]Mais de 1 ano, ou incapacidade permanente - [   ]Falecimento'), 'LBR', 'L');
	}

	public function analiseDeAtos($ocorrencia) {
		$this->SetFillColor(190);
		$this->SetFont('Arial', '', 8);
		$this->MultiCell(190, 5, utf8_decode('Analise de Atos e/ou Condições Inadequados'), 'TLR', 'C', 1);

		$this->SetFont('Arial', '', 5);
		$this->SetFillColor(240);

		$this->Cell(190, 2.5, utf8_decode('O que causou e/ou influenciou os Atos e/ou Condições Inadequados citados?'), 'LR', 'L', 1, 1);
		$this->Ln();
		$this->Cell(190, 2.5, 'Atos: ', 'LRT', 'L', 1, 0);
		$this->Ln();
		$this->MultiCell(190, 15, ' ', 'LR', 'TL');

		$this->Cell(190, 2.5, utf8_decode('Condições: '), 'LRT', 'L', 1, 0);
		$this->Ln();
		$this->MultiCell(190, 15, ' ', 'LRB', 'TL');
	}

	public function acompanhamentoDeMedidas($ocorrencia) {
		$this->SetFillColor(190);
		$this->SetFont('Arial', '', 8);
		$this->MultiCell(190, 5, utf8_decode('Acompanhamento das Medidas Preventivas / Corretivas'), 'TLR', 'C', 1);

		$this->SetFont('Arial', '', 5);
		$this->SetFillColor(240);
		$this->Cell(190, 2.5, utf8_decode('Acompanhamento das Ações'), 'LR', 'L', 1, 1);
		$this->Ln();

		$this->Cell(60, 2.5, utf8_decode('Medidas Preventivas / Corretivas'), 'LRT', 0, 'C', 0);
		$this->Cell(40, 2.5, utf8_decode('Ações'), 'LRT', 0, 'C', 0);
		$this->Cell(40, 2.5, utf8_decode('Monitoramento das Ações'), 'LTR', 0, 'C', 0);
		$this->Cell(50, 2.5, utf8_decode('Status das Medidas'), 'LTR', 0, 'C', 0);
		$this->Ln();

		$this->Cell(60, 2.5, '', 'LBR', 'L', 1, 0);
		$this->Cell(20, 2.5, utf8_decode('Quem'), 'LBR', 0, 'C', 0);
		$this->Cell(20, 2.5, utf8_decode('Quando'), 'LBR', 0, 'C', 0);
		$this->Cell(20, 2.5, utf8_decode('Quem'), 'LBR', 0, 'C', 0);
		$this->Cell(20, 2.5, utf8_decode('Quando'), 'LBR', 0, 'C', 0);
		$this->Cell(50, 2.5, '', 'LBR', 0, 'C', 0);
		$this->Ln();

		for ($i = 1; $i <= 8; $i++) {
			$this->Cell(60, 4, $i.' - ______________________________________________________', 'LBR', 'L', 1, 0);
			$this->Cell(20, 4, '_________________', 'LBR', 0, 'C', 0);
			$this->Cell(20, 4, '_________________', 'LBR', 0, 'C', 0);
			$this->Cell(20, 4, '_________________', 'LBR', 0, 'C', 0);
			$this->Cell(20, 4, '_________________', 'LBR', 0, 'C', 0);
			$this->Cell(50, 4, '_______________________________________________', 'LBR', 0, 'C', 0);
			$this->Ln();
		}

	}

	public function cienciaDaGerencia($ocorrencia) {
		$this->SetFillColor(190);
		$this->SetFont('Arial', '', 8);
		$this->MultiCell(190, 5, utf8_decode('Ciência da Gerencia de Fábrica'), 'TLR', 'C', 1);

		$this->SetFont('Arial', '', 5);
		$this->SetFillColor(240);

		$this->Cell(30, 3, utf8_decode('Comentários: '), 'TL', 0, 'L', 0);
		$this->Cell(160, 3, ' ', 'TR', 0, 'C', 0);
		$this->Ln();
		$this->Cell(30, 7, ' ', 'LB', 0, 'C', 0);
		$this->Cell(160, 7, ' ', 'BR', 0, 'C', 0);
		$this->Ln();

		$this->Cell(60, 15, 'Nome: ___________________________________________________', 0, 0, 'C', 0);

		$this->Cell(60, 15, 'Data: ______/______/___________', 0, 0, 'C', 0);

		$this->Cell(60, 15, 'Assinatura: ___________________________________________________', 0, 0, 'C', 0);

		$this->Ln();

	}
}

$fpdf = new ColaboradorReport();
$fpdf->AddPage();
$fpdf->Dados($ocorrencia);
$fpdf->Output('ocorrencia_'.$ocorrencia->id, 'I');
exit;

?>
<?php
/**
 *
 */
class InvestigacaoView extends RelatorioController {

	function footer() {
		$this->SetY(-15);
		$this->SetFont("Arial", "I", 8);
		$this->SetDrawColor(200);
		$this->Cell(0, 4, utf8_decode("Página ").$this->PageNo(), 0, 0, "C");
	}

	function Dados($investigacao) {

		$this->AddPage();
		$this->capa($investigacao);

		$this->tituloDoc = 'Ficha de Investigação de Acidente. Investigação nº: '.$investigacao->id;

		$this->AddPage();
		$this->colaborador($investigacao);
		$this->ocorrencia($investigacao);

		$this->AddPage();
		$this->pagina2($investigacao);

		$this->AddPage();
		$this->pagina3($investigacao);
	}

	function pagina3($investigacao) {
		$this->setFillColor('200');

		$this->Cell(0, 4, utf8_decode('Descrição do Acidente: '), 'RTL', 0, 'L', 1);
		$this->Ln();
		$this->Cell(0, 70, ' ', 'RL', 0);
		$this->Ln();
		$this->Cell(0, 4, 'Testamunhas:', 'RBL', 0);
		$this->Ln();

		$this->Cell(0, 4, utf8_decode('Informaçao de Atesdado Médico: '), 'RTL', 0, 'L', 1);
		$this->Ln();
		$this->Cell(150, 4, utf8_decode('Houve remoção por serviços especializados de urgência? (SAMU, Bombeiros, Outros)'), 'L', 0);
		$this->Cell(20, 4, utf8_decode('(     ) SIM'), 0, 0);
		$this->Cell(20, 4, utf8_decode('(     ) NÃO'), 'R', 0);
		$this->Ln();

		$this->Cell(0, 4, utf8_decode('Local de assistência médica - Especificar Hospital / Pronto Socorro / Posto de Saúde: '), 'LR', 0);
		$this->Ln();
		$this->Cell(0, 10, utf8_decode('_____________________________________________________'), 'LR', 0);

		$this->Ln();

		$this->Cell(55, 5, utf8_decode('Horário do Atendimento: ____:____'), 'L', 0);
		$this->Cell(135, 5, utf8_decode('CID: _______'), 'R', 0);

		$this->Ln();

		$this->Cell(85, 5, utf8_decode('Deverá o colaborador se afastar - Se durante o tratamento?'), 'BL', 0);

		$this->Cell(15, 5, utf8_decode('(     ) SIM'), 'B', 0);
		$this->Cell(20, 5, utf8_decode('(     ) NÃO'), 'B', 0);
		$this->Cell(22, 5, utf8_decode('Quantos Dias?'), 'B', 0);
		$this->Cell(48, 5, utf8_decode('_____________'), 'RB', 0, 'L');

		$this->Ln(8);

		$this->Cell(70, 6, utf8_decode('Acompanhamento das Ações: '), 1, 0, 'L');
		$this->Cell(40, 6, utf8_decode('Quem? '), 1, 0, 'L');
		$this->Cell(40, 6, utf8_decode('Quando? '), 1, 0, 'L');
		$this->Cell(40, 6, utf8_decode('Status das Medidas '), 1, 0, 'L');
		$this->Ln();

		for ($i = 1; $i <= 2; $i++) {
			$this->Cell(70, 24, utf8_decode(''), 1, 0, 'L');
			$this->Cell(40, 24, utf8_decode(' '), 1, 0, 'L');
			$this->Cell(40, 24, utf8_decode(''), 1, 0, 'L');
			$this->Cell(40, 24, utf8_decode(''), 1, 0, 'L');
			$this->Ln();
		}

		$this->Ln(8);

		$this->Cell(0, 6, utf8_decode('Ciencia da Gerencia: '), 'LTR', 0, 'L');
		$this->Ln();

		$this->Cell(0, 6, utf8_decode(''), 'RL', 0, 'L');
		$this->Ln();

		$this->Cell(0, 6, utf8_decode('Assinatura: '), 'RBL', 0, 'L');
		$this->Ln(20);

		$this->Cell(95, 6, utf8_decode('____________________________________________ '), 0, 0, 'C');
		$this->Cell(95, 6, utf8_decode('____________________________________________ '), 0, 0, 'C');
		$this->Ln();

		$this->Cell(95, 6, utf8_decode('(Local e Data) '), 0, 0, 'C');
		$this->Cell(95, 6, utf8_decode('(Assinatura do Tecnico Responsável) '), 0, 0, 'C');
		$this->Ln();

		$this->Cell(0, 6, utf8_decode('* Os arquivos e imagens referentes a esta investigação serão anexos após esta página. '), 0, 0, 'L');

	}

	function capa($investigacao) {
		$this->setFont('Arial', 'B', 40);
		$this->MultiCell(0, 30, utf8_decode('FICHA DE INVESTIGAÇÃO DE ACIDENTE '), 0, 'C');
		$this->Ln();

		$this->setFont('Arial', '', 12);
		$this->Cell(0, 8, utf8_decode('Ocorrencia Nº: '.$investigacao->ocorrencia->id.' - Investigação nº: '.$investigacao->id), 'RTL', 0, 'L', 0);
		$this->Ln();

		$this->Cell(0, 8, utf8_decode('Data do Acidente: '.$investigacao->ocorrencia->data_ocorrencia), 'RL', 0, 'L', 0);
		$this->Ln();

		$this->Cell(0, 8, utf8_decode('Colaborador: '.$investigacao->colaborador->nome), 'RL', 0, 'L', 0);
		$this->Ln();

		$this->Cell(0, 8, utf8_decode('Setor: '.$investigacao->colaborador->setor->descricao.' - Posto de Trabalho: '.$investigacao->colaborador->postoDescricao->descricao), 'RL', 0, 'L', 0);
		$this->Ln();

		$this->Cell(0, 8, utf8_decode(''), 'RL', 0, 'L', 0);
		$this->Ln();

		$this->Cell(0, 8, utf8_decode('Por: '.Auth::user()->nome), 'RBL', 0, 'L', 0);
		$this->Ln();

	}

	function pagina2($investigacao) {
		$this->setFillColor('200');

		$this->image(public_path().'/img/corpo_humano.png', 10, 31, 190, 70);
		$this->Ln(72);

		$this->Cell(0, 4, 'POSSIVEIS EVENTOS CAUSADORES DO ACIDENTE:', 'RTL', 0, 'L', 1);
		$this->Ln();

		$this->MultiCell(0, 4, utf8_decode(' (     ) FATOR PESSOA L  > RELACIONADO AOS ASPECTOS COMPORTAMENTAIS , COMO , POR EXEMPLO; QUEBRA DE DISCIPLINAS ORGANIZACIONAL , NÃO USO DO EPI , NÃO SEGUIR OU PULAR ETAPAS DO PROCEDIMENTOS , INDISCIPLINA, ATITUDES IMPREVISÍVEIS.
(     )  FATOR ORGANIZACIONAL   > ENVOLVE DESVIOS RELACIONADOS AOS ELEMENTOS DO SISTEMAS DE GESTÃO SMS , COMO POR EXEMPLO : DIVERGENCIAS ENTRE POLITICA  E APARTICA GERENCIAL , FLHA DE QULAIFICAÇÃO E TREINAMENTO , AUSENCIA OU DEFICIÊNCIA DE PROCEDIMENTOS ENTRE OUTROS .
(     )  FATOR OPERACIONAL  > ENVOLVE APECTOS FISICOS RELACIONADOS Á ORGANIZAÇÃO DA PRODUÇÃO E AS CONDIÇÕES DO MEIO AMBIENTE DE TRABALHO , PROTEÇÃO DE MAQUINAS E EQUIPAMENTOS , COMO POR  EXEMPLO : FERRAMENTAS IMPROVISADAS , PROTEÇÕES INEXISTENTES E DESEQUILIBRIO NO CICLO DE TRABALHO-DESCANSO , ENTRE OUTROS;
'), 'LRB', 'L');

		$this->Ln();
		$this->Cell(0, 4, utf8_decode('ÁRVORES DE CAUSAS'), 'RTL', 0, 'L', 1);
		$this->Ln();

		$this->MultiCell(0, 4, utf8_decode('INDIVIDUO: ASPECTOS FISICOS E PSICOLOGICOS, ENVOLVENDO CONDIÇÃO MEDICA PREEXISTENTES, FALTA DE PREPARO FISICO.
EQUIPAMENTO: DIZ RESPEITO AOS RECURSOS MATERIAIS DISPONIVEIS PARA EXECUÇÃO DA ATIVIDADE E PODEM ESTAR RELACIONADOS ÀS FERRAMENTAS COM DEFEITO, INSEGURAS DE MOVIMENTAÇÃO DE CARGA, POSTURA INADEQUADA ETC;
ATIVIDADE: ENVOLVE ASPECTO RELACIONADOS  A EXECUÇÃO DA ATIVIDADE , COMO POR EXEMPLO : MANUSEIO DE MATERIAL , MOVIMENTOS REPETTTIVOS , PRATICAS INSEGURAS DE MOVIMENTAÇÃO DE CARGA , POSTURAS INADEQUADAS.
COMPORTAMENTAIS;
 ESTÁ RELACIONADA Á PREDISPOSIÇÃO E AS MOVITAÇÕES DO INDIVIDUO NA EXECUÇÃO DA ATIVIDADE, COMO, POR EXEMPLO: NA OPERAÇÃO DE EQUIPAMENTOS SEM AUTORIZAÇÃO, NÃO SEGUIR E/ OU PULAR ETAPAS DO PROCEDIMENTO CILMA SOCIAL NO TRABALHO AÇÕES IMPREVISÍVEIS ETC;
CARACTERISTICAS DO MEIO AMBIENTE DE TRABALHO: ENVOLVE ASPECTOS FISICOS, COMO POR EXEMPLO;
 AMBIENTE RUIDOSO, ILIMUNINAÇÃO PRECARIA, TEMPERATURAS EXTREMAS, TRABALHO NORTUNO, CONFINADO EMBARCADO, FALTA HIGIENE E ORGANIZAÇÃO, CONDIÇOES METEOROLÓGICAS ETC;
TIPO DE ATIVIDADES;
 RELACIONADAS AOS RISCOS INERENTES DA ATIVIDADE.'), 'LRB', 'L');
	}

	function colaborador($investigacao) {
		$this->setFillColor('200');
		$this->setFont('Arial', '', 8);

		$this->Cell(0, 6, ' ~ DADOS DO COLABORADOR ~', 1, 0, 'C', 1);
		$this->Ln();

		$this->setFillColor('230');

		$this->Cell(16, 6, 'Matricula: ', 1, 0, 'L', 1);
		$this->Cell(14, 6, $investigacao->colaborador->codigo_interno, 1, 0, 'L', 0);

		$this->Cell(12, 6, 'Nome: ', 1, 0, 'R', 1);
		$this->Cell(100, 6, $investigacao->colaborador->nome, 1, 0, 'L');

		$this->Cell(28, 6, 'Data Nascimento: ', 1, 0, 'R', 1);
		$this->Cell(20, 6, $investigacao->colaborador->data_nascimento, 1, 0, 'L');

		$this->Ln();

		$this->Cell(11, 6, 'Sexo: ', 1, 0, 'R', 1);
		$this->Cell(19, 6, $investigacao->colaborador->sexoDescricao, 1, 0, 'L');

		$this->Cell(11, 6, 'Setor: ', 1, 0, 'L', 1);
		$this->Cell(60, 6, $investigacao->colaborador->setor->descricao, 1, 0, 'L');

		$this->Cell(13, 6, utf8_decode('Função: '), 1, 0, 'L', 1);
		$this->Cell(76, 6, utf8_decode($investigacao->colaborador->funcao), 1, 0, 'L');

		$this->Ln();

		$this->Cell(30, 6, utf8_decode('Data de Admissão: '), 1, 0, 'L', 1);
		$this->Cell(20, 6, $investigacao->colaborador->data_admissao, 1, 0, 'L');

		$this->Cell(30, 6, utf8_decode('Posto de Trabalho: '), 1, 0, 'L', 1);
		$this->Cell(110, 6, utf8_decode($investigacao->colaborador->posto_descricao->descricao), 1, 0, 'L');

		$this->Ln();

		$this->Cell(17, 6, utf8_decode('Endereco: '), 1, 0, 'L', 1);
		$this->Cell(90, 6, utf8_decode($investigacao->colaborador->endereco), 1, 0, 'L');

		$this->Cell(12, 6, utf8_decode('Bairro: '), 1, 0, 'L', 1);
		$this->Cell(71, 6, utf8_decode($investigacao->colaborador->bairro), 1, 0, 'L');

		$this->Ln();

	}

	function ocorrencia($investigacao) {
		$this->setFillColor('200');

		$this->Cell(0, 6, utf8_decode(' ~ INFORMAÇÕES DO ACIDENTE ~'), 1, 0, 'C', 1);
		$this->Ln();

		$this->setFillColor('230');

		$this->Cell(30, 6, 'Tipo de Ocorrencia: ', 'TBL', 0, 'L', 1);
		$this->setFont('Arial', '', 6);
		$this->Cell(17, 6, utf8_decode('(     ) ACIDENTE'), 'BT', 0, 'BL', 0);
		$this->Cell(32, 6, utf8_decode('(     ) DOENÇA OCUPACIONAL'), 'BT', 0, 'L', 0);
		$this->Cell(32, 6, utf8_decode('(     ) DOENÇA DO TRABALHO'), 'BT', 0, 'L', 0);
		$this->Cell(18, 6, utf8_decode('(     ) INCIDENTE'), 'BT', 0, 'L', 0);
		$this->Cell(14, 6, utf8_decode('(     ) TIPICO'), 'BT', 0, 'L', 0);
		$this->Cell(16, 6, utf8_decode('(     ) TRAJETO'), 'BT', 0, 'L', 0);
		$this->Cell(16, 6, utf8_decode('(     ) ATIPICO'), 'BT', 0, 'L', 0);
		$this->Cell(15, 6, utf8_decode('(     ) FATAL'), 'RBT', 0, 'L', 0);

		$this->Ln();

		$this->setFont('Arial', '', 9);
		$this->Cell(21, 6, utf8_decode('Classificação: '), 'BTL', 0, 'L', 1);

		$this->setFont('Arial', '', 6);
		$this->Cell(10, 6, utf8_decode('(     ) ASA'), 'B', 0, 'L', 0);
		$this->Cell(10, 6, utf8_decode('(     ) ACA'), 'B', 0, 'L', 0);
		$this->Cell(10, 6, utf8_decode('(     ) R.I.'), 'B', 0, 'L', 0);

		$this->setFont('Arial', '', 9);
		$this->Cell(30, 6, utf8_decode('Potencial de Risco: '), 'BTL', 0, 'L', 1);

		$this->setFont('Arial', '', 6);
		$this->Cell(11, 6, utf8_decode('(     ) Baixa'), 'B', 0, 'L', 0);
		$this->Cell(11, 6, utf8_decode('(     ) Média'), 'B', 0, 'L', 0);
		$this->Cell(10, 6, utf8_decode('(     ) Alta'), 'B', 0, 'L', 0);
		$this->Cell(13, 6, utf8_decode('(     ) Grave'), 'B', 0, 'L', 0);

		$this->setFont('Arial', '', 9);
		$this->Cell(22, 6, utf8_decode('Probabilidade: '), 'BTL', 0, 'L', 1);

		$this->setFont('Arial', '', 6);
		$this->Cell(15, 6, utf8_decode('(     ) Frequente'), 'B', 0, 'L', 0);
		$this->Cell(15, 6, utf8_decode('(     ) Ocasional'), 'B', 0, 'L', 0);
		$this->Cell(12, 6, utf8_decode('(     ) Rara'), 'BR', 0, 'L', 0);

		$this->Ln();

		$this->setFont('Arial', '', 9);

		$this->Cell(30, 6, utf8_decode('Data do Acidente: '), 'BLT', 0, 'L', 1);
		$this->Cell(20, 6, '___/___/____', 'BR', 0, 'L', 0);

		$this->Cell(30, 6, utf8_decode('Horas Trabalhadas: '), 'BLT', 0, 'L', 1);
		$this->Cell(18, 6, '____:____', 'BR', 0, 'C', 0);

		$this->Cell(30, 6, utf8_decode('Local do Acidente: '), 'BLT', 0, 'L', 1);
		$this->Cell(62, 6, '_________________________________', 'BR', 0, 'L', 0);

		$this->Ln();

		$this->Cell(23, 6, utf8_decode('Tipo de Lesão: '), 'BLT', 0, 'L', 1);
		$this->Cell(42, 6, utf8_decode('(     ) Lesão mediata tardial'), 'B', 0, 'L', 0);
		$this->Cell(32, 6, utf8_decode('(     ) Lesão imediata'), 'BR', 0, 'L', 0);

		$this->Cell(30, 6, utf8_decode('Houve afastamento? '), 'BLT', 0, 'L', 1);
		$this->Cell(15, 6, utf8_decode('(     ) SIM'), 'B', 0, 'L', 0);
		$this->Cell(17, 6, utf8_decode('(     ) NÃO'), 'B', 0, 'L', 0);

		$this->Cell(12, 6, 'Dias: ', 'LTB', 0, 'L', 1);
		$this->Cell(19, 6, '____ dias', 'BR', 0, 'L', 0);

		$this->Ln();
		$this->setFont('Arial', '', 8);

		$this->Cell(65, 6, utf8_decode('Houve instruções especificas para a tarefa? '), 'TL', 0, 'L', 1);
		$this->Cell(14, 6, utf8_decode('(     ) SIM'), 'T', 0, 'L', 0);
		$this->Cell(16, 6, utf8_decode('(     ) NÃO'), 'T', 0, 'L', 0);

		$this->Cell(65, 6, utf8_decode('O colaborador usava E.P.I? '), 'T', 0, 'TL', 1);
		$this->Cell(13, 6, utf8_decode('(     ) SIM'), 'T', 0, 'L', 0);
		$this->Cell(17, 6, utf8_decode('(     ) NÃO'), 'TR', 0, 'L', 0);

		$this->Ln();

		$this->Cell(65, 6, utf8_decode('As ferramentas estavam em boas condições? '), 'L', 0, 'L', 1);
		$this->Cell(14, 6, utf8_decode('(     ) SIM'), 0, 0, 'L', 0);
		$this->Cell(16, 6, utf8_decode('(     ) NÃO'), 0, 0, 'L', 0);

		$this->Cell(65, 6, utf8_decode('Possui férias vencidas? '), 0, 0, 'L', 1);
		$this->Cell(13, 6, utf8_decode('(     ) SIM'), 0, 0, 'L', 0);
		$this->Cell(17, 6, utf8_decode('(     ) NÃO'), 'R', 0, 'L', 0);

		$this->Ln();

		$this->Cell(65, 6, utf8_decode('O colaborador é reincidente? ( RI, ASA, ACA) '), 'L', 0, 'L', 1);
		$this->Cell(14, 6, utf8_decode('(     ) SIM'), 0, 0, 'L', 0);
		$this->Cell(16, 6, utf8_decode('(     ) NÃO'), 0, 0, 'L', 0);

		$this->Cell(65, 6, utf8_decode('Fez horas extra? '), 0, 0, 'L', 1);
		$this->Cell(13, 6, utf8_decode('(     ) SIM'), 0, 0, 'L', 0);
		$this->Cell(17, 6, utf8_decode('(     ) NÃO'), 'R', 0, 'L', 0);

		$this->Ln();

		$this->Cell(65, 6, utf8_decode('Fez treinamento prevencionista?  '), 'LB', 0, 'L', 1);
		$this->Cell(14, 6, utf8_decode('(     ) SIM'), 'B', 0, 'L', 0);
		$this->Cell(16, 6, utf8_decode('(     ) NÃO'), 'B', 0, 'L', 0);

		$this->Cell(65, 6, utf8_decode('Outras pessoas trabalhavam na mesma tarefa?'), 'B', 0, 'L', 1);
		$this->Cell(13, 6, utf8_decode('(     ) SIM'), 'B', 0, 'L', 0);
		$this->Cell(17, 6, utf8_decode('(     ) NÃO'), 'RB', 0, 'L', 0);

		$this->Ln();

		$this->Cell(0, 4, utf8_decode('Natureza da lesão:  '), 'TLR', 0, 'L', 1);
		$this->Ln();
		$this->Cell(32, 4, utf8_decode('(     ) Ferimento Corte'), 'L', 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Radiação'), 0, 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Luxação'), 0, 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Distensão'), 0, 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Pancadas'), 0, 0, 'L', 0);
		$this->Cell(30, 4, utf8_decode('(     ) Escoriações'), 'R', 0, 'L', 0);
		$this->Ln();
		$this->Cell(32, 4, utf8_decode('(     ) Intoxicação'), 'L', 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Ferimento Inciso'), 0, 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Contusão'), 0, 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Torsão'), 0, 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Perfurações'), 0, 0, 'L', 0);
		$this->Cell(30, 4, utf8_decode('(     ) Amputação'), 'R', 0, 'L', 0);
		$this->Ln();
		$this->Cell(32, 4, utf8_decode('(     ) Fratura'), 'LB', 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Queimaduras'), 'B', 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Entorse'), 'B', 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Doença infectocontagiosa'), 'B', 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode(''), 'B', 0, 'L', 0);
		$this->Cell(30, 4, utf8_decode(''), 'RB', 0, 'L', 0);

		$this->Ln();

		$this->Cell(0, 4, utf8_decode('Parte do Corpo atingida:  '), 'LTR', 0, 'L', 1);
		$this->Ln();
		$this->Cell(34, 4, utf8_decode('(     ) Membros Superiores'), 'L', 0, 'L', 0);
		$this->Cell(34, 4, utf8_decode('(     ) Membros Inferiores'), 0, 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode(''), 0, 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode(''), 0, 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode(''), 0, 0, 'L', 0);
		$this->Cell(26, 4, utf8_decode(''), 'R', 0, 'L', 0);

		$this->Ln();

		$this->Cell(32, 4, utf8_decode('(     ) Crânio'), 'L', 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Face'), 0, 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Braço'), 0, 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Tronco'), 0, 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Posterior da Coxa'), 0, 0, 'L', 0);
		$this->Cell(30, 4, utf8_decode('(     ) Pé'), 'R', 0, 'L', 0);

		$this->Ln();

		$this->Cell(32, 4, utf8_decode('(     ) Cabeça'), 'L', 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Ouvidos'), 0, 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Cotovelo'), 0, 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Dorso'), 0, 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Quadril'), 0, 0, 'L', 0);
		$this->Cell(30, 4, utf8_decode('(     ) Dedo/Pé'), 'R', 0, 'L', 0);

		$this->Ln();

		$this->Cell(32, 4, utf8_decode('(     ) Nariz'), 'L', 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Mandibula'), 0, 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Ante braço'), 0, 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Tórax'), 0, 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Quadiceps Femoral'), 0, 0, 'L', 0);
		$this->Cell(30, 4, utf8_decode('(     ) Coluna Tórax'), 'R', 0, 'L', 0);

		$this->Ln();

		$this->Cell(32, 4, utf8_decode('(     ) Orelha'), 'L', 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Ombro'), 0, 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Punho'), 0, 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Estomago'), 0, 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Perna'), 0, 0, 'L', 0);
		$this->Cell(30, 4, utf8_decode('(     ) Coluna Lombar'), 'R', 0, 'L', 0);

		$this->Ln();

		$this->Cell(32, 4, utf8_decode('(     ) Boca'), 'L', 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Clavicula'), 0, 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Mão'), 0, 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Abdome'), 0, 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Tornozelo'), 0, 0, 'L', 0);
		$this->Cell(30, 4, utf8_decode('(     ) Coluna Cervical'), 'R', 0, 'L', 0);

		$this->Ln();

		$this->Cell(32, 4, utf8_decode('(     ) Olhos'), 'LB', 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Corpo'), 'B', 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode('(     ) Sistema imunológico'), 'B', 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode(''), 'B', 0, 'L', 0);
		$this->Cell(32, 4, utf8_decode(''), 'B', 0, 'L', 0);
		$this->Cell(30, 4, utf8_decode(''), 'RB', 0, 'L', 0);

		$this->Ln();

		$this->Cell(0, 4, utf8_decode('Fatores Potenciais de Acidentes:  '), 'LTR', 0, 'L', 1);
		$this->Ln();
		$this->setFont('Arial', '', 7);
		$this->MultiCell(190, 4, utf8_decode('(   ) PRATICAS ABAIXO DO PADRÃO: OPERAR EQUIPAMENTOS SEM AUTORIZAÇÃO NÃO SINALIZAR, FALHA DE BLOQUEIO, TORNAR DISPOSITIVOS DE SEGURANÇA INOPERANTES, USO DE IMPROPRIO DE EQUIPAMENTOS, USO DE ALCOOL E DROGAS, ENTRE OUTROS.
 (   ) CONDIÇÕES ABAIXO DO PADRÃO, (CONDIÇÃO INSEGURA );
 PROTEÇÃO AUSENTE  OU INADEQUADA , PERIGO DE EXPLOSÃO OU INCENDIO , AUSENCIA  DE ORDEM E LIMPEZA , EXPOSIÇÃO AOS AGENTES AMBIENTAIS NOCIVOS .'), 'RL', 'L', 0);

		$this->Cell(0, 4, utf8_decode('Preencher em caso de Acidente de Trajeto:  '), 'LTR', 0, 'L', 1);

		$this->Ln();

		$this->setFont('Arial', '', 7);
		$this->Cell(0, 4, utf8_decode('(   ) DA  RESIDENCIA PARA O TRABALHO'), 'LR', 0, 'L', 0);
		$this->Ln();
		$this->Cell(0, 4, utf8_decode('(   ) DO TRABALHO PARA SUA RESIDENCIA'), 'LR', 0, 'L', 0);
		$this->Ln();
		$this->Cell(0, 4, utf8_decode('(   ) DE IDA E PARA LOCAL DA REFEIÇÃO EM INTERVALO DE TRABALHO'), 'LR', 0, 'L', 0);
		$this->Ln();
		$this->Cell(0, 4, utf8_decode('(   ) DE VOLTA DO LOCAL DE REFEIÇÃO EM INTERVALO DE TRABALHO'), 'BLR', 0, 'L', 0);

		$this->Ln();

	}

}

$fpdf = new InvestigacaoView();

$fpdf->Dados($investigacao);

$fpdf->Output();
exit;

?>
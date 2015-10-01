<?php

$fpdf = new Fpdf();
$fpdf->AddPage();
$fpdf->SetFont('Arial', 'B', 16);
$fpdf->SetAutoPageBreak(false);

$fpdf->image(public_path().'/img/logo.png', 11, 11, 25, 11);
$fpdf->Cell(140, 8, 'Frizelo Frigorificos Ltda', 'LTR', 0, 'C');
$fpdf->SetFont('Arial', '', 9);
$fpdf->MultiCell(50, 8, utf8_decode('Numeração: ').$aso->id, 'TR', 1);

$fpdf->SetFont('Arial', '', 6);
$fpdf->Cell(140, 5, 'ROD. BR-262 - KM 375, ZONA SUBURBANA, TERENOS-MS FONE: (67) - 3246-8100', 'BLR', 0, 'C', 0);
$fpdf->SetFont('Arial', '', 9);
$fpdf->MultiCell(50, 5, 'Data: '.$aso->data, 'BR', 1);

$fpdf->SetFont('Arial', 'B', 12);
$fpdf->MultiCell(190, 9, utf8_decode('Medicina e Consultoria em Segurança do Trabalho'), 'BLR', 'L');

$fpdf->SetFont('Arial', '', 9);
$fpdf->MultiCell(190, 9, utf8_decode('Em cumprimento ao disposto no item 7.4.1 da NR 7 e Portaria N 24 de 24/14/84'), 'LRT', 'C');

$fpdf->SetFont('Arial', 'B', 12);
$fpdf->SetTextColor(150);
$fpdf->MultiCell(190, 9, utf8_decode('A.S.O. - Atestado de Saúde Ocupacional'), 'LRB', 'C');

$fpdf->SetTextColor(0);
$fpdf->SetFont('Arial', '', 9);
$fpdf->Cell(33, 7, utf8_decode('Matrícula: '.$aso->colaborador_matricula), 'LTR', 0, 'L');
$fpdf->Cell(97, 7, utf8_decode('Nome: '.$aso->colaborador_nome), 'LTR', 0, 'L');
$fpdf->Cell(60, 7, utf8_decode('RG: '.$aso->colaborador_rg.' '.$aso->colaborador_orgao_emissor), 'LTR', 0, 'L');
$fpdf->Ln();

$fpdf->Cell(30, 7, 'Sexo: '.$aso->colaborador_sexo_descricao, 'LTR', 0, 'L');
$fpdf->Cell(60, 7, 'Data de Nascimento: '.$aso->colaborador_data_nascimento, 'LTR', 0, 'L');
$fpdf->Cell(30, 7, 'Idade: '.$aso->colaborador_idade, 'LTR', 0, 'L');
$fpdf->Cell(70, 7, utf8_decode('Setor: '.$aso->setor), 'LTR', 0, 'L');
$fpdf->Ln();

$fpdf->Cell(95, 7, utf8_decode('Função: '.$aso->funcao_descricao), 'LTR', 0, 'L');
$fpdf->Cell(95, 7, utf8_decode('Data de Admissão: '.$aso->data_admissao), 'LTR', 0, 'L');
$fpdf->Ln();
$fpdf->Cell(190, 7, 'Posto de Trabalho: '.utf8_decode(!$aso->postoTrabalho?null:$aso->postoTrabalho->descricao), 'LTR', 0, 'L');
$fpdf->Ln();

$fpdf->SetFillColor(200);

if (!empty($aso->postoTrabalho)) {
	$fpdf->SetFont('Arial', '', 7);
	$fpdf->MultiCell(190, 6, utf8_decode('Atividades: '.implode(', ', $aso->postoTrabalho->atividades->lists('descricao'))), 'LTRB', 'L');
}
$fpdf->SetFont('Arial', 'B', 10);
$fpdf->Cell(190, 6, utf8_decode('Tipo de Exame Médico: ').strtoupper($aso->tipo), 'TLRB', 0, 'C', 1);
$fpdf->Ln();
$fpdf->SetFont('Arial', '', 9);
if ($aso->tipo == 'mudanca de funcao') {

	$novo = DB::table('farmacia.asos')->where('id', $aso->id)->first();

	$fpdf->Cell(0, 6, utf8_decode('NOVO POSTO DE TRABALHO'), 'TLRB', 0, 'C', 0);
	$fpdf->Ln();

	$fpdf->Cell(70, 7, utf8_decode('Setor: '.Setor::find($novo->colaborador_setor_id)->descricao), 'LTR', 0, 'L');
	$fpdf->Cell(0, 7, utf8_decode('Função: '.SetorFuncao::find($novo->colaborador_funcao_id)->descricao), 'LTR', 0, 'L');
	$fpdf->Ln();

	$fpdf->Cell(190, 7, 'Posto de Trabalho: '.utf8_decode(SetorPosto::find($novo->posto_id)->descricao), 'LTR', 0, 'L');
	$fpdf->Ln();
}

$fpdf->SetFont('Arial', 'B', 10);
$fpdf->Cell(190, 6, utf8_decode('Riscos'), 'TLRB', 0, 'C', 1);
$fpdf->Ln();

$fpdf->SetFont('Arial', '', 9);
$fpdf->SetFillColor(255);
$fpdf->Cell(38, 6, utf8_decode('Físicos'), 'TLRB', 0, 'C');
$fpdf->Cell(28, 6, utf8_decode('Químicos'), 'TLRB', 0, 'C');
$fpdf->Cell(28, 6, utf8_decode('Biológicos'), 'TLRB', 0, 'C');
$fpdf->Cell(43, 6, utf8_decode('Ergonomicos'), 'TLRB', 0, 'C');
$fpdf->Cell(53, 6, utf8_decode('Acidentes'), 'TLRB', 0, 'C');
$fpdf->Ln();

$fpdf->SetFont('Arial', '', 5);

$riscos = SetorPosto::riscos($aso->posto_id);
if (!empty(count($riscos))) {
	for ($i = 0; $i < count(max($riscos)); $i++) {
		if (!empty($riscos['Físico'][$i])) {
			if (SesmtPostoRisco::where('descricao', $riscos['Físico'][$i])->where('posto_id', $aso->posto_id)->count()) {
				$marca = '(  X  ) ';
			} else {
				$marca = '(     ) ';
			}
			$fpdf->Cell(38, 6, $marca.utf8_decode($riscos['Físico'][$i]), 'TLRB', 0, 'L');

		} else {
			$fpdf->Cell(38, 6, '', 'TLRB', 0, 'L');
		}
		if (!empty($riscos['Quimico'][$i])) {
			if (SesmtPostoRisco::where('descricao', $riscos['Quimico'][$i])->where('posto_id', $aso->posto_id)->count()) {
				$marca = '(  X  ) ';
			} else {
				$marca = '(     ) ';
			}
			$fpdf->Cell(28, 6, $marca.utf8_decode($riscos['Quimico'][$i]), 'TLRB', 0, 'L');

		} else {
			$fpdf->Cell(28, 6, '', 'TLRB', 0, 'L');
		}
		if (!empty($riscos['Biologico'][$i])) {
			if (SesmtPostoRisco::where('descricao', $riscos['Biologico'][$i])->where('posto_id', $aso->posto_id)->count()) {
				$marca = '(  X  ) ';
			} else {
				$marca = '(     ) ';
			}
			$fpdf->Cell(28, 6, $marca.utf8_decode($riscos['Biologico'][$i]), 'TLRB', 0, 'L');

		} else {
			$fpdf->Cell(28, 6, '', 'TLRB', 0, 'L');
		}
		$fpdf->SetFont('Arial', '', 4);
		if (!empty($riscos['Ergonomico'][$i])) {
			if (SesmtPostoRisco::where('descricao', $riscos['Ergonomico'][$i])->where('posto_id', $aso->posto_id)->count()) {
				$marca = '(  X  ) ';
			} else {
				$marca = '(     ) ';
			}
			$fpdf->Cell(43, 6, $marca.utf8_decode($riscos['Ergonomico'][$i]), 'TLRB', 0, 1, 'L');

		} else {
			$fpdf->Cell(43, 6, '', 'TLRB', 0, 'L');
		}
		$fpdf->SetFont('Arial', '', 5);

		if (!empty($riscos['Acidente'][$i])) {
			if (SesmtPostoRisco::where('descricao', $riscos['Acidente'][$i])->where('posto_id', $aso->posto_id)->count()) {
				$marca = '(  X  ) ';
			} else {
				$marca = '(     ) ';
			}
			$fpdf->Cell(53, 6, $marca.utf8_decode($riscos['Acidente'][$i]), 'TLRB', 0, 1, 'L');

		} else {
			$fpdf->Cell(53, 6, '', 'TLRB', 0, 'L');
		}

		$fpdf->Ln();
	}
} else {
	for ($i = 0; $i <= 4; $i++) {
		$fpdf->Cell(38, 6, '', 'TLRB', 0, 'L');
		$fpdf->Cell(38, 6, '', 'TLRB', 0, 'L');
		$fpdf->Cell(38, 6, '', 'TLRB', 0, 'L');
		$fpdf->Cell(38, 6, '', 'TLRB', 0, 'L');
		$fpdf->Cell(38, 6, '', 'TLRB', 0, 'L');
		$fpdf->Ln();
	}
}

$fpdf->SetFillColor(200);
$fpdf->SetFont('Arial', 'B', 10);
$fpdf->Cell(190, 6, utf8_decode('Exames Complementares'), 'TLRB', 0, 'C', 1);
$fpdf->Ln();

$fpdf->SetFont('Arial', '', 6);
$fpdf->Cell(38, 6, '(     ) '.utf8_decode('Hemograma'), 'TLRB', 0, 'L');
$fpdf->Cell(38, 6, '(     ) '.utf8_decode('Audiometria'), 'TLRB', 0, 'L');
$fpdf->Cell(38, 6, '(     ) '.utf8_decode('Creatina'), 'TLRB', 0, 'L');
$fpdf->Cell(38, 6, '(     ) '.utf8_decode('Lipidograma'), 'TLRB', 0, 'L');
$fpdf->Cell(38, 6, '(     ) '.utf8_decode('Tipo Sanguinea'), 'TLRB', 0, 'L');
$fpdf->Ln();

$fpdf->Cell(38, 6, '(     ) '.utf8_decode('Parasitológico de fezes'), 'TLRB', 0, 'L');
$fpdf->Cell(38, 6, '(     ) '.utf8_decode('Colesterol'), 'TLRB', 0, 'L');
$fpdf->Cell(38, 6, '(     ) '.utf8_decode('Raio X'), 'TLRB', 0, 'L');
$fpdf->Cell(38, 6, '(     ) '.utf8_decode('Sumario de Urina'), 'TLRB', 0, 'L');
$fpdf->Cell(38, 6, '(     ) '.utf8_decode('Brucelose'), 'TLRB', 0, 'L');
$fpdf->Ln();

$fpdf->Cell(38, 6, '(     ) '.utf8_decode('Espirometria'), 'TLRB', 0, 'L');
$fpdf->Cell(38, 6, '(     ) '.utf8_decode('Glicemia'), 'TLRB', 0, 'L');
$fpdf->Cell(38, 6, '(     ) '.utf8_decode('Trigliceridios'), 'TLRB', 0, 'L');
$fpdf->Cell(38, 6, '(     ) '.utf8_decode('Eletrocardiograma'), 'TLRB', 0, 'L');
$fpdf->Cell(38, 6, '(     ) '.utf8_decode('VDRL'), 'TLRB', 0, 'L');
$fpdf->Ln();

$fpdf->SetFillColor(200);
$fpdf->Cell(190, 6, utf8_decode('Observação quanto ao(s) exame(s) realizado(s): '), 'LR', 0, 'L', 0);
$fpdf->Ln();
$fpdf->Cell(190, 6, '', 'LRB', 0, 'L');
$fpdf->Ln();

$fpdf->SetFillColor(200);
$fpdf->SetFont('Arial', 'B', 10);
$fpdf->Cell(190, 6, utf8_decode('Conclusão sobre a capacidade laborativa'), 'TLRB', 0, 'C', 1);
$fpdf->Ln();

$fpdf->SetFont('Arial', '', 9);
$fpdf->Cell(60, 6, '(     ) '.utf8_decode('Apto para função que irá exercer'), 'LB', 0, 'L');
$fpdf->Cell(60, 6, '(     ) '.utf8_decode('Inapto'), 'B', 0, 'L');
$fpdf->Cell(70, 6, '', 'RB', 0, 'RB');
$fpdf->Ln();
$fpdf->SetFont('Arial', '', 6);
$fpdf->Cell(190, 6, utf8_decode('Descreva manualmente a aptidão para o trabalho em: Altura, Espaço Confinado, Ambientes Frios e Eletricidade'), 'TLR', 0, 'L', 0);
$fpdf->Ln();
$fpdf->Cell(190, 10, '', 'LRB', 0, 'L', 0);
$fpdf->Ln();

$fpdf->SetFillColor(200);
$fpdf->SetFont('Arial', 'B', 10);
$fpdf->Cell(190, 6, utf8_decode('Médico encarregado do exame'), 'TLRB', 0, 'C', 1);
$fpdf->Ln();

$fpdf->SetFont('Arial', '', 8);
$fpdf->MultiCell(190, 4, utf8_decode('Atesto, para fins de cumprimentos do que determina a norma Regulamentadora NR 7, que  o funcionário identificado na A.S.O. emitido, goza atualmente de aparente boa Saúde Física e Mental, não sendo portador de molestia, nem doenças infecto contagiosas.'), 'LBR', 'L', 0, 0);
$fpdf->Cell(190, 6, utf8_decode('Nome do Médico Responsavel: ').strtoupper($aso->medico), 'LBR', 0, 'L');
$fpdf->Ln();

$fpdf->Cell(63, 10, utf8_decode('Assinatura e carimbo com CRM: '), 'LR', 0, 'L');
$fpdf->Cell(63, 10, utf8_decode('Assinatura do Coordenador do P.C.M.S.O.: '), 'LR', 0, 'LJ');
$fpdf->Cell(64, 10, utf8_decode('Assinatura do empregado submetido ao exame: '), 'LR', 0, 'LJ');
$fpdf->Ln();

$fpdf->Cell(63, 20, '', 'LRB', 0, 'L');
$fpdf->Cell(63, 20, '_______________________________________', 'LRB', 0, 'L');
$fpdf->Cell(64, 20, '_______________________________________', 'LRB', 0, 'L');

$fpdf->Output();
exit;

?>
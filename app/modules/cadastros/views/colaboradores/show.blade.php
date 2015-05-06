<?php

$fpdf = new Fpdf();
$fpdf->AddPage();
$fpdf->SetFont('Arial', 'B', 16);
$fpdf->SetFillColor(200);

$fpdf->image(public_path().'/img/logo.png', 11, 11, 25, 11);
$fpdf->Cell(140, 8, 'Frizelo Frigorificos Ltda', 'LTR', 0, 'C');
$fpdf->SetFont('Arial', '', 9);
$fpdf->MultiCell(50, 8, utf8_decode('Matrícula: '.$colaborador->codigo_interno), 'TR', 1);

$fpdf->SetFont('Arial', '', 6);
$fpdf->Cell(140, 5, 'ROD. BR-262 - KM 375, ZONA SUBURBANA, TERENOS-MS FONE: (67) - 3246-8100', 'BLR', 0, 'C', 0);
$fpdf->SetFont('Arial', '', 9);
$fpdf->MultiCell(50, 5, utf8_decode('Situação :').$colaborador->situacao, 'BR', 1);
$fpdf->Ln();

$fpdf->Cell(145, 6, utf8_decode('Nome: '.$colaborador->nome), 'BRLT', 0);
$fpdf->Cell(45, 6, utf8_decode('Admissão: ').$colaborador->data_admissao, 'LTBR', 0);
$fpdf->Ln();

$fpdf->Cell(30, 6, utf8_decode('Sexo: ').$colaborador->sexoDescricao, 'BRLT', 0);
$fpdf->Cell(45, 6, utf8_decode('Data Nascimento: ').$colaborador->data_nascimento, 'BRLT', 0);
$fpdf->Cell(115, 6, utf8_decode('Setor: ').$colaborador->setor->descricao, 'LTBR', 0);

$fpdf->Ln();

$fpdf->Cell(70, 6, utf8_decode('Função: '.$colaborador->funcao), 'BRLT', 0);
$fpdf->Cell(120, 6, utf8_decode('Posto de Trabalho: '.$colaborador->postoTrabalho), 'BRLT', 0);
$fpdf->Ln(7);

//Informações da Farmacia
$fpdf->SetFont('Arial', 'B', 12);
$fpdf->Cell(190, 6, utf8_decode('Farmácia'), 'LTBR', 0, 'C');
$fpdf->Ln();
$fpdf->SetFont('Arial', '', 9);
$fpdf->Cell(190, 6, utf8_decode('Ocorrencias'), 'LTBR', 0, 'L', 1);
$fpdf->Ln();

$fpdf->SetFont('Arial', '', 6);

foreach ($colaborador->ocorrencias as $ocorrencia) {
	$fpdf->MultiCell(190, 4, str_replace('
', ' ', $ocorrencia->data_hora.': '.utf8_decode($ocorrencia->relato).' '.utf8_decode($ocorrencia->diagnostico).' '.utf8_decode($ocorrencia->conduta).' | '.$ocorrencia->profissional), 'LTBR', 'L');
}
//$fpdf->Ln();

$fpdf->SetFont('Arial', '', 9);
$fpdf->Cell(190, 6, utf8_decode('Atestados'), 'LTBR', 0, 'L', 1);
$fpdf->Ln();

$fpdf->SetFont('Arial', '', 6);

foreach ($colaborador->atestados as $atestado) {
	$fpdf->Cell(190, 4, utf8_decode($atestado->inicio_afastamento.' a '.$atestado->fim_afastamento.': '.$atestado->local_atendimento.' '.$atestado->getCid->descricao.' - Profissional: '.$atestado->profissional.' Cat: '.(!$atestado->cat?'Não':$atestado->cat)), 'LBR', 0, 'L');

	$fpdf->Ln();
}

$fpdf->Output();
exit;

?>

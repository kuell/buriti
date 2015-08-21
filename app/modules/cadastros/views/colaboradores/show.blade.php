<?php
Class ColaboradorView extends Fpdf {
	function Dados($colaborador) {
		$this->SetFont('Arial', 'B', 16);
		$this->SetFillColor(200);
		$this->image(public_path().'/img/logo.png', 11, 11, 25, 11);
		$this->Cell(140, 8, 'Frizelo Frigorificos Ltda', 'LTR', 0, 'C');
		$this->SetFont('Arial', '', 9);
		$this->MultiCell(50, 8, utf8_decode('Matrícula: '.$colaborador->codigo_interno), 'TR', 1);
		$this->SetFont('Arial', '', 6);
		$this->Cell(140, 5, 'ROD. BR-262 - KM 375, ZONA SUBURBANA, TERENOS-MS FONE: (67) - 3246-8100', 'BLR', 0, 'C', 0);
		$this->SetFont('Arial', '', 9);
		$this->MultiCell(50, 5, utf8_decode('Situação: ').strtoupper($colaborador->situacao), 'BR', 1);
		$this->Ln();
		$this->Cell(145, 6, utf8_decode('Nome: '.$colaborador->nome), 'BRLT', 0);
		$this->Cell(45, 6, utf8_decode('Admissão: ').$colaborador->data_admissao, 'LTBR', 0);
		$this->Ln();
		$this->Cell(30, 6, utf8_decode('Sexo: ').$colaborador->sexoDescricao, 'BRLT', 0);
		$this->Cell(45, 6, utf8_decode('Data Nascimento: ').$colaborador->data_nascimento, 'BRLT', 0);
		$this->Cell(115, 6, utf8_decode('Setor: ').$colaborador->setor->descricao, 'LTBR', 0);
		$this->Ln();
		$this->Cell(70, 6, utf8_decode('Função: '.$colaborador->funcao), 'BRLT', 0);
		$this->Cell(120, 6, utf8_decode('Posto de Trabalho: '.$colaborador->posto_descricao->descricao), 'BRLT', 0);
		$this->Ln(7);

		$this->ocorrencias($colaborador);

		if (!empty($colaborador->obs)) {
			$this->SetFont('Arial', '', 9);
			$this->Cell(190, 6, utf8_decode('Observações'), 'LTBR', 0, 'L', 1);
			$this->Ln();
			$this->MultiCell(190, 4, $colaborador->obs, 'LTBR', 'L');
		}
	}

	public function ocorrencias($colaborador) {

		if (count($colaborador->ocorrencias)) {

			$this->SetFont('Arial', 'B', 12);
			$this->Cell(190, 6, utf8_decode('Farmácia'), 'LTBR', 0, 'C');
			$this->Ln();

			if (count($colaborador->ocorrencias)) {
				$this->SetFont('Arial', '', 9);
				$this->Cell(190, 6, utf8_decode('Ocorrencias'), 'LTBR', 0, 'L', 1);
				$this->Ln();
				$this->SetFont('Arial', '', 6);

				foreach ($colaborador->ocorrencias as $ocorrencia) {
					$this->MultiCell(190, 4, str_replace('
		', ' ', $ocorrencia->data_hora.': '.utf8_decode($ocorrencia->relato).' '.utf8_decode($ocorrencia->diagnostico).' '.utf8_decode($ocorrencia->conduta).' | '.$ocorrencia->profissional.'-'.$ocorrencia->monitoramento), 'LTBR', 'L');

				}
			}

		}
	}

	function footer() {

		$this->SetY(-15);
		$this->SetFont("Arial", "I", 8);
		$this->SetDrawColor(200);
		$this->Cell(0, 4, utf8_decode("Página ").$this->PageNo()."Processado em ".date('d-m-Y h:i')." \ Periodo:  ".Input::get('periodo'), 0, 0, "C");
	}
}

$fpdf = new ColaboradorView();
$fpdf->AddPage();
$fpdf->Dados($colaborador);
$fpdf->Output();
exit;

?>

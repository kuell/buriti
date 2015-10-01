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
		$this->Cell(120, 6, utf8_decode('Posto de Trabalho: '.$colaborador->posto_trabalho->descricao), 'BRLT', 0);
		$this->Ln(7);

		$this->farmacia($colaborador);
	}

	public function farmacia($colaborador) {
		$this->SetFont('Arial', 'B', 12);
		$this->Cell(190, 6, utf8_decode('Farmácia'), 'LTBR', 0, 'C');
		$this->Ln();

		// -- Ocorrencias -- //
		if (count($colaborador->ocorrencias)) {

			if (count($colaborador->ocorrencias)) {
				$this->SetFont('Arial', '', 9);
				$this->Cell(190, 6, utf8_decode('Ocorrencias'), 'LTBR', 0, 'L', 1);
				$this->Ln();
				$this->SetFont('Arial', '', 6);

				foreach ($colaborador->ocorrencias()->monitoramento()->get() as $ocorrencia) {
					$this->Ln(1);

					$this->MultiCell(190, 4, str_replace('
		', ' ', $ocorrencia->data_hora.': '.utf8_decode($ocorrencia->relato).' '.utf8_decode($ocorrencia->diagnostico).' '.utf8_decode($ocorrencia->conduta).' | '.$ocorrencia->profissional), 'LRT', 'L', 0);

					if ($ocorrencia->atestados->count()) {

						$this->Cell(20, 4, utf8_decode('Inicio Atestado'), 'LTBR', 0, 'C');
						$this->Cell(20, 4, utf8_decode('Fim Atestado'), 'LTBR', 0, 'C');
						$this->Cell(20, 4, utf8_decode('Dias Afastamento'), 'LTBR', 0, 'C');
						$this->Cell(40, 4, utf8_decode('Local Atendimento'), 'LTBR', 0, 'L');
						$this->Cell(50, 4, utf8_decode('Cid - descrição'), 'LTBR', 0, 'L');
						$this->Cell(40, 4, utf8_decode('Profissional'), 'LTBR', 0, 'L');
						$this->Ln();

						foreach ($ocorrencia->atestados as $atestado) {
							$this->Cell(20, 4, Format::viewDate($atestado->inicio_afastamento), 'LTBR', 0, 'C');
							$this->Cell(20, 4, Format::viewDate($atestado->fim_afastamento), 'LTBR', 0, 'C');
							$this->Cell(20, 4, $atestado->dias_afastamento, 'LTBR', 0, 'C');
							$this->Cell(40, 4, $atestado->local, 'LTBR', 0, 'L');
							$this->Cell(50, 4, $atestado->cid.' - '.utf8_decode($atestado->getCid->descricao), 'LTBR', 0, 'L');
							$this->Cell(40, 4, utf8_decode($atestado->profissional), 'LTBR', 0, 'L');
							$this->Ln();
						}
					}

				}
			}
		}
		// -- Fim Ocorrencias -- //

		// -- Inicio Asos -- //
		if (count($colaborador->asos)) {
			$this->SetFont('Arial', '', 9);
			$this->Cell(190, 6, utf8_decode('Fichas Aso'), 'LTBR', 0, 'L', 1);
			$this->Ln();
			$this->SetFont('Arial', '', 6);

			foreach ($colaborador->asos as $aso) {
				$this->Cell(20, 4, Format::viewDate($aso->data), 'LT', 0, 'L');
				$this->Cell(40, 4, strtoupper($aso->tipo), 'T', 0, 'L');
				$this->Cell(40, 4, strtoupper($aso->medico), 'T', 0, 'L');
				$this->Cell(40, 4, strtoupper($aso->status), 'T', 0, 'L');
				$this->Cell(50, 4, strtoupper($aso->situacao), 'TR', 0, 'L');
				$this->Ln();

				if (count($aso->exames)) {
					$this->Cell(40, 3, strtoupper('Exame'), 'LTR', 0, 'L', 1);
					$this->Cell(15, 3, strtoupper('Data'), 'LTR', 0, 'L', 1);
					$this->Cell(15, 3, strtoupper('Validade'), 'LTR', 0, 'L', 1);
					$this->Cell(40, 3, utf8_decode(strtoupper('Local RealizaÇÃo')), 'LTR', 0, 'L', 1);
					$this->Cell(30, 3, strtoupper('Medico'), 'LTR', 0, 'L', 1);
					$this->Cell(30, 3, strtoupper('Resultado'), 'LTR', 0, 'L', 1);
					$this->Ln();

					foreach ($aso->exames as $exame) {
						$this->Cell(40, 3.5, utf8_decode($exame->descricao), 'L', 0, 'L');
						$this->Cell(15, 3.5, utf8_decode($exame->data), 0, 0, 'L');
						$this->Cell(15, 3.5, utf8_decode($exame->validade), 0, 0, 'L');
						$this->Cell(40, 3.5, utf8_decode($exame->local_realizacao), 0, 0, 'L');
						$this->Cell(30, 3.5, utf8_decode($exame->medico), 0, 0, 'L');
						$this->Cell(30, 3.5, utf8_decode($exame->resultado), 'R', 0, 'L');
						$this->Ln();
					}
					$this->Cell(0, 1, '', 'T');
				}
			}
		}
		// -- Fim Asos -- //

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

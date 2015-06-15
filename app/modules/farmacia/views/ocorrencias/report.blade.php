<?php
Class OcorrenciaReport extends Fpdf {

	public function Header() {
		$this->SetFont('Arial', 'B', 16);
		$this->SetFillColor(200);
		$this->image(public_path().'/img/logo.png', 11, 11, 25, 11);
		$this->Cell(230, 8, 'Frizelo Frigorificos Ltda', 'LTR', 0, 'C');
		$this->SetFont('Arial', '', 9);
		$this->MultiCell(50, 8, 'Relatorio de Ocorrencias', 'TR', 1);
		$this->SetFont('Arial', '', 6);
		$this->Cell(230, 5, 'ROD. BR-262 - KM 375, ZONA SUBURBANA, TERENOS-MS FONE: (67) - 3246-8100', 'BLR', 0, 'C', 0);
		$this->MultiCell(50, 5, '', 'BR', 1);
		$this->Ln();
	}

	public function colaboradors($returns) {
		$this->SetFillColor(200);
		foreach ($returns as $setor => $return) {
			$totalSetor[$setor] = 0;

			$this->AddPage();
			$this->Cell(280, 5, Setor::find($setor)->descricao, 'LTRB', 0, 'C', 1);

			$this->SetFillColor(230);

			$this->Ln();
			$this->Cell(60, 4, 'Nome', 'LTRB', 0, 'L', 1);
			$this->Cell(15, 4, 'Jan', 'LTRB', 0, 'C', 1);
			$this->Cell(15, 4, 'Fev', 'LTRB', 0, 'C', 1);
			$this->Cell(15, 4, 'Mar', 'LTRB', 0, 'C', 1);
			$this->Cell(15, 4, 'Abr', 'LTRB', 0, 'C', 1);
			$this->Cell(15, 4, 'Mai', 'LTRB', 0, 'C', 1);
			$this->Cell(15, 4, 'Jun', 'LTRB', 0, 'C', 1);
			$this->Cell(15, 4, 'Jul', 'LTRB', 0, 'C', 1);
			$this->Cell(15, 4, 'Ago', 'LTRB', 0, 'C', 1);
			$this->Cell(15, 4, 'Set', 'LTRB', 0, 'C', 1);
			$this->Cell(15, 4, 'Out', 'LTRB', 0, 'C', 1);
			$this->Cell(15, 4, 'Nov', 'LTRB', 0, 'C', 1);
			$this->Cell(15, 4, 'Dez', 'LTRB', 0, 'C', 1);
			$this->Cell(15, 4, 'Total', 'LTRB', 0, 'C', 1);
			$this->Ln();

			foreach ($returns[$setor] as $key => $return) {
				$this->Cell(60, 4, $key, 'LTRB', 0, 'L');

				for ($mes = 1; $mes <= 12; $mes++) {
					$this->Cell(15, 4, empty($returns[$setor][$key][2015][$mes])?0:$returns[$setor][$key][2015][$mes], 'LTRB', 0, 'C');
				}

				$this->Cell(15, 4, array_sum($returns[$setor][$key][2015]), 'LTRB', 0, 'C');

				$totalSetor[$setor] = array_sum($returns[$setor][$key][2015])+$totalSetor[$setor];

				$this->Ln();
			}
		}

	}

	public function setors($returns) {
		foreach (Setor::all() as $setor) {
			echo '<ul><li>'.$setor->descricao.'</li><ul>';

			foreach ($setor->colaboradores as $colaborador) {

				for ($mes = 1; $mes <= 12; $mes++) {
					$total[] = $colaborador                                    ->ocorrencias()->whereRaw("	extract(month from data_hora) = ? and
																	 	extract(year from data_hora) = 2015", [$mes])->count();
				}

				print_r($total);

			}

			echo '</ul></ul>';
		}
		die;

	}

	public function Dados($returns) {

		//$this->colaboradors($returns);
		$this->setors($returns);

		$this->Cell(280, 5, 'Total', 'LTRB', 0, 'C', 1);
	}
	/*	</tr>

@foreach($returns[$setor] as $key=>$return)
<tr>
<td>{{ $key }}</td>
@for($mes = 1; $mes <= 12; $mes++)
<td>{{ $returns[$setor][$key][2015][$mes] or 0}}</td>
@endfor
</tr>
@endforeach
@endforeach
 */
}

$fpdf = new OcorrenciaReport('L');
$fpdf->Dados($returns);
$fpdf->Output();
exit;

?>
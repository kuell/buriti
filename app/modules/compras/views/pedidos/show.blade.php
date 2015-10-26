<?php
class PedidoView extends RelatorioController {

	function Dados($pedido) {
		$this->SetFont("Arial", "", 9);
		$this->SetFillColor(200);

		$this->Cell(30, 5, 'Data do Pedido: ', 1, 0);
		$this->Cell(65, 5, date('d/m/Y H:i', strtotime($pedido->created_at)), 1, 0);

		$this->Cell(30, 5, 'Ordem Interna: ', 1, 0);
		$this->Cell(65, 5, '', 1, 0);
		$this->Ln();

		$this->Cell(30, 5, 'Solicitante: ', 1, 0);
		$this->Cell(0, 5, $pedido->solicitante, 1, 0);
		$this->Ln();

		$this->Cell(30, 5, 'Setor: ', 1, 0);
		$this->Cell(0, 5, $pedido->setor_id, 1, 0);
		$this->Ln();

		$this->MultiCell(0, 7, utf8_decode('Observação: '.utf8_decode($pedido->obs)), 'BRL', 'L');

		$this->Cell(0, 7, 'Lista de Produtos ', 1, 0, 'C', 1);
		$this->Ln();

		$this->SetFont("Arial", "", 7);

		$this->Cell(10, 5, '#', 1, 0, 1);
		$this->Cell(109, 5, utf8_decode('DESCRIÇÃO: '), 1, 0, 1);
		$this->Cell(15, 5, 'QTDE', 1, 0, 1);
		$this->Cell(15, 5, 'ESTQ', 1, 0, 1);
		$this->Cell(15, 5, 'TOTAL ', 1, 0, 1);
		$this->Cell(15, 5, 'PRIO ', 1, 0, 1);
		$this->Cell(11, 5, 'STATUS ', 1, 0, 1);
		$this->Ln();

		foreach ($pedido->produtos as $produto) {
			$this->SetFont("Arial", "", 6);
			$this->Cell(10, 5, $produto->produto_id, 1, 0);
			$this->Cell(109, 5, utf8_decode($produto->produto->descricao.' - '.$produto->produto->unidade_medida), 1, 0);
			$this->Cell(15, 5, number_format($produto->qtd, 2, ',', '.'), 1, 0, 'R');
			$this->Cell(15, 5, number_format($produto->estoque, 2, ',', '.'), 1, 0, 'R');
			$this->Cell(15, 5, number_format(($produto->qtd+$produto->estoque), 2, ',', '.'), 1, 0, 'R');
			$this->Cell(15, 5, $produto->prioridade, 1, 0, 'R');
			$this->Cell(11, 5, strtoupper(substr($produto->situacao, 0, 5)), 1, 0, 'R');
			$this->Ln();
		}
		$this->SetFont("Arial", "", 7);

		$this->Cell(0, 20, '', 0, 0, 'C');
		$this->Ln();

		$this->Cell(0, 5, '___________________________________________', 0, 0, 'C');
		$this->Ln();

		$this->Cell(0, 1, $pedido->solicitante, 0, 0, 'C');
		$this->Ln();

		$this->SetFont("Arial", "I", 7);
		$this->Cell(0, 4, " Gerado em: ".date("d/m/Y"), 'B', 0, "R");

	}

}
$pdf            = new PedidoView("P", "mm", "A4");
$pdf->tituloDoc = 'SOLICITAÇÃO DE COMPRAS - Nº: '.$pedido->id;
$pdf->AddPage();
$pdf->SetDisplayMode('fullwidth');
$pdf->Dados($pedido);
$pdf->Output();
exit;
?>
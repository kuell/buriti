<?php

class OcorrenciaAtestado extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'farmacia.ocorrencia_atestados';

	public function ocorrencia() {
		return $this->belongsTo('Ocorrencia', 'ocorrencia_id');
	}

	public function getCid() {
		return $this->belongsTo('FarmaciaCid', 'cid', 'cod_cid');

	}

	public function getPeriodoAfastamentoAttribute() {
		if (empty($this->attributes['inicio_afastamento']) or empty($this->attributes['fim_afastamento'])) {
			return null;
		} else {
			$inicio = implode('/', array_reverse(explode('-', $this->attributes['inicio_afastamento'])));
			$fim    = implode('/', array_reverse(explode('-', $this->attributes['fim_afastamento'])));

			return $inicio.' - '.$fim;
		}

	}

	public function getDiasAfastamentoAttribute() {
		$data1 = new DateTime($this->attributes['inicio_afastamento']);
		$data2 = new DateTime($this->attributes['fim_afastamento']);

		$interval = $data1->diff($data2);

		return $interval->d;
	}

	public function getCidDescricaoAttribute() {
		if (empty($this->attributes['cid']) or $this->attributes['cid'] == 0) {
			return 'CID nao encontrado!';
		} else {
			$cid = FarmaciaCid::where('cod_cid', '=', $this->attributes['cid'])->first();

			return $cid->descricao;
		}
	}

	public function getTipoDescricaoAttribute() {

		if ($this->attributes['tipo'] == 0) {

			if ($this->ocorrencia->sesmt == 'SIM') {
				return 'CAT';
			} else {

				return 'CONSULTA';
			}

		} else if ($this->attributes['tipo'] == 1) {
			return "ACOMPANHANTE";
		} else {
			return "ERRO NO PROCESSAMENTO";
		}
	}

	public static function relatorioAtestados() {

		Excel::create('Planilha de Controle da Farmacia - Atestado / Cesta Básica', function ($excel) {
				$excel->sheet('Excel sheet', function ($sheet) {

						$sheet->mergeCells('A1:J5');
						$sheet->setHeight(1, 50);

						$sheet->row(1, function ($row) {
								$row->setFontFamily('Arial');
								$row->setFontSize(20);
							});

						$sheet->cell('A1', function ($cell) {
								$cell->setAlignment('center');
							});

						$sheet->row(1, array('Frizelo Frigorificos Ltda.'));

						$sheet->setAutoFilter('A6:J6');
						$sheet->setOrientation('landscape');

						$input = Input::all();
						$periodo = explode(' - ', $input['periodo']);

						$atestados = OcorrenciaAtestado::whereBetween('inicio_afastamento', $periodo)->get();
						$return = null;

						foreach ($atestados as $atestado) {
							if (empty($atestado->getCid->descricao)) {
								$cid = $atestado->cid;
							} else {
								$cid = $atestado->getCid->cod_cid.' - '.$atestado->getCid->descricao;
							}

							$return[] = [
								'matricula'       => $atestado->ocorrencia->colaborador->codigo_interno,
								'nome'            => $atestado->ocorrencia->colaborador->nome,
								'setor'           => $atestado->ocorrencia->colaborador->setor->descricao,
								'data inicio'     => Format::viewDate($atestado->inicio_afastamento),
								'fim afastamento' => Format::viewDate($atestado->fim_afastamento),
								'descricao'       => $atestado->tipoDescricao,
								'obs'             => $atestado->obs,
								'cid'             => $cid,
								'medico'          => $atestado->profissional,
								'Total Dias'      => $atestado->dias_afastamento
							];
						}

						$sheet->fromArray($return, null, 'A6', true);

					});
			})->export('xls');

	}

}
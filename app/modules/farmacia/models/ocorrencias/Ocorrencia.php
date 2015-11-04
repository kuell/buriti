<?php

class Ocorrencia extends Eloquent {
	protected $guarded = array();
	protected $table   = "farmacia.ocorrencias";
	public $rules      = [
		'colaborador_id' => 'required'
	];

	public function scopeAcidentes($query) {
		return $query->where('sesmt', true);
	}

	public function scopeFinalizadas($query) {
		return $query->where('situacao', 'finalizada');
	}

	public function scopeMonitoramento($query) {
		return $query->where('monitoramento', false);
	}

	public function medicamentos() {
		return $this->hasMany('OcorrenciaMedicacao', 'ocorrencia_id');
	}

	public function atestados() {
		return $this->hasMany('OcorrenciaAtestado');
	}

	public function planoAcaos() {
		return $this->hasMany('PlanoAcao');
	}

	public function queixa() {
		return $this->belongsTo('Queixa');
	}

	public function getDataHoraAttribute() {
		return date('d/m/Y H:i', strtotime($this->attributes['data_hora']));
	}

	public function getCodigoInternoAttribute() {
		$this->attributes['codigo_interno'] = Colaborador::find($this->attributes['colaborador_id'])->codigo_interno;
	}

	public function getElementoAttribute() {
		if (!empty($this->attributes['elemento_id'])) {
			return FarmaciaElemento::find($this->attributes['elemento_id']);
		} else {
			return null;
		}
	}

	public function colaborador() {
		return $this->belongsTo('Colaborador', 'colaborador_id');
	}

	public function investigacao() {
		return $this->hasOne('Investigacao');
	}

	public static function getRelatorioOperacoes() {

		Excel::create('Planilha de Controle da Farmacia - Ocorrencias', function ($excel) {
				$excel->sheet('Ref. ', function ($sheet) {
						$sheet->mergeCells('A1:J5');
						$sheet->setHeight(1, 50);
						$sheet->row(1, function ($row) {
								$row->setFontFamily('Arial');
								$row->setFontSize(20);
							});
						$sheet->cell('A1', function ($cell) {
								$cell->setAlignment('center');
							});
						$sheet->getStyle('D')->getAlignment()->setWrapText(true);
						$sheet->row(1, array('Frizelo Frigorificos Ltda.'));
						$periodo = explode('-', Input::get('periodo'));

						$a = [];

						foreach (Ocorrencia::whereBetween('data_hora', $periodo)->get() as $val) {
							$a[] = [
								'Nome'                 => $val->colaborador->nome,
								'Setor'                => !empty($val->colaborador->setor->descricao)?$val->colaborador->setor->descricao:null,
								'Data'                 => $val->data_hora,
								'Queixa'               => empty($val->queixa->descricao)?null:$val->queixa->descricao,
								'Descrição / Motivo' => $val->relato.' - '.$val->diagnostico,
								'Conduta / Destino'    => $val->conduta.' - '.$val->destino
							];
						}

						$sheet->setAutoFilter('A6:J6');
						$sheet->setOrientation('landscape');
						$sheet->fromArray($a, null, 'A6', true);
					});
			})->export('xls');

	}

	public function setElementoIdAttribute($elemento_id = null) {
		if (!$elemento_id) {
			return null;
		} else {
			return $this->attributes['elemento_id'] = $elemento_id;
		}
	}

	public function getHoraAttribute() {
		$hora = explode(' ', $this->attributes['data_hora']);

		return $hora[1];
	}

	public function getMonitoramentoDescricaoAttribute() {
		if (!$this->attributes['monitoramento']) {
			return 'NAO';
		} else {
			return 'SIM';
		}
	}

	public function getMonitoramentoAttribute() {
		if (!$this->attributes['monitoramento']) {
			return 0;
		} else {
			return 1;
		}
	}

	public function getDataOcorrenciaAttribute() {
		$hora = explode(' ', $this->attributes['data_hora']);

		return Format::viewDate($hora[0]);
	}

	public function getSesmtDescricaoAttribute() {
		if (!empty($this->attributes['sesmt'])) {
			return 'SIM';
		} else {
			return 'NÃO';
		}
	}

	public function getCondutaAttribute() {
		if (empty($this->attributes['conduta'])) {

			if (count($this->medicamentos) != 0) {
				foreach ($this->medicamentos as $medicamento) {
					$conduta[] = $medicamento->qtd.' - '.$medicamento->medicacao->descricao.' ('.strtoupper($medicamento->medida).')';
				}
				return implode(' / ', $conduta);
			} else {
				return null;
			}

		} else {
			return $this->attributes['conduta'];
		}
	}

	public function setSetorIdAttribute($setor_id) {
		return $this->attributes['setor_id'] = $this->colaborador->setor_id;
	}

}
<?php

class SetorPosto extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'posto_trabalhos';

	public function atividades() {
		return $this->hasMany('SetorPostoAtividade', 'posto_id');
	}

	public function colaboradors() {
		return $this->hasMany('Colaborador', 'posto_id');
	}

	public function ocorrencias() {
		return $this->hasMany('Ocorrencia', 'posto_id');
	}

	public static function riscos($posto_id) {
		$riscos = SesmtPostoRisco::where('situacao', 'ativo')->distinct()->get();
		$res    = [];

		foreach ($riscos as $val) {
			$res[$val->tipo][] = $val->descricao;
			$res[$val->tipo]   = array_unique($res[$val->tipo]);
			$res[$val->tipo]   = array_merge($res[$val->tipo]);
		}

		return $res;

	}

	public function setor() {
		return $this->belongsTo('Setor', 'setor_id');

	}

	public function asos() {
		return $this->hasMany('Aso', 'posto_id');
	}

	public function getQuantDiasPerdidos() {

		$qtd = DB::select('	select
								coalesce(sum(b.fim_afastamento - b.inicio_afastamento),0) as total
							from
								farmacia.ocorrencias a
								inner join farmacia.ocorrencia_atestados b on a.id = b.ocorrencia_id
								inner join setors c on a.setor_id = c.id
							where
								a.setor_id = ? and
								a.posto_id = ?', [$this->attributes['setor_id'], $this->attributes['id']]);

		return $qtd[0]->total;

	}

	public function getAfasttMenor15() {

		$qtd = DB::select('	select
								coalesce(sum(b.fim_afastamento - b.inicio_afastamento),0) as total
							from
								farmacia.ocorrencias a
								inner join farmacia.ocorrencia_atestados b on a.id = b.ocorrencia_id
								inner join setors c on a.setor_id = c.id
							where
								a.setor_id = ? and
								a.posto_id = ?
							group by
								a.posto_id', [$this->attributes['setor_id'], $this->attributes['id']]);

		$count = 0;

		foreach ($qtd as $total) {

			if ($total->total < 15) {
				$count++;
			}
		}

		return $count;
	}

	public function getAfasttMaior15() {

		$qtd = DB::select('	select
								coalesce(sum(b.fim_afastamento - b.inicio_afastamento),0) as total
							from
								farmacia.ocorrencias a
								inner join farmacia.ocorrencia_atestados b on a.id = b.ocorrencia_id
								inner join setors c on a.setor_id = c.id
							where
								a.setor_id = ? and
								a.posto_id = ?
							group by
								a.posto_id', [$this->attributes['setor_id'], $this->attributes['id']]);

		$count = 0;

		foreach ($qtd as $total) {

			if ($total->total > 15) {
				$count++;
			}
		}

		return $count;
	}

	public function getSemAfast() {

		$qtd = DB::select('	select
								coalesce(sum(b.fim_afastamento - b.inicio_afastamento),0) as total
							from
								farmacia.ocorrencias a
								inner join farmacia.ocorrencia_atestados b on a.id = b.ocorrencia_id
								inner join setors c on a.setor_id = c.id
							where
								a.setor_id = ? and
								a.posto_id = ?
							group by
								a.posto_id', [$this->attributes['setor_id'], $this->attributes['id']]);

		$count = 0;

		foreach ($qtd as $total) {

			if ($total->total == 0) {
				$count++;
			}
		}

		return $count;
	}

}
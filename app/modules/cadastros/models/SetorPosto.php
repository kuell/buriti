<?php

class SetorPosto extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'posto_trabalhos';

	public function atividades() {
		return $this->hasMany('SetorPostoAtividade', 'posto_id');
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

}
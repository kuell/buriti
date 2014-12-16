<?php

class OrdemInternaServico extends Eloquent{
	protected $guarded = [];

	public function prazos(){
		return $this->hasMany('OrdemInternaPrazo', 'servico_id');
	}

	public static function prazo($servico_id, $show = false){
		$prazo = DB::table('ordem_interna_prazos')->select('prazo')
												  ->where('servico_id', $servico_id)
												  ->orderBy('id', 'desc')->limit(1)->first();
			if(empty($prazo->prazo)){
				if($show){
					return "_________";
				}
				else{
					return "0";
				}
			}
			else{
				return $prazo->prazo;
			}
	}

}
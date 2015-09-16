<?php
class FichaCurso extends Eloquent {
	protected $guarded = array();
	protected $table   = 'cadastros.ficha_cursos';

	public function getConcluidoAttribute() {
		if ($this->attributes['concluido']) {
			return 'Sim';
		} else {
			return 'Não';
		}
	}
}
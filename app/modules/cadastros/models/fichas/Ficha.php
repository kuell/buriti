<?php

class Ficha extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'cadastros.fichas';

	public $rules = array(
		'pretencao'       => 'required',
		'nome'            => 'required|unique:cadastros.fichas',
		'sexo'            => 'required',
		'data_nascimento' => 'required',
		'naturalidade'    => 'required',
		'nacionalidade'   => 'required',
		'endereco'        => 'required',
		'bairro'          => 'required',
		'cidade'          => 'required',
		'cep'             => 'required',
		'fone'            => 'required',
		'estado_civil'    => 'required',
		'filhos'          => 'required',
		'pai'             => 'required',
		'mae'             => 'required',
		'rg'              => 'required|unique:cadastros.fichas,situacao,0',
		'cpf'             => 'required',
		'emissao'         => 'required',
		'titulo_eleitor'  => 'required',
		'reservista'      => 'required',
		'ctps'            => 'required',
		'pis'             => 'required',
	);

	public function setors() {
		return $this->hasMany('FichaSetor');
	}

	public function instrucaos() {
		return $this->hasMany('FichaInstrucao');
	}

	public function cursos() {
		return $this->hasMany('FichaCurso');
	}

	public function empregos() {
		return $this->hasMany('FichaEmprego');
	}

	public function parentes() {
		return $this->hasMany('FichaParente');
	}

	public function getIdadeAttribute() {
		if (!empty($this->attributes['data_nascimento'])) {
			return date('Y-m-d')-$this->attributes['data_nascimento'];
		} else {
			return null;
		}

	}

	public function getDataNascimentoAttribute() {
		if (!empty($this->attributes['data_nascimento'])) {
			return Format::viewDate($this->attributes['data_nascimento']);
		}

	}

	public function getSetoresAttribute() {
		$setors = [];

		foreach ($this->setors as $setor) {
			$setors[] = $setor->setor->descricao;
		}

		return $setors;

	}

	public function getFotoAttribute() {
		if (empty($this->attributes['foto'])) {
			return '/img/users/no_image.jpg';
		} else {
			return '/img/fichas/'.$this->attributes['foto'];
		}
	}

	public function getPretencaoAttribute() {
		if (!empty($this->attributes['pretencao'])) {
			return Format::valorView($this->attributes['pretencao']);
		}

	}

	public function setFotoAttribute($foto) {

		if ($foto) {
			$file            = $foto;
			$destinationPath = 'img/fichas';
			$extension       = $file->getClientOriginalExtension();

			$filename = $this->attributes['nome'].'.'.$extension;
			$foto->move($destinationPath, $filename);

			return $this->attributes['foto'] = $filename;
		} else {
			return null;
		}
	}

	public function setUsuarioAddAttribute() {
		return $this->attributes['usuario_add'] = Auth::user()->user;
	}

	public function setPretencaoAttribute($valor) {
		if ($valor) {
			return $this->attributes['pretencao'] = Format::valorDb($valor);
		}

	}

}
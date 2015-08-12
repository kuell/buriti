<?php

// Composer: "fzaninotto/faker": "v1.3.0"

class TipoOcorrenciaTableSeeder extends Seeder {

	public function run() {
		DB::statement('truncate table farmacia.ocorrencia_tipos restart identity');

		$tipos = [
			[
				'descricao'  => 'ACIDENTE',
				'pai_id'     => 0,
				'created_at' => 'now()',
				'updated_at' => 'now()'
			],
			[
				'descricao'  => 'INCIDENTE',
				'pai_id'     => 0,
				'created_at' => 'now()',
				'updated_at' => 'now()'
			],
			[
				'descricao'  => 'DOENÇA DO TRABALHO',
				'pai_id'     => 0,
				'created_at' => 'now()',
				'updated_at' => 'now()'
			],
			[
				'descricao'  => 'DOENÇA OCUPACIONAL',
				'pai_id'     => 0,
				'created_at' => 'now()',
				'updated_at' => 'now()'
			],
			[
				'descricao'  => 'QUEIXAS GERAIS',
				'pai_id'     => 0,
				'created_at' => 'now()',
				'updated_at' => 'now()'
			]
		];

		DB::table('farmacia.ocorrencia_tipos')->insert($tipos);

	}

}
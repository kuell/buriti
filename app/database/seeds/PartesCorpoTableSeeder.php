<?php

// Composer: "fzaninotto/faker": "v1.3.0"

class PartesCorpoTableSeeder extends Seeder {

	public function run() {
		DB::statement('truncate table farmacia.parte_corpo restart identity');

		$partes = [
			['id'        => 1,
				'descricao' => 'CABEÇA'],
			['id'        => 2,
				'descricao' => 'TRONCO'],
			['id'        => 3,
				'descricao' => 'MEMBROS'],
			['id'        => 4,
				'descricao' => 'OUTROS'],

			['id' => 5, 'descricao' => 'CRÂNIO', 'pai_id' => 1],
			['id' => 6, 'descricao' => 'BRAÇO', 'pai_id' => 3],
			['id' => 7, 'descricao' => 'POSTERIOR DA COXA', 'pai_id' => 3],
			['id' => 8, 'descricao' => 'PÉ DIREITO', 'pai_id' => 3],
			['id' => 9, 'descricao' => 'PÉ ESQUERDO', 'pai_id' => 3],
			['id' => 10, 'descricao' => 'CABEÇA', 'pai_id' => 1],
			['id' => 11, 'descricao' => 'OUVIDOS', 'pai_id' => 1],
			['id' => 12, 'descricao' => 'COTOVELO', 'pai_id' => 3],
			['id' => 13, 'descricao' => 'DORSO', 'pai_id' => 2],
			['id' => 14, 'descricao' => 'QUADRIL', 'pai_id' => 2],
			['id' => 15, 'descricao' => 'DEDO PÉ', 'pai_id' => 3],
			['id' => 16, 'descricao' => 'NARIZ', 'pai_id' => 1],
			['id' => 17, 'descricao' => 'MANDIBULA', 'pai_id' => 1],
			['id' => 18, 'descricao' => 'ANTE-BRAÇO', 'pai_id' => 3],
			['id' => 19, 'descricao' => 'TORAX', 'pai_id' => 2],
			['id' => 20, 'descricao' => 'QUADRICEPS FEMORAL', 'pai_id' => 3],
			['id' => 21, 'descricao' => 'COLUNA TORAX', 'pai_id' => 2],
			['id' => 22, 'descricao' => 'ORELHA', 'pai_id' => 1],
			['id' => 23, 'descricao' => 'OMBRO', 'pai_id' => 3],
			['id' => 24, 'descricao' => 'PUNHO', 'pai_id' => 2],
			['id' => 25, 'descricao' => 'ESTOMAGO', 'pai_id' => 2],
			['id' => 26, 'descricao' => 'PERNA', 'pai_id' => 3],
			['id' => 27, 'descricao' => 'COLUNA LOMBAR', 'pai_id' => 2],
			['id' => 28, 'descricao' => 'BOCA', 'pai_id' => 1],
			['id' => 29, 'descricao' => 'CLAVICULA', 'pai_id' => 2],
			['id' => 30, 'descricao' => 'MÃO', 'pai_id' => 3],
			['id' => 31, 'descricao' => 'ABDOME', 'pai_id' => 2],
			['id' => 32, 'descricao' => 'TORNOZELO', 'pai_id' => 3],
			['id' => 33, 'descricao' => 'COLUNA CERVICAL', 'pai_id' => 2],
			['id' => 34, 'descricao' => 'OLHOS', 'pai_id' => 1],
			['id' => 35, 'descricao' => 'CORPO', 'pai_id' => 2],
			['id' => 36, 'descricao' => 'SISTEMA IMUNOLOGICO', 'pai_id' => 4]

		];

		foreach ($partes as $parte) {
			ParteCorpo::create($parte);
		}
	}

}
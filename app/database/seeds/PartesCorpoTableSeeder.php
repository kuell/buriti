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

			['id' => 5, 'descricao' => 'OLHO DIREITO', 'pai_id' => 1],
			['id' => 6, 'descricao' => 'OLHO ESQUERDO', 'pai_id' => 1],
			['id' => 7, 'descricao' => 'ORELHA DIREITA', 'pai_id' => 1],
			['id' => 8, 'descricao' => 'ORELHA ESQUERDA', 'pai_id' => 1],
			['id' => 9, 'descricao' => 'OUVIDO DIREITO', 'pai_id' => 1],
			['id' => 10, 'descricao' => 'OUVIDO ESQUERDO', 'pai_id' => 1],
			['id' => 11, 'descricao' => 'MANDIBULA', 'pai_id' => 1],
			['id' => 12, 'descricao' => 'NARIZ', 'pai_id' => 1],
			['id' => 13, 'descricao' => 'BOCA', 'pai_id' => 1],
			['id' => 14, 'descricao' => 'CRANIO', 'pai_id' => 1],
			['id' => 15, 'descricao' => 'FACE', 'pai_id' => 1],

			['id' => 16, 'descricao' => 'PESCOÇO', 'pai_id' => 2],
			['id' => 17, 'descricao' => 'NUCA', 'pai_id' => 2],
			['id' => 18, 'descricao' => 'TÓRAX', 'pai_id' => 2],
			['id' => 19, 'descricao' => 'DORSO', 'pai_id' => 2],
			['id' => 20, 'descricao' => 'REGIÃO GLUTEA', 'pai_id' => 2],
			['id' => 21, 'descricao' => 'ABDOMEN', 'pai_id' => 2],
			['id' => 22, 'descricao' => 'QUADRIL', 'pai_id' => 2],
			['id' => 23, 'descricao' => 'CLAVÍCULA', 'pai_id' => 2],

			['id' => 24, 'descricao' => 'OMBRO DIREITO', 'pai_id' => 3],
			['id' => 25, 'descricao' => 'OMBRO ESQUERDO', 'pai_id' => 3],
			['id' => 26, 'descricao' => 'BRAÇO DIREITO', 'pai_id' => 3],
			['id' => 27, 'descricao' => 'BRAÇO ESQUERDO', 'pai_id' => 3],
			['id' => 28, 'descricao' => 'COTOVELO DIREITO', 'pai_id' => 3],
			['id' => 29, 'descricao' => 'COTOVELO ESQUERDO', 'pai_id' => 3],
			['id' => 30, 'descricao' => 'ANTEBRAÇO DIREITO', 'pai_id' => 3],
			['id' => 31, 'descricao' => 'ANTEBRAÇO ESQUERDO', 'pai_id' => 3],
			['id' => 32, 'descricao' => 'PULSO DIREITO', 'pai_id' => 3],
			['id' => 33, 'descricao' => 'PULSO ESQUERDO', 'pai_id' => 3],
			['id' => 34, 'descricao' => 'MÃO DIREITO', 'pai_id' => 3],
			['id' => 35, 'descricao' => 'MÃO ESQUERDO', 'pai_id' => 3],
			['id' => 36, 'descricao' => 'PELVES', 'pai_id' => 3],
			['id' => 37, 'descricao' => 'COXA ESQUERDO', 'pai_id' => 3],
			['id' => 38, 'descricao' => 'COXA DIREITO', 'pai_id' => 3],
			['id' => 39, 'descricao' => 'JOELHO DIREITO', 'pai_id' => 3],
			['id' => 40, 'descricao' => 'JOELHO ESQUERDO', 'pai_id' => 3],
			['id' => 41, 'descricao' => 'PERNA DIREITO', 'pai_id' => 3],
			['id' => 42, 'descricao' => 'PERNA ESQUERDO', 'pai_id' => 3],
			['id' => 43, 'descricao' => 'TORNOZELO DIREITO', 'pai_id' => 3],
			['id' => 44, 'descricao' => 'TORNOZELO ESQUERDO', 'pai_id' => 3],
			['id' => 45, 'descricao' => 'PÉ DIREITO', 'pai_id' => 3],
			['id' => 46, 'descricao' => 'PÉ ESQUERDO', 'pai_id' => 3],
			['id' => 47, 'descricao' => 'PUNHO DIREITO', 'pai_id' => 3],
			['id' => 48, 'descricao' => 'PUNHO ESQUERDO', 'pai_id' => 3],

			['id' => 49, 'descricao' => 'SISTEMA IMUNOLÓGICO', 'pai_id' => 4]

		];

		foreach ($partes as $parte) {
			ParteCorpo::create($parte);
		}
	}

}
<?php

// Composer: "fzaninotto/faker": "v1.3.0"

class NaturezaLesaoTableSeeder extends Seeder {

	public function run() {
		$naturezas = [
			['descricao' => 'corte'],
			['descricao' => 'pancada'],
			['descricao' => 'escoriações'],
			['descricao' => 'fraturas']
		];

		foreach ($naturezas as $natureza) {
			NaturezaLesao::create(
				$natureza
			);
		}
	}

}
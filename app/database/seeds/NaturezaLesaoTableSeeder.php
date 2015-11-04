<?php

// Composer: "fzaninotto/faker": "v1.3.0"

class NaturezaLesaoTableSeeder extends Seeder {

	public function run() {
		$naturezas = [
			['descricao' => 'FERIMENTO CORTE'],
			['descricao' => 'INTOXICAÇÃO'],
			['descricao' => 'FRATURA'],
			['descricao' => 'RADIAÇÃO'],
			['descricao' => 'FERIMENTO INCISO'],
			['descricao' => 'QUEIMADURAS'],
			['descricao' => 'LUXAÇÃO'],
			['descricao' => 'CONTUSÃO'],
			['descricao' => 'ENTORSE'],
			['descricao' => 'DISTENSÃO'],
			['descricao' => 'TORSÃO'],
			['descricao' => 'DOENÇA INFECTOCONTAGIOSA'],
			['descricao' => 'PANCADAS'],
			['descricao' => 'PERFURAÇÕES'],
			['descricao' => 'ESCORIAÇÕES'],
			['descricao' => 'AMPUTAÇÃO']
		];

		foreach ($naturezas as $natureza) {
			NaturezaLesao::create(
				$natureza
			);
		}
	}

}
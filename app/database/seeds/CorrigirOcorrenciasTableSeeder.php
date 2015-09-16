<?php

// Composer: "fzaninotto/faker": "v1.3.0"

class CorrigirOcorrenciasTableSeeder extends Seeder {

	public function run() {
		foreach (Ocorrencia::all() as $ocorrencia) {
			$colaborador = $ocorrencia->colaborador;

			$ocorrencia->setor_id = $colaborador->setor_id;
			$ocorrencia->posto_id = $colaborador->posto_id;

			$ocorrencia->save();
		}
	}

}
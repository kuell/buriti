<?php

class ColaboradorTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */

	public function run() {
		$ponteiro = fopen("public/homem.txt", "r");
		$admissao = "";
		while (!feof($ponteiro)) {
			$linha = fgets($ponteiro, 4096);

			$d = explode('\n ', $linha);
			if ($d[0] != null) {
				$cod      = (substr($d[0], 0, 5));
				$restante = explode('Funcao', substr($d[0], 6));
				$nome     = $restante[0];
				$restante = explode('Admissao: ', substr($d[0], 6));
				if (!empty($restante[1])) {
					$admissao = ($restante[1]);
				}

				$colaborador                 = new Colaborador();
				$colaborador->nome           = $nome;
				$colaborador->codigo_interno = $cod;
				$colaborador->data_admissao-$admissao;
				$colaborador->sexo    = true;
				$colaborador->interno = false;

				if ($colaborador->nome != null) {
					$colaborador->save();
				}
			}
		}

		$ponteiro = fopen("public/mulher.txt", "r");
		$admissao = "";

		while (!feof($ponteiro)) {
			$linha = fgets($ponteiro, 4096);

			$d = explode('\n ', $linha);
			if ($d[0] != null) {
				$cod      = (substr($d[0], 0, 5));
				$restante = explode('Funcao', substr($d[0], 6));
				$nome     = $restante[0];
				$restante = explode('Admissao: ', substr($d[0], 6));
				if (!empty($restante[1])) {
					$admissao = ($restante[1]);
				}

				$colaborador                 = new Colaborador();
				$colaborador->nome           = $nome;
				$colaborador->codigo_interno = $cod;
				$colaborador->data_admissao-$admissao;
				$colaborador->sexo    = false;
				$colaborador->interno = false;

				if ($colaborador->nome != null) {
					$colaborador->save();
				}
			}
			//echo 'Codigo = '.$cod.' - Nome = '.$nome.'Admissao: '.$admissao.'<br />';

		}

		fclose($ponteiro);
	}
}

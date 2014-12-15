<?php

class FarmaciaCidSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */

	public function run() {
		$ponteiro = fopen("public/cid.txt", "r");

		while (!feof($ponteiro)) {
			$linha = fgets($ponteiro, 4096);

			$d = explode(';;', $linha);
			if (!empty($d[0])) {
				$cid = new FarmaciaCid();

				$cid->cod_cid   = $d[0];
				$cid->descricao = substr(utf8_encode($d[1]), 0, 255);

				$cid->save();
			}
		}

		fclose($ponteiro);
	}
}

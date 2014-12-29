<?php

class SetorTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */

	public function run() {
		$subMenu = new Menu();
		$subMenu->id = 10;
		$subMenu->descricao = "Setor";
		$subMenu->menu_pai = 2;
		$subMenu->url = '/cadastro/setors/';
		$subMenu->save();

	}
}

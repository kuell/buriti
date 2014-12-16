<?php

class OrdemInternaSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */

	public function run() {
		$menu = New Menu();
			$menu->descricao = "Ordem Interna";
			$menu->id = 8;
		
			$menuId = $menu->save();

		$subMenu = new Menu();
			$subMenu->id = 9;
			$subMenu->descricao = "Inclusão de Ordem Interna";
			$subMenu->menu_pai = 8;
			$subMenu->url = 'osi';
		$subMenu->save();

	}
}

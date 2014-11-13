<?php

class MenuTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */

	public function run() {

		DB::table('menus')->truncate();
		DB::table('usuario_permissao')->truncate();

		$menu =
		array(
			array(
				'id'         => 1,
				'descricao'  => 'Cadastro',
				'url'        => null,
				'icone'      => null,
				'indice'     => null,
				'menu_pai'   => null,
				'created_at' => 'now()',
				'updated_at' => 'now()',
			),
			array(
				'id'         => 2,
				'descricao'  => 'Farmacia',
				'url'        => null,
				'icone'      => null,
				'indice'     => null,
				'menu_pai'   => null,
				'created_at' => 'now()',
				'updated_at' => 'now()',
			),
			array(
				'id'         => 3,
				'descricao'  => 'Departamento Pessoa',
				'url'        => null,
				'icone'      => null,
				'indice'     => null,
				'menu_pai'   => null,
				'created_at' => 'now()',
				'updated_at' => 'now()',
			)
		);

		DB::table('menus')->insert($menu);
	}
}

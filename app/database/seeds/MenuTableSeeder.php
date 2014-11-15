<?php

class MenuTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */

	public function run() {

		DB::table('menus')->truncate();

		$menu =
		array(
			array(
				'id'         => 1,
				'descricao'  => 'Usuarios e Permissões',
				'url'        => null,
				'icone'      => null,
				'indice'     => null,
				'menu_pai'   => null,
				'created_at' => 'now()',
				'updated_at' => 'now()',
			),

			array(
				'id'         => 2,
				'descricao'  => 'Cadastros',
				'url'        => null,
				'icone'      => null,
				'indice'     => null,
				'menu_pai'   => null,
				'created_at' => 'now()',
				'updated_at' => 'now()',
			),

			array(
				'id'         => 7,
				'descricao'  => 'Colaboradores',
				'url'        => '/cadastro/colaborador/',
				'icone'      => null,
				'indice'     => null,
				'menu_pai'   => 2,
				'created_at' => 'now()',
				'updated_at' => 'now()',
			),

			array(
				'id'         => 3,
				'descricao'  => 'Farmacia',
				'url'        => null,
				'icone'      => null,
				'indice'     => null,
				'menu_pai'   => null,
				'created_at' => 'now()',
				'updated_at' => 'now()',
			),

			array(
				'id'         => 4,
				'descricao'  => 'Livro de Ocorrencias',
				'url'        => '/farmacia/ocorrencias/',
				'icone'      => null,
				'indice'     => null,
				'menu_pai'   => 3,
				'created_at' => 'now()',
				'updated_at' => 'now()',
			),

			array(
				'id'         => 5,
				'descricao'  => 'Lançamento de Atestados',
				'url'        => '/farmacia/atestados/',
				'icone'      => null,
				'indice'     => null,
				'menu_pai'   => 3,
				'created_at' => 'now()',
				'updated_at' => 'now()',
			),

			array(
				'id'         => 6,
				'descricao'  => 'Perfil',
				'url'        => '/acesso/user/',
				'icone'      => null,
				'indice'     => null,
				'menu_pai'   => 1,
				'created_at' => 'now()',
				'updated_at' => 'now()',
			)
		);

		DB::table('menus')->insert($menu);
	}
}

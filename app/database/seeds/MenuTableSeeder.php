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
				'descricao'  => 'Usuarios',
				'url'        => '/users',
				'icone'      => 'ion ion-person-add',
				'indice'     => '',
				'menu_pai'   => null,
				'created_at' => 'now()',
				'updated_at' => 'now()',
				'color'      => 'blue',

			),

			array(
				'id'         => 2,
				'descricao'  => 'Cadastros',
				'url'        => 'cadastro',
				'icone'      => null,
				'indice'     => null,
				'menu_pai'   => null,
				'created_at' => 'now()',
				'updated_at' => 'now()',
				'color'      => null,
			),

			array(
				'id'         => 3,
				'descricao'  => 'Farmacia',
				'url'        => '/farmacia',
				'icone'      => 'fa fa-plus-square',
				'indice'     => null,
				'menu_pai'   => null,
				'created_at' => 'now()',
				'updated_at' => 'now()',
				'color'      => 'red',
			),

			array(
				'id'         => 4,
				'descricao'  => 'Livro de Ocorrencias',
				'url'        => 'ocorrencias',
				'icone'      => 'glyphicon glyphicon-list-alt',
				'indice'     => null,
				'menu_pai'   => 3,
				'created_at' => 'now()',
				'updated_at' => 'now()',
				'color'      => null,
			),

			array(
				'id'         => 5,
				'descricao'  => 'Lançamento de Atestados',
				'url'        => 'atestados',
				'icone'      => 'glyphicon glyphicon-file',
				'indice'     => null,
				'menu_pai'   => 3,
				'created_at' => 'now()',
				'updated_at' => 'now()',
				'color'      => null,
			),

			array(
				'id'         => 6,
				'descricao'  => 'Perfil',
				'url'        => '/perfil',
				'icone'      => null,
				'indice'     => null,
				'menu_pai'   => 1,
				'created_at' => 'now()',
				'updated_at' => 'now()',
				'color'      => null,
			),

			array(
				'id'         => 7,
				'descricao'  => 'Colaboradores',
				'url'        => '/colaboradors',
				'icone'      => 'fa-male',
				'indice'     => null,
				'menu_pai'   => 2,
				'created_at' => 'now()',
				'updated_at' => 'now()',
				'color'      => null,
			),

			array(
				'id'         => 8,
				'descricao'  => 'Setor',
				'url'        => '/setors',
				'icone'      => 'fa-gear',
				'indice'     => null,
				'menu_pai'   => 2,
				'created_at' => 'now()',
				'updated_at' => 'now()',
				'color'      => null,
			),

			array(
				'id'         => 9,
				'descricao'  => 'SESMT',
				'url'        => '/sesmt',
				'icone'      => 'fa fa-plus-circle inverse',
				'indice'     => null,
				'menu_pai'   => null,
				'created_at' => 'now()',
				'updated_at' => 'now()',
				'color'      => 'green',
			),

			array(
				'id'         => 10,
				'descricao'  => 'Investigação',
				'url'        => 'investigacao',
				'icone'      => 'fa-search-plus',
				'indice'     => null,
				'menu_pai'   => 9,
				'created_at' => 'now()',
				'updated_at' => 'now()',
				'color'      => null,
			)
		);

		DB::table('menus')->insert($menu);

		$menu = Menu::all();

		foreach ($menu as $value) {
			$res = UsuarioPermissao::where('usuario_id', '=', 1)
				->where('menu_id', '=', $value->id)->count();
			if ($res == 0) {
				$permissao             = new UsuarioPermissao();
				$permissao->usuario_id = 1;
				$permissao->menu_id    = $value->id;
				$permissao->save();
			}
		}
	}
}

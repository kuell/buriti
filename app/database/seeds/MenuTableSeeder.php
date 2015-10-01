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
				'icone'      => 'glyphicon glyphicon-zoom-in',
				'indice'     => null,
				'menu_pai'   => 9,
				'created_at' => 'now()',
				'updated_at' => 'now()',
				'color'      => null,
			),
			array(
				'id'         => 11,
				'descricao'  => 'Ficha A.S.O.',
				'url'        => 'aso',
				'icone'      => 'glyphicon glyphicon-folder-open',
				'indice'     => null,
				'menu_pai'   => 3,
				'created_at' => 'now()',
				'updated_at' => 'now()',
				'color'      => null,
			),
			array(
				'id'         => 12,
				'descricao'  => 'Gerenciar Riscos',
				'url'        => 'risco',
				'icone'      => 'glyphicon glyphicon-exclamation-sign',
				'indice'     => null,
				'menu_pai'   => 9,
				'created_at' => 'now()',
				'updated_at' => 'now()',
				'color'      => null,
			),
			array(
				'id'         => 13,
				'descricao'  => 'Medicamentos',
				'url'        => 'medicamentos',
				'icone'      => 'glyphicon glyphicon-briefcase',
				'indice'     => null,
				'menu_pai'   => 3,
				'created_at' => 'now()',
				'updated_at' => 'now()',
				'color'      => null,
			),
			array(
				'id'         => 14,
				'descricao'  => 'Manutenção',
				'url'        => 'manutencao',
				'icone'      => 'glyphicon glyphicon-cog',
				'indice'     => null,
				'menu_pai'   => null,
				'created_at' => 'now()',
				'updated_at' => 'now()',
				'color'      => 'yellow',
			),
			array(
				'id'         => 15,
				'descricao'  => 'Ordem Interna',
				'url'        => 'osi',
				'icone'      => 'glyphicon glyphicon-wrench',
				'indice'     => null,
				'menu_pai'   => 14,
				'created_at' => 'now()',
				'updated_at' => 'now()',
				'color'      => 'yellow',
			),
			array(
				'id'         => 16,
				'descricao'  => 'Compras',
				'url'        => 'compras',
				'icone'      => 'glyphicon glyphicon-shopping-cart',
				'indice'     => null,
				'menu_pai'   => null,
				'created_at' => 'now()',
				'updated_at' => 'now()',
				'color'      => 'purple',
			),
			array(
				'id'         => 17,
				'descricao'  => 'Fichas',
				'url'        => '/fichas',
				'icone'      => 'fa-list-alt',
				'indice'     => null,
				'menu_pai'   => 2,
				'created_at' => 'now()',
				'updated_at' => 'now()',
				'color'      => null,
			),
			array(
				'id'         => 18,
				'descricao'  => 'Analise de Ocorrencias',
				'url'        => 'analise',
				'icone'      => 'glyphicon glyphicon-file',
				'indice'     => null,
				'menu_pai'   => 9,
				'created_at' => 'now()',
				'updated_at' => 'now()',
				'color'      => null,
			),
			array(
				'id'         => 19,
				'descricao'  => 'Causas / Queixas',
				'url'        => 'queixas',
				'icone'      => 'glyphicon glyphicon-tint',
				'indice'     => null,
				'menu_pai'   => 3,
				'created_at' => 'now()',
				'updated_at' => 'now()',
				'color'      => null,
			),
			array(
				'id'         => 20,
				'descricao'  => 'Tipos de Ocorrencia',
				'url'        => 'tipo_ocorrencia',
				'icone'      => 'glyphicon glyphicon-th-list',
				'indice'     => null,
				'menu_pai'   => 3,
				'created_at' => 'now()',
				'updated_at' => 'now()',
				'color'      => null,
			),
			array(
				'id'         => 21,
				'descricao'  => 'Relatorios',
				'url'        => 'relatorios',
				'icone'      => 'glyphicon glyphicon-signal',
				'indice'     => null,
				'menu_pai'   => 3,
				'created_at' => 'now()',
				'updated_at' => 'now()',
				'color'      => null,
			),
			array(
				'id'         => 22,
				'descricao'  => 'Ficha ASO - Ajustes',
				'url'        => 'aso_ajustes',
				'icone'      => 'glyphicon glyphicon-signal',
				'indice'     => null,
				'menu_pai'   => 3,
				'created_at' => 'now()',
				'updated_at' => 'now()',
				'color'      => null,
			),
			array(
				'id'         => 23,
				'descricao'  => 'Cadastros',
				'url'        => 'cadastros',
				'icone'      => 'glyphicon glyphicon-signal',
				'indice'     => null,
				'menu_pai'   => 3,
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

<?php

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$user = array(
			'nome'     => 'Tiago do C. Correa',
			'user'     => 'tiago',
			'password' => Hash::make('aporedux'),
			'ativo'    => true
		);

		$id = User::create($user);

	}
}

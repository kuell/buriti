<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Eloquent::unguard();

		// $this->call('InternoTableSeeder');
		//$this->call('UserTableSeeder');
		$this->call('MenuTableSeeder');
		//$this->call('FarmaciaCidSeeder');
	}

}

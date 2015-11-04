<?php

use Illuminate\Database\Migrations\Migration;

class AlterFichasSexoCorrigeSexo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		DB::statement('alter table cadastros.fichas add column sexo_bkp boolean');
		DB::statement('update
						cadastros.fichas
							set
								sexo_bkp = false
							where
								id in (select
									id
								from
									cadastros.fichas a
								where
									a.sexo = true)');
		DB::statement('update
						cadastros.fichas
							set
								sexo_bkp = true
							where
								id in (select
									id
								from
									cadastros.fichas a
								where
									a.sexo = false)');

		DB::statement('alter table cadastros.fichas drop column sexo');
		DB::statement('alter table cadastros.fichas rename column sexo_bkp to sexo');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		//
	}

}

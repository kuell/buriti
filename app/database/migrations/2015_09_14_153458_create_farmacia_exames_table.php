<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFarmaciaExamesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('farmacia.exames', function (Blueprint $table) {
				$table->increments('id');
				$table->string('descricao');
				$table->timestamps();
			});

		DB::table('farmacia.exames')->truncate();

		DB::select('insert into farmacia.exames(descricao, created_at, updated_at)
						Select
							distinct(descricao) as descricao,
							now() as created_at,
							now() as updated_at
						from
							farmacia.aso_exames');

		DB::select('update
						farmacia.aso_exames
					set
						exame_id = (select id
									from farmacia.exames
									where descricao = farmacia.aso_exames.descricao)');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('farmacia.exames');
	}

}

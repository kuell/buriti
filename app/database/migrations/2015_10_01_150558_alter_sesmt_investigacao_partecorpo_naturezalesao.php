<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterSesmtInvestigacaoPartecorpoNaturezalesao extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('sesmt.investigacaos', function (Blueprint $table) {
				$table->dropColumn(['natureza_lesao_id', 'parte_corpo_id']);
			});

		Schema::create('sesmt.investigacao_partes_corpo', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('investigacao_id');
				$table->integer('parte_corpo_id');
				$table->string('user_created');
				$table->timestamps();
			});

		Schema::create('sesmt.investigacao_natureza_lesaos', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('investigacao_id');
				$table->integer('natureza_lesao_id');
				$table->string('user_created');
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('sesmt.investigacaos', function (Blueprint $table) {
				$table->integer('natureza_lesao_id')->nullable();
				$table->integer('parte_corpo_id')->nullable();
			});

		Schema::dropIfExists('sesmt.investigacao_partes_corpo');
		Schema::dropIfExists('sesmt.investigacao_natureza_lesaos');
	}

}

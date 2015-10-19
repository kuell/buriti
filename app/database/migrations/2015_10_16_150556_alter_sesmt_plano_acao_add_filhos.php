<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterSesmtPlanoAcaoAddFilhos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('sesmt.plano_acaos', function (Blueprint $table) {
				$table->dropColumn('ocorrencia_id');
			});

		Schema::table('sesmt.plano_acaos', function (Blueprint $table) {
				$table->integer('pai_id')->nullable();
				$table->integer('ocorrencia_id')->nullable();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('sesmt.plano_acaos', function (Blueprint $table) {
				$table->dropColumn('pai_id');
				$table->dropColumn('ocorrencia_id');
			});
	}

}

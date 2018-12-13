<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminResourceTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$tableName = config('admin-resource.table_name');
		$columnNames = config('admin-resource.column_names');
		Schema::create($tableName, function (Blueprint $table) use ($columnNames) {
			$table->string($columnNames['model_type']);
			$table->unsignedBigInteger($columnNames['model_key']);
			$table->unsignedBigInteger($columnNames['model_admin_key']);
			$table->index([$columnNames['model_admin_key'], $columnNames['model_type']]);

			$table->primary([$columnNames['model_admin_key'], $columnNames['model_type']],
				'model_has_admin_resource_primary');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		$tableName = config('admin-resource.table_name');

		Schema::drop($tableName);
	}
}

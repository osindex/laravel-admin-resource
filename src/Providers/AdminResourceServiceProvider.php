<?php

namespace Osi\AdminResource\Providers;

use Illuminate\Support\ServiceProvider;

class AdminResourceServiceProvider extends ServiceProvider {
	public function boot() {
		if (isNotLumen()) {
			$this->publishes([
				__DIR__ . '/config/admin-resource.php' => config_path('admin-resource.php'),
			], 'config');

			if (!class_exists('CreateAdminResourceTables')) {
				$timestamp = date('Y_m_d_His', time());

				$this->publishes([
					__DIR__ . '/database/migrations/create_admin_resource_tables.php.stub' => $this->app->databasePath() . "/migrations/{$timestamp}_create_admin_resource_tables.php",
				], 'migrations');
			}
		}
	}

	public function register() {
		if (isNotLumen()) {
			$this->mergeConfigFrom(
				__DIR__ . '/config/admin-resource.php',
				'admin-resource'
			);
		}

	}

}

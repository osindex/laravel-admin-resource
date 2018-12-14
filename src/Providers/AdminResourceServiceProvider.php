<?php

namespace Osi\AdminResource\Providers;

use Illuminate\Support\ServiceProvider;

class AdminResourceServiceProvider extends ServiceProvider {
	public function boot() {
		if (isNotLumen()) {
			$this->publishes([
				__DIR__ . '/../config/admin-resource.php' => config_path('admin-resource.php'),
			], 'config');

			if (!class_exists('CreateAdminResourceTable')) {
				$timestamp = date('Y_m_d_His', time());

				$this->publishes([
					__DIR__ . '/../database/migrations/create_admin_resource_table.php.stub' => $this->app->databasePath() . "/migrations/{$timestamp}_create_admin_resource_table.php",
				], 'migrations');
			}
		}
	}

	public function register() {
		if (isNotLumen()) {
			$this->mergeConfigFrom(
				__DIR__ . '/../config/admin-resource.php',
				'admin-resource'
			);
		}
		// 在容器中注册
		// $this->app->singleton('AdminResource', function () {
		// 	return new \Osi\AdminResource\Models\AdminResource;
		// });
		// $this->app->singleton('AdminOneResource', function () {
		// 	return new \Osi\AdminResource\Traits\AdminOneResource;
		// });
		// $this->app->singleton('AdminOneResource', function () {
		// 	return new \Osi\AdminResource\Traits\AdminManyResource;
		// });
		// $this->app->alias(\Osi\AdminResource\Models\AdminResource::class, 'AdminResource');
		// $this->app->alias(\Osi\AdminResource\Traits\AdminManyResource::class, 'AdminManyResource');
		// $this->app->alias(\Osi\AdminResource\Traits\AdminOneResource::class, 'AdminOneResource');
	}

}

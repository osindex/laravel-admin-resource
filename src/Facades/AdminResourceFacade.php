<?php
namespace Osi\AdminResource\Facades;

use Illuminate\Support\Facades\Facade as LaravelFacade;
use Osi\AdminResource\Models\AdminResource;

/**
 * Facade for Laravel.
 */
class AdminResourceFacade extends LaravelFacade {
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() {
		return AdminResource::class;
	}
}

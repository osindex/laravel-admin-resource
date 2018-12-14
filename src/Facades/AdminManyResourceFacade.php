<?php
namespace Osi\AdminResource\Facades;

use Illuminate\Support\Facades\Facade as LaravelFacade;
use Osi\AdminResource\Traits\AdminManyResource as AdminResource;

/**
 * Facade for Laravel.
 */
class AdminManyResourceFacade extends LaravelFacade {
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() {
		return AdminResource::class;
	}
}

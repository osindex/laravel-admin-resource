<?php
namespace Osi\AdminResource\Facades;

use Illuminate\Support\Facades\Facade as LaravelFacade;
use Osi\AdminResource\Traits\AdminOneResource as AdminResource;

/**
 * Facade for Laravel.
 */
class AdminOneResourceFacade extends LaravelFacade {
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() {
		return AdminResource::class;
	}
}

<?php
namespace Osi\AdminResource\Traits;

use Osi\AdminResource\Scopes\AutoAdminHasOneScope;
trait AdminOneResource {

	/**
	 * Autocephaly
	 *
	 * @return void
	 */
	protected static function initializeAdminOneResource() {
		static::addGlobalScope(new AutoAdminHasOneScope);
	}
}
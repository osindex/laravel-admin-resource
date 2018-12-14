<?php
namespace Osi\AdminResource\Traits;

use Osi\AdminResource\Scopes\AutoAdminHasOneScope;
trait AdminOneResource {
	public $useAdminResource = true;
	/**
	 * Autocephaly
	 *
	 * @return void
	 */
	protected static function initializeAdminOneResource() {
		static::addGlobalScope(new AutoAdminHasOneScope);
	}
}
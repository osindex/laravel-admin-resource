<?php
namespace Osi\AdminResource\Traits;

use Osi\AdminResource\Scopes\AutoAdminHasManyScope;
trait AdminManyResource {
	public $useAdminResource = true;
	/**
	 * Autocephaly
	 *
	 * @return void
	 */
	protected static function initializeAdminManyResource() {
		static::addGlobalScope(new AutoAdminHasManyScope);
	}
}
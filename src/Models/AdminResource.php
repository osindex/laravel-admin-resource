<?php

namespace Osi\AdminResource\Models;

use Illuminate\Database\Eloquent\Model;

class AdminResource extends Model {
	protected $table = config('admin-resource.table_name','admin_resource');
}

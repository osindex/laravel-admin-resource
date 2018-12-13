# laravel-admin-resource

## useage
```
use Osi\AdminResource\Traits\AdminOneResource;

#like:
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Osi\AdminResource\Traits\AdminOneResource;

class Zoo extends Model {
	use AdminOneResource;
	// public $model_admin_key = 'admin_id';
	// public $force = ture;
}
Zoo{id,admin_id,title...}
auto-query: select * from Zoo where admin_id = \Auth:id()
if(force){
	show admin_id = \Auth:id() resource
}else{
	if not exists
	show all 
	else 
	show admin_id = \Auth:id() resource
}

```
```
#not over
use Osi\AdminResource\Traits\AdminManyResource;

```
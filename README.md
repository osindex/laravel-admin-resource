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
use Osi\AdminResource\Traits\AdminManyResource;

#like:
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Osi\AdminResource\Traits\AdminManyResource;

class Zoo extends Model {
	use AdminManyResource;
	// public $model_table_key = 'id';
}

Zoo{id,title...}
Admin{id,...}

AdminResouce{model_type,model_id,admin_id}
auto-query:
select * from Zoo where id in (select model_id from AdminResouce where admin_id = x and model_type = 'Zoo')
#if force === false also show all data


# if you want use MorphToMany define $model_type = 'table_name' like:
Animal{id,Zoo_id,...}

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Osi\AdminResource\Traits\AdminManyResource;
use Zoo;

class Animal extends Model {
	use AdminManyResource;
	public $model_type = Zoo::getTable();
}



```
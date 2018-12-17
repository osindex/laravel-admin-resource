<?php

namespace Osi\AdminResource\Models;

use Illuminate\Database\Eloquent\Model;

class AdminResource extends Model {
	protected $primaryKey = ['admin_id', 'model_type']; // or null
	public $incrementing = false;
	protected $keyType = 'array';
	protected $table = 'admin_resource';
	protected $guarded = [];
	// protected $fillable = ['*'];
	public $timestamps = false;
	function __construct() {
		$this->table = config('admin-resource.table_name', 'admin-resource');
	}
	public static function getConfig() {
		return config('admin-resource.column_names', ['model_id' => 'model_id', 'model_type' => 'model_type', 'model_admin_key' => 'admin_id']);
	}
	public static function Set(String $model_type, $model_id, $admin_id) {
		// $query = new static();updateOrCreate
		$config_column_names = self::getConfig();
		// static::$unguarded = false;
		// firstOrCreate 未知原因不生效
		// $res = static::firstOrCreate([$config_column_names['model_type'] => $model_type, $config_column_names['model_id'] => $model_id, $config_column_names['model_admin_key'] => $admin_id]);
		$data = [$config_column_names['model_type'] => $model_type, $config_column_names['model_id'] => $model_id, $config_column_names['model_admin_key'] => $admin_id];
		$res = static::where($data)->first();
		if (is_null($res)) {
			$res = static::insert($data);
		}
		return $data;
	}
	public static function sync(String $model_type, $model_id, $admin_id) {
		$config_column_names = self::getConfig();
		static::ForgetByAdmin($model_type, $admin_id);
		if (!is_array($model_id)) {
			$model_id = explode(',', $model_id);
		}
		$data = [];
		foreach ($model_id as $md) {
			$data[] = [$config_column_names['model_type'] => $model_type, $config_column_names['model_id'] => $md, $config_column_names['model_admin_key'] => $admin_id];
		}
		$res = static::insert($data);
		return $data;
	}
	public static function Get($model_type, $admin_id) {
		$config_column_names = self::getConfig();
		$res = static::when(is_array($model_type), function ($query) use ($config_column_names, $model_type) {
			return $query->whereIn($config_column_names['model_type'], $model_type);
		}, function ($query) use ($config_column_names, $model_type) {
			return $query->where($config_column_names['model_type'], $model_type);
		})->when(is_array($admin_id), function ($query) use ($config_column_names, $admin_id) {
			return $query->whereIn($config_column_names['model_admin_key'], $admin_id);
		}, function ($query) use ($config_column_names, $admin_id) {
			return $query->where($config_column_names['model_admin_key'], $admin_id);
		})->get();
		return $res;
	}
	public static function GetByAdmin($model_type, $admin_id) {
		return static::Get($model_type, $admin_id);
	}
	public static function GetByModel($model_type, $model_id) {
		$config_column_names = self::getConfig();
		$res = static::when(is_array($model_type), function ($query) use ($config_column_names, $model_type) {
			return $query->whereIn($config_column_names['model_type'], $model_type);
		}, function ($query) use ($config_column_names, $model_type) {
			return $query->where($config_column_names['model_type'], $model_type);
		})->when(is_array($model_id), function ($query) use ($config_column_names, $model_id) {
			return $query->whereIn($config_column_names['model_id'], $model_id);
		}, function ($query) use ($config_column_names, $model_id) {
			return $query->where($config_column_names['model_id'], $model_id);
		})->get();
		return $res;
	}
	public static function Forget(String $model_type, $admin_id) {
		$config_column_names = self::getConfig();
		if (is_array($admin_id)) {
			$res = static::where($config_column_names['model_type'], $model_type)->whereIn($config_column_names['model_admin_key'], $admin_id)->delete();
		} else {
			$res = static::where([$config_column_names['model_type'] => $model_type, $config_column_names['model_admin_key'] => $admin_id])->delete();
		}
		return $res;
	}
	public static function ForgetByAdmin(String $model_type, $admin_id) {
		$config_column_names = self::getConfig();
		if (is_array($admin_id)) {
			$res = static::where($config_column_names['model_type'], $model_type)->whereIn($config_column_names['model_admin_key'], $admin_id)->delete();
		} else {
			$res = static::where([$config_column_names['model_type'] => $model_type, $config_column_names['model_admin_key'] => $admin_id])->delete();
		}
		return $res;
	}
	public static function ForgetByModel(String $model_type, $model_id) {
		$config_column_names = self::getConfig();
		if (is_array($model_id)) {
			$res = static::where($config_column_names['model_type'], $model_type)->whereIn($config_column_names['model_id'], $model_id)->delete();
		} else {
			$res = static::where([$config_column_names['model_type'] => $model_type, $config_column_names['model_id'] => $model_id])->delete();
		}
		return $res;
	}
}
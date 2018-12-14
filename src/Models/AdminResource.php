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
		return config('admin-resource.column_names', ['model_key' => 'model_id', 'model_type' => 'model_type', 'model_admin_key' => 'admin_id']);
	}
	public static function Set(String $model_type, $model_id, $admin_id) {
		// $query = new static();updateOrCreate
		$config_column_names = self::getConfig();
		// static::$unguarded = false;
		// firstOrCreate 未知原因不生效
		// $res = static::firstOrCreate([$config_column_names['model_type'] => $model_type, $config_column_names['model_key'] => $model_id, $config_column_names['model_admin_key'] => $admin_id]);
		$data = [$config_column_names['model_type'] => $model_type, $config_column_names['model_key'] => $model_id, $config_column_names['model_admin_key'] => $admin_id];
		$res = static::where($data)->first();
		if (is_null($res)) {
			$res = static::insert($data);
		}
		return $data;
	}
	public static function Get(String $model_type, $admin_id) {
		$config_column_names = self::getConfig();
		$res = static::where([$config_column_names['model_type'] => $model_type, $config_column_names['model_admin_key'] => $admin_id])->get();
		return $res;
	}
	public static function GetByAdmin(String $model_type, $admin_id) {
		$config_column_names = self::getConfig();
		$res = static::where([$config_column_names['model_type'] => $model_type, $config_column_names['model_admin_key'] => $admin_id])->get();
		return $res;
	}
	public static function GetByModel(String $model_type, $model_id) {
		$config_column_names = self::getConfig();
		$res = static::where([$config_column_names['model_type'] => $model_type, $config_column_names['model_key'] => $model_id])->count();
		return $res;
	}
	public static function Forget(String $model_type, $admin_id) {
		$config_column_names = self::getConfig();
		$res = static::where([$config_column_names['model_type'] => $model_type, $config_column_names['model_admin_key'] => $admin_id])->delete();
		return $res;
	}
	public static function ForgetByAdmin(String $model_type, $admin_id) {
		$config_column_names = self::getConfig();
		$res = static::where([$config_column_names['model_type'] => $model_type, $config_column_names['model_admin_key'] => $admin_id])->delete();
		return $res;
	}
	public static function ForgetByModel(String $model_type, $model_id) {
		$config_column_names = self::getConfig();
		$res = static::where([$config_column_names['model_type'] => $model_type, $config_column_names['model_key'] => $model_id])->delete();
		return $res;
	}
}
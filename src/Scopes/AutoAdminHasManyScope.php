<?php

namespace Osi\AdminResource\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class AutoAdminHasManyScope implements Scope {
	/**
	 * 应用作用域到给定的Eloquent查询构建器.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $builder
	 * @param  \Illuminate\Database\Eloquent\Model  $model
	 * @return void
	 */
	public function apply(Builder $builder, Model $model) {
		if (\Auth::id()) {
			$column_names = config('admin-resource.column_names');
			$force = is_null($model->force) ? $column_names['forceMany'] : $model->force;
			$model_admin_key = $model->model_admin_key ?? $column_names['model_admin_key'];
			$model_table_key = $model->model_table_key ?? $model->getKeyName();
			// $model_type = $model->model_type ?? $model->getTable();
			$model_type = $model->model_type ?? get_class($model);
			// for morphedByMany

			$model_ids = \Osi\AdminResource\Models\AdminResource::where($model_admin_key, \Auth::id())->where($column_names['model_type'], $model_type)->pluck($column_names['model_id']);
			if ($force) {
				return $this->queryApply($builder, $model_table_key, $model_ids);
			} else {
				if ($model_ids->isNotEmpty()) {
					return $this->queryApply($builder, $model_table_key, $model_ids);
				}
			}
		}
		return $builder;
	}
	public function queryApply($builder, $model_table_key, $keys) {
		return $builder->whereIn($model_table_key, $keys);
	}
}
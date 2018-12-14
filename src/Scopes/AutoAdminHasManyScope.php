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
	 * @translator laravelacademy.org
	 */
	public function apply(Builder $builder, Model $model) {
		if (\Auth::id()) {
			dd($model->getKeyName());
			$column_names = config('admin-resource.column_names');
			$force = is_null($model->force) ? $column_names['forceOne'] : $model->force;
			$model_admin_key = $model->model_admin_key ?? $column_names['model_admin_key'];

			$model_keys = \Osi\AdminResource\Models\AdminResource::where($model_admin_key, \Auth::id())->where($column_names['model_type'], $model->getTable())->pluck($column_names['model_key']);
			if ($force) {
				return $this->queryApply($builder, $model_admin_key, $model_keys);
			} else {
				if ($model_keys->isNotEmpty()) {
					return $this->queryApply($builder, $model_admin_key, $model_keys);
				}
			}
		}
		return $builder;
	}
	public function queryApply($builder, $model_admin_key, $keys) {
		return $builder->whereIn($model_admin_key, $keys);
	}
}
<?php

namespace Osi\AdminResource\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class AutoAdminHasOneScope implements Scope {
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
			$force = is_null($model->force) ? $column_names['forceOne'] : $model->force;
			$model_admin_key = $model->model_admin_key ?? $column_names['model_admin_key'];
			if ($force) {
				return $this->queryApply($builder, $model_admin_key);
			} else {
				// if not exsits show all
				if (\DB::table($model->getTable())->where($model_admin_key, \Auth::id())->exists()) {
					return $this->queryApply($builder, $model_admin_key);
				}
			}
		}
		return $builder;
	}
	public function queryApply($builder, $model_admin_key) {
		return $builder->where($model_admin_key, \Auth::id());
	}
}
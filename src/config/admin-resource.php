<?php

return [
	'table_name' => 'admin_resource',

	'column_names' => [
		/*
			         * Change this if you want to name the related model primary key other than
			         * `model_id`.
			         *
			         * For example, this would be nice if your primary keys are all UUIDs. In
			         * that case, name this `model_uuid`.
		*/
		'forceOne' => false,
		'forceMany' => false,
		'model_key' => 'model_id',
		'model_type' => 'model_type',
		'model_admin_key' => 'admin_id',
	],
];

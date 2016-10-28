<?php

return [

	'path' => storage_path() . '/backup_db/',

	'initial_name' => '',

	'mysql' => [
		'dump_command_path' => '',
		'restore_command_path' => '',
	],

	's3' => [
		'path' => '',
	],

	'compress' => false,
];

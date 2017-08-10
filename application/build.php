<?php

return [
	// 定义模块的自动生成
	'test' => [
		'__dir__' 	 => ['controller', 'model', 'view'],
		'controller' => ['User', 'UserType'],
		'model'		 => ['USer', 'UserType'],
		'view'		 => ['index/index', 'index/test'],
	],
];
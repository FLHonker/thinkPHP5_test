<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use  think\Route;
// 动态定义路由规则的方式
Route::rule('hello/[:name]','index/hello');
// api路由
Route::rule(':version/user/:id','api/:version.User/read');

return [
    '__pattern__' => [
		'id'   => '\d+',
        'name' => '\w+',
    ],

    '[hello]'   => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
    // 添加路由规则路由到index控制器的hello操作方法
	//'hello/[:name]$'	=>	'index/index/hello', 

	'blog/:year/:month' => [
		'blog/archive', ['method' => 'get'], ['year' => '\d{4}', 'month' => '\d{2}']],
	'blog/:id'   => ['blog/get', ['method' => 'get'], ['id' => '\d+']],
	'blog/:name' => ['blog/read', ['method' => 'get'], ['name' => '\w+']],
	
	'user/index'      => 'index/user/index',
	'user/create'     => 'index/user/create',	
	'user/add'        => 'index/user/add',	
	'user/add_list'   => 'index/user/addList',		
	'user/update/:id' => 'index/user/update',
	'user/delete/:id'  => 'index/user/delete',
	'user/:id'         => 'index/user/read',
	'user/read_list'   => 'index/user/readList',
	'user/scopetest'   => 'index/user/scopetest',

];
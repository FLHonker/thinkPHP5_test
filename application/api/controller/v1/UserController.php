<?php
/* v1 */
namespace app\api\controller\v1;

use app\api\model\User;
use think\Log;

class UserController
{
	// 获取用户信息
	public function read($id = 0)
	{
		Log::error('测试错误!');
		$user = User::get($id);
		if($user) {
			return json($user);
		} else {
			return json(['error' => '用户不存在'], 404);
		}
	}
	
};
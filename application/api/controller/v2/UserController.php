<?php
/* v2 */
namespace app\api\controller\v2;

use app\api\model\User;

class UserController
{
	// 获取用户信息,捕获异常
	public function read($id = 0)
	{
		try {
			$user = User::get($id, 'profile');
			if($user) {
				return json($user);
			} else {
				return abort(404, '用户不存在！');  // 抛出HTTP异常并发送404状态码
				#return json(['error' => '用户不存在'], 404);
			}
		} catch (\Exception $e) {
			return abort(404, $e->getMessage());
		}
	}
};
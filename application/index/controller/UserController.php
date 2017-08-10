<?php
namespace app\index\controller;

use app\index\model\User;
use app\index\model\Profile;
use think\Controller;

class UserController extends Controller
{
	// 获取用户数据列表并输出
	public function index() 
	{
		$list = User::all();
		$this->assign('list', $list);
		$this->assign('count', count($list));
		return $this->fetch();
	}
	// 关联新增用户数据
	public function add()
	{
		/*
		$data = input('post.');
		// 数据验证
		$result = $this->validate($data, 'User');
		if($result != true)
			 return $result;
		$user = new User;
		// 数据保存
		$user->allowField(true)->save($data);
		return '用户['.$user->nickname.':'.$user->id.']新增成功';
		*/
		
		$user = new User;
		$user->nickname = 'thinkPHP';
		$user->email = 'adssfsdf@www.com';
		$user->birthday = strtotime('1999-09-09');
		if($user->save()) {
			// 写入关联数据
			$profile = new Profile;
			$profile->truename = '刘成';
			$profile->birthday = '1977-03-03';
			$profile->address = '中国上海';
			$profile->email = 'www@qq.com';
			$user->profile()->save($profile);
			return '用户['.$user->nickname.']新增成功。';	
		} else {
			return $user->getError();
		}
	}
	
	// 批量新增用户数据
	public function addList()
	{
		$user = new User;
		$list = [
			['nickname' => 'frank', 'email' => '25003793@qq.com', 'birthday' => strtotime('2000-12-12')],
			['nickname' => 'xuexue', 'email' => 'love@126.com', 'birthday' => strtotime('1997-11-17')]
		];
		if($user->saveAll($list)){
			return '用户批量新增成功！';
		} else {
			return $user->getError();
		}
	}
	
	public function read($id = '')
	{
		// 读取用户数据
		$user = User::get($id);
		/*
		echo $user->nickname.'<br/>';
		echo $user->email.'<br/>';
		echo $user->birthday.'<br/>';
		echo $user->status.'<br/>';
		echo $user->create_time.'<br/>';
		echo $user->update_time.'<br/>';
		echo '用户关联数据<br/>';
		echo $user->profile->truename.'<br/>';
		echo $user->profile->email.'<br/>';
		*/
		
		// 属性数组输出
		dump($user->toArray());
		// 隐藏某些属性输出数组
		dump($user->hidden(['create_time', 'email'])->toArray());
		// 制定用户数据输出
		dump($user->visible(['nickname', 'id', 'email'])->toArray());
		// 追加属性输出
		dump($user->append(['status'])->toArray());
		dump($user->profile->toArray());
		
		// JSON输出,同样支持hidden,visible,append
		echo $user->toJson();
	}
	
	public function readList()
	{
		$list = User::all();
		foreach($list as $user) {
			echo $user->nickname.'<br/>';
			echo $user->email.'<br/>';
			echo date('Y/m/d', $user->birthday).'<br/>';
			echo '-----------------------------------<br/>';
		}
	}
	
	public function update($id)
	{
		$user = User::get($id);
		$user->nickname = '宇昂';
		$user->email = 'frankliu624@gmail.com';
		if($user->save()) {
			// 更新关联数据
			$user->profile->email = 'qqqq@qq.com';
			$use->profile->save();
			return '更新用户和关联数据成功！';
		} else {
			return $user->getError();
		}
	}
	
	public function delete($id)
	{
		$user = User::get($id);
		if($user) {
			$user->delete();
			// 删除关联数据
			#$user->profile->delete();
			return '删除用户成功！';
		} else {
			return '删除的用户不存在！';
		}
	}
	
	// 根据查询范围获取用户数据列表 
	public function scopetest()
	{
		$list = User::scope('email')
			->scope('status')
			->scope(function($query) {
				$query->order('id', 'desc');
			})
			->all();
		foreach ($list as $user)
		{
			echo $user->nickname.'<br/>';
			echo $user->email.'<br/>';
			echo $user->birthday.'<br/>';
			echo $user->status.'<br/>';
			echo '---------------------------<br/>';
		}
	}
	
	// 创建用户数据界面
	public function create()
	{
		return view();
	}
};

<?php
namespace app\index\model;

use think\Model;

class User extends Model
{
	// 设置完整数据表（包含前缀）
	protected $table = 'think_user';
	// 设置数据表（不含前缀）、
	#protected $name = 'user';
	
	// 设置单独的数据库连接
	protected $connection = [
		// 数据库类型
		'type'  	=>'mysql',
		// 服务器地址
		'hostname'	=> '127.0.0.1',
		// 数据库名
		'database'  => 'frank',
		// 数据库用户名
		'username'  => 'root',
		// 数据库密码
		'password'  => '5216',
		// 数据库连接端口
		'hostport'  => '3306',
		// 数据库连接参数
		'params'    => [],
		// 数据库编码默认采用utf8
		'charset'	=> 'utf8',
		// 数据库表前缀
		'prefix'	=> 'think',
		// 数据库调试模式
		'debug'		=> true,
	];
	
	// birthday读取器
	protected function getBirthdayAttr($birthday)
	{
		return date('Y-m-d', $birthday);
	}
	
	// bithday修改器
	protected function setBirthdayAttr($value)
	{
		return strtotime($value);
	}
	
	// 属性读取器
	protected function getStatusAttr($value)
	{
		$status = [ -1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核' ];
		return $status[$value];
	}
	// 定义类型转换
	protected $type = [
		'birthday' => 'timestamp:Y/m/d',
	];
	// 定义时间戳字段名
	#protected $createTime = 'create_at';
	#protected $updateTime = 'update_at';
	// 开启自动写入时间戳
	protected $autoWriteTimestamp = true;
	// 定义自动完成的属性
	protected $insert = ['status' => 1];
	
	// 查询范围
	// email查询
	protected function scopeEmail($query)
	{
		$query->where('email', 'thinkphp@qq.com');
	}
	// status 查询
	protected function scopeStatus($query)
	{
		$query->where('status', 1);
	}
	
		
	// 定义关联方法
	public function profile()
	{
		// 用户HAS_ONE档案关联
		return $this->hasOne('Profile','user_id','id');
	}
	
};
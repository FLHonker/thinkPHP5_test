<?php
namespace app\api\model;

use think\Model;

class Profile extends Model
{
	protected $style = [
		'birthday' => 'timestamp:Y-m-d',
	];
	
	// BLONGS_TO
	public function user()
	{
		// 档案 BELONGS_TO 关联用户
		return $this->belongsTo('User');
	}
};
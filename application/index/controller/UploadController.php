<?php
namespace app\index\controller;

use think\Request;

class UploadController extends \think\Controller
{
	// 文件上传表单
	public function index()
	{
		return $this->fetch();
	}
	
	// 文件上传提交
	public function up(Request $request)
	{
		// 获取表单上传文件
		$file = $request->file('file');
		if (empty($file)) {
			$this->error('请选择上传的文件!');
		}
		// 上传文件验证		
		$result	= $this->validate(['file' => $file], 
		    ['file'=>'require|image'], 
			['file.r equire' =>	'请选择上传文件', 
			'file.image' => '非法图像文件']);		
		if(true	!==	$result){	
			$this->error($result);		
		}	
		// 移动到框架应用根目录/public/uploads/目录下
		$info = $file->rule('date')->move(ROOT_PATH . 'public' . DS .'uploads', '');
		if ($info) {
			$this->success('文件上传成功:', $info->getRealPath());
		} else {
			// 文件上传失败获取错误信息
			$this->error($file->getError());
		}
	}
}
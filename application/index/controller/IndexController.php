<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use	think\Request;
use think\Session;
use	\traits\controller\Jump;
use think\Log;

class IndexController extends Controller
{
    public function index()
    {
		Log::error('测试错误!');
		return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }
	// URL路由测试
	public function urltest($name = 'Frank', $from = 'Shandong')
	{
		//return 'Hello '.$name.'! You are from '.$from.'.';
		$this->assign('name',$name);
		$this->assign('city',$from);
		return $this->fetch();
	}
	
	public function hello($name = 'Frank')
	{
		// 页面跳转
		if($name == 'thinkphp')
			$this->success('欢迎使用thinkPHP 5.0','requesttest');
		else if($name =='Frank')
			$this->redirect('http://thinkphp.cn',301);
		else
			$this->success('错误的name','urltest');
		
		#return 'Hello,'.$name.'!';
		$this->assign('name',$name);
		#return $this->fetch();
		$data = Db::name('data')->find();
		$this->assign('result',$data);
		return $this->fetch();
	}
	
	protected function hello2()
	{
		return 'I am a protected function!';
	}
	// Request测试
	public function requesttest(Request	$request,$name = 'World')
	{
		//$request = Request::instance();
		// 获取当前URL地址，不含域名
		echo 'url:'.$this->request->url().'<br/>';
		echo '请求参数';
		dump($request->param());
		echo 'name:'.$request->param('name');
		dump(input());
		echo 'name2:'.input('name');
		
		echo 'GET参数:';
		dump($request->get());
		echo 'GET参数:name:';
		dump($request->get('name'));
		echo 'POST参数:name:';
		dump($request->post('name'));
		echo 'cookie参数：name:';
		dump($request->cookie('name'));
		echo '上传文件信息：image:';
		dump($request->file('image'));
		
		// input助手函数
		echo '**input助手函数实现**'.'<br/>';
		echo 'GET参数:';
		dump(input('get.'));
		echo 'GET参数:name:';
		dump(input('get.name'));
		echo 'POST参数:name:';
		dump(input('post.name'));
		echo 'cookie参数：name:';
		dump(input('cookie.name'));
		echo '上传文件信息：image:';
		dump(input('file.name'));		
		
		// 获取请求参数
		echo '**获取请求参数**'.'<br/>';
		echo '请求方法:'.$request->method().'<br/>';
		echo '资源类型:'.$request->type().'<br/>';
		echo '访问IP:'.$request->ip().'<br/>';
		echo '是否AJax请求:'.var_export($request->isAjax(),true).'<br/>';
		echo '请求参数:';
		dump($request->param());
		echo '请求参数:仅包含name';
		dump($request->only(['name']));
		echo '请求参数:排除name';
		dump($request->except(['name']));
		
		$data = ['name' => 'thinkphp', 'status' => '1'];
		//return json($data);
	}
};
<?php
namespace app\index\controller;

class CaptchaController extends \think\Controller
{
	// 验证码表单
	public function index()
	{
		return $this->fetch();
	}
	
	// 验证码1检测
	public function check1($code = '')
	{
		$captcha = new \think\captcha\Captcha();
		if (!$captcha->check($code, 1))
		{
			$this->error('验证码1错误!');
		} else {
			$this->success('验证码1正确!');
		}
	}
	// 验证码2检测
	public function check2($code = '')
	{
		$captcha = new \think\captcha\Captcha();
		if (!$captcha->check($code, 2))
		{
			$this->error('验证码2错误!');
		} else {
			$this->success('验证码2正确!');
		}
	}
}
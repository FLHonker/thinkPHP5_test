<?php
namespace app\api\exception;

use think\exception\Handle;
use think\exception\HttpException;

class Http extends Handle
{
	public function render(\Exception $e)
	{
		if($e instanceof HttpException) {
			$statusCode = $e->getStatusCode();
		}
		if(!isset($statusCode)) {
			$statusCode = 500;
		}
		
		$result = [
			'code' => $statusCode,
			'msg'  => $e->getMessage(),
			'time' => date('Y-m-d',$_SERVER['REQUEST_TIME']),
		];
		return json($result, $statusCode);
	}
};
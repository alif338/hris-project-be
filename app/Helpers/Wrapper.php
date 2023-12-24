<?php

namespace App\Helpers;

class Wrapper
{
	static function error($error)
	{
		return [
			'err' => $error,
			'data' => null
		];
	}

	static function data($data)
	{
		return [
			'err' => null,
			'data' => $data
		];
	}

	static function response($success = true, $result, $message = '', $responseCode = 200)
	{
		if (!$success) {
			return response()->json([
				'success' => $success,
				'data' => null,
				'message' => $message,
				'code' => 400
			], 400);
		} else {
			return response()->json([
				'success' => $success,
				'data' => $result,
				'message' => $message,
				'code' => $responseCode
			]);
		}
	}
}

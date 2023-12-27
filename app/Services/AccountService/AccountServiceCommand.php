<?php

namespace App\Services\AccountService;

use App\Helpers\Wrapper;
use App\Models\AppCompany;
use App\Models\AppRolesPermission;
use App\Models\AppUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Token;

class AccountServiceCommand
{
	public function login($payload)
	{
		$checkEmail = AppUser::where('email', $payload['email'])->first();
		if (!$checkEmail) {
			return Wrapper::error('user not found');
		}

		$passwordCheck = Hash::check($payload['password'], $checkEmail->password);
		if (!$passwordCheck) {
			return Wrapper::error('password invalid');
		}
		$createToken = $checkEmail->createToken($payload['email']);

		return Wrapper::data([
			'email' => $payload['email'],
			'rolecode' => $checkEmail->rolecode,
			'rolename' => $checkEmail->role->rolename,
			'fullname' => $checkEmail->fullname,
			'userid' => $createToken->token->user_id,
			'token' => $createToken->accessToken
		]);
	}

	public function newUserCompany($payload)
	{
		$email = $payload['email'];
		$password = $payload['password'];
		$fullname = $payload['fullname'];
		$phonenumber = $payload['phonenumber'];
		$dateofbirth = $payload['dateofbirth'];
		$address = $payload['address'];

		$companyname = $payload['companyname'];
		$about = $payload['about'];
		$companyaddress = $payload['companyaddress'];
		$contactnumber = $payload['contactnumber'];
		$companymail = $payload['companymail'];

		$checkUser = AppUser::where('email', $email)->get();
		if (count($checkUser) > 0) {
			return Wrapper::error('user already exist');
		}

		$newCompanyCode = md5(strtolower($companyname));
		$checkCompany = AppCompany::where('companycode', $newCompanyCode)->get();
		if (count($checkCompany) > 0) {
			return Wrapper::error('company already exist');
		}

		$rolecode = 'admin';
		$hashedPass = Hash::make($password, ['memory' => 1024, 'time' => 2, 'threads' => 2]);

		$newUser = [
			'email' => $email,
			'password' => $hashedPass,
			'fullname' => $fullname,
			'phonenumber' => $phonenumber,
			'dateofbirth' => $dateofbirth,
			'address' => $address,
			'companycode' => $newCompanyCode,
			'rolecode' => $rolecode
		];
		$newCompany = [
			'companycode' => $newCompanyCode,
			'companyname' => $companyname,
			'about' => $about,
			'address' => $companyaddress,
			'contactnumber' => $contactnumber,
			'companymail' => $companymail
		];

		DB::beginTransaction();

		try {
			//code...
			AppUser::create($newUser);
			AppCompany::create($newCompany);

			DB::commit();

			return Wrapper::data([]);
		} catch (\Throwable $th) {
			//throw $th;
			DB::rollBack();
			return Wrapper::error($th->getMessage());
		}
	}

	public function logout()
	{
		$user = Auth::guard('api')->user();

		DB::beginTransaction();
		try {
			//code...
			Token::where('name', $user->email)->delete();

			DB::commit();
			return Wrapper::data([]);
		} catch (\Throwable $th) {
			//throw $th;
			DB::rollBack();
			return Wrapper::error($th->getMessage());
		}
	}

	public function addRemovePermission($payload)
	{
		$user = Auth::guard('api')->user();

		if ($user->rolecode != 'superadmin') {
			return Wrapper::error("you're not super admin");
		}

		$companycode = $payload['companycode'];
		$permissioncode = $payload['permissioncode'];
		$rolecode = $payload['rolecode'];

		DB::beginTransaction();
		try {
			//code...
			$permissionExist = AppRolesPermission::where('rolecode', $rolecode)
				->where('companycode', $companycode)
				->where('permissioncode', $permissioncode)
				->get();
			if (count($permissionExist) > 0) {
				$permissionExist->delete();
			} else {
				AppRolesPermission::insert([$payload]);
			}

			DB::commit();
			return Wrapper::data([]);
		} catch (\Throwable $th) {
			//throw $th;
			DB::rollBack();
			return Wrapper::error($th->getMessage());
		}
	}
}

<?php

namespace App\Services\AccountService;

use App\Helpers\Wrapper;
use App\Models\AppCompany;
use App\Models\AppRole;
use Illuminate\Support\Facades\Auth;

class AccountServiceQuery
{
	public function lookupRoles()
	{
		$user = Auth::guard('api')->user();

		if ($user->rolecode != 'superadmin') {
			return Wrapper::error("you're not superadmin");
		}

		$result = AppRole::all();

		// $company = AppCompany::all()->random(1)->first();
		// $department = $company->departments()->get()->random(1)->first();

		// print_r($department->departmentid);

		return Wrapper::data($result);
	}

	public function userInfo()
	{
		try {
			$user = Auth::guard('api')->user();

			$response = [
				'userid' => $user->userid,
				'email' => $user->email,
				'role' => $user->role,
				'fullname' => $user->fullname,
				'dateofbirth' => $user->dateofbirth,
				'phonenumber' => $user->phonenumber,
				'company' => $user->company,
				'address' => $user->address,
				'department' => $user->department,
			];

			return Wrapper::data($response);
		} catch (\Throwable $th) {
			return Wrapper::error($th->getMessage());
		}
	}
}

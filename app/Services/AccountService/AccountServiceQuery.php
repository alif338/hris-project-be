<?php

namespace App\Services\AccountService;

use App\Helpers\Wrapper;
use App\Models\AppRole;
use App\Models\AppUser;
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

	public function usersMasterData($payload)
	{
		$search = $payload['search'] ?? '';
		$limit = $payload['limit'] ?? 15;
		$page = $payload['page'] ?? 1;
		$user = Auth::guard('api')->user();

		$offset = ($page - 1) * $limit;

		if ($user->rolecode != 'superadmin') {
			return Wrapper::error("you're not superadmin");
		}

		$result = AppUser::whereRaw("? = ''", [$search])
			->orWhereRaw("email ILIKE '%' || ? || '%'", [$search])
			->orWhereRaw("fullname ILIKE '%' || ? || '%'", [$search])
			->orWhereRaw("phonenumber ILIKE '%' || ? || '%'", [$search])
			->orWhereRaw("address ILIKE '%' || ? || '%'", [$search])
			->limit($limit)
			->offset($offset)
			->get();

		$resultCount = AppUser::whereRaw("? = ''", [$search])
			->orWhereRaw("email ILIKE '%' || ? || '%'", [$search])
			->orWhereRaw("fullname ILIKE '%' || ? || '%'", [$search])
			->orWhereRaw("phonenumber ILIKE '%' || ? || '%'", [$search])
			->orWhereRaw("address ILIKE '%' || ? || '%'", [$search])
			->count();

		foreach ($result as $res) {
			$res['company'] = $res->company;
			$res['role'] = $res->role;
		}

		return Wrapper::data([
			'result' => $result,
			'resultCount' => $resultCount
		]);
	}
}

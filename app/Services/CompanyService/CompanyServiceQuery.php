<?php

namespace App\Services\CompanyService;

use App\Helpers\Wrapper;
use App\Models\AppCompany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanyServiceQuery
{
	public function companyList($payload)

	{
		$search = $payload['search'] ?? '';
		$limit = $payload['limit'] ?? 15;
		$page = $payload['page'] ?? 1;
		$user = Auth::guard('api')->user();

		$offset = ($page - 1) * $limit;

		if ($user->rolecode != 'superadmin') {
			return Wrapper::error("you're not superadmin");
		}

		$result = DB::table("app_companies")
			->whereRaw("? = ''", [$search])
			->orWhereRaw("companyname ILIKE '%' || ? || '%'", [$search])
			->orWhereRaw("about ILIKE '%' || ? || '%'", [$search])
			->orWhereRaw("address ILIKE '%' || ? || '%'", [$search])
			->orWhereRaw("companymail ILIKE '%' || ? || '%'", [$search])
			->orWhereRaw("contactnumber ILIKE '%' || ? || '%'", [$search])
			->limit($limit)
			->offset($offset)
			->get();

		$resultCount = DB::table("app_companies")
			->whereRaw("? = ''", [$search])
			->orWhereRaw("companyname ILIKE '%' || ? || '%'", [$search])
			->orWhereRaw("about ILIKE '%' || ? || '%'", [$search])
			->orWhereRaw("address ILIKE '%' || ? || '%'", [$search])
			->orWhereRaw("companymail ILIKE '%' || ? || '%'", [$search])
			->orWhereRaw("contactnumber ILIKE '%' || ? || '%'", [$search])
			->count();

		return Wrapper::data([
			'result' => $result,
			'resultCount' => $resultCount
		]);
	}
}

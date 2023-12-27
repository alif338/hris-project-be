<?php

namespace App\Http\Controllers;

use App\Helpers\Wrapper;
use App\Services\CompanyService\CompanyServiceCommand;
use App\Services\CompanyService\CompanyServiceQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    protected CompanyServiceCommand $command;
    protected CompanyServiceQuery $query;

    public function __construct()
    {
        $this->command = new CompanyServiceCommand();
        $this->query = new CompanyServiceQuery();
    }

    public function companyListHandler(Request $request)
    {
        $validatePayload = Validator::make($request->all(), [
            'search' => 'nullable',
            'limit' => 'nullable|integer',
            'page' => 'nullable|integer'
        ]);
        if ($validatePayload->fails()) {
            return Wrapper::response(false, null, join("\n", $validatePayload->errors()->all()), 400);
        }

        $response = $this->query->companyList($validatePayload->getData());
        if ($response['err'] != null) {
            return Wrapper::response(false, null, $response['err'], 400);
        }

        return Wrapper::response(true, $response['data'], "Get company list success.");
    }
}

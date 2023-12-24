<?php

namespace App\Http\Controllers;

use App\Helpers\Wrapper;
use App\Services\AccountService\AccountServiceCommand;
use App\Services\AccountService\AccountServiceQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    protected AccountServiceCommand $accountServiceCommand;
    protected AccountServiceQuery $accountServiceQuery;
    public function __construct()
    {
        $this->accountServiceCommand = new AccountServiceCommand();
        $this->accountServiceQuery = new AccountServiceQuery();
    }

    public function loginHandler(Request $request)
    {
        $validatePayload = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validatePayload->fails()) {
            return Wrapper::response(false, null, $validatePayload->errors()->all(), 400);
        }

        $response = $this->accountServiceCommand->login($validatePayload->getData());
        if ($response['err'] != null) {
            return Wrapper::response(false, null, $response['err'], 400);
        }

        return Wrapper::response(true, $response['data'], 'login successful');
    }

    public function newUserCompanyHandler(Request $request)
    {
        $validatePayload = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'fullname' => 'required',
            'phonenumber' => 'nullable',
            'dateofbirth' => 'nullable',
            'address' => 'nullable',
            'companyname' => 'required',
            'industry' => 'nullable',
            'companyaddress' => 'nullable',
            'contactnumber' => 'nullable'
        ]);
        if ($validatePayload->fails()) {
            return Wrapper::response(false, null, $validatePayload->errors()->all(), 400);
        }

        $response = $this->accountServiceCommand->newUserCompany($validatePayload->getData());
        if ($response['err'] != null) {
            return Wrapper::response(false, null, $response['err'], 400);
        }

        return Wrapper::response(true, $response['data'], 'register success');
    }

    public function logoutHandler(Request $request)
    {
        $response = $this->accountServiceCommand->logout();
        if ($response['err'] != null) {
            return Wrapper::response(false, null, $response['err'], 400);
        }

        return Wrapper::response(true, $response['data'], 'logout success');
    }

    public function lookupRolesHandler(Request $request)
    {
        $response = $this->accountServiceQuery->lookupRoles();
        if ($response['err'] != null) {
            return Wrapper::response(false, null, $response['err'], 400);
        }

        return Wrapper::response(true, $response['data'], 'lookup role success');
    }

    public function addRemovePermissionHandler(Request $request)
    {
        $validatePayload = Validator::make($request->all(), [
            'companycode' => 'required',
            'rolecode' => 'required',
            'permissioncode' => 'required'
        ]);

        if ($validatePayload->fails()) {
            return Wrapper::response(false, null, $validatePayload->errors()->all(), 400);
        }

        $response = $this->accountServiceCommand->addRemovePermission($validatePayload->getData());
        if ($response['err'] != null) {
            return Wrapper::response(false, null, $response['err'], 400);
        }

        return Wrapper::response(true, $response['data'], 'add/update permission successful');
    }
}
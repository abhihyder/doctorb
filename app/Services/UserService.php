<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService extends AppService
{

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return $this->getAllUser() ;
    }

    public function getAllUser()
    {

        return $this->user->orderBy('id', 'DESC');
    }

    public function store($request)
    {
        $user = new User();
        $user->name = isset($request->name) ? $request->name : null;
        $user->email = isset($request->email) ? $request->email : null;
        $user->email_verified_at = isset($request->email_verified_at) ? $request->email_verified_at : null;
        $user->phone = isset($request->phone) ? $request->phone : null;
        $user->password = isset($request->password) ? $request->password : Hash::make('secret');
        $user->user_type = isset($request->user_type) ? $request->user_type : null;
        $user->gender = isset($request->gender) ? $request->gender : null;
        $user->save();
        return $user;
    }

    public function dataTableData()
    {
	    return $this->user->orderBy('id', 'DESC')->get(['id','name','email','user_type','gender','phone']);
    }

    public function search($field, $query)
    {
        // TODO: Implement search() method.
    }

    public function findOrganization($organizationId)
    {
        // TODO: Implement findOrganization() method.
    }

    public function update($request, User $user)
    {
        // TODO: Implement update() method.
    }

    public function destroy(User $organization)
    {
        // TODO: Implement destroy() method.
    }
}

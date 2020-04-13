<?php

namespace App\Services;


use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class OrganizationService extends AppService
{
    public $organization;
    public $userServices;

    /**
     * OrganizationController constructor.
     * @param $organization
     */
    public function __construct(Organization $organization, UserService $userServices)
    {
        $this->organization = $organization;
        $this->userServices = $userServices;
    }

    public function index()
    {
        return $this->organization
            ->orderBy('id', 'DESC') ;
    }

    public function search($field, $query)
    {
        return $this->organization->search($field, $query)->paginate(10);
    }

    public function store(Request $request)
    {
        // $user = $this->storeOrganizationAdminUser($request);

        // return $user;

        $organization = new Organization();
        $organization->organization_name = $request->organization_name;
        $organization->organization_address = $request->organization_address;
        $organization->phone = $request->phone;
        $organization->email = $request->email;
        $organization->organization_type = $request->organization_type;
        $organization->zip_code = $request->zip_code;
        // $organization->user_id = $user->id;
        $organization->user_id = '22';
        $organization->registration_no = $request->registration_no;
        $organization->district_id = $request->district_id;
        $organization->division_id = $request->division_id;
        $organization->thana_id = $request->thana_id;
        $organization->status = 1;
        // $organization->created_by = Auth::user()->id;
        $organization->save();
        return $organization;
    }

    public function findOrganization($organizationId)
    {
        return $this->organization->find($organizationId);
    }

    public function decryptOrganizationId($organizationEncryptedId){

        try{

            return $this->decryptString($organizationEncryptedId);

        }catch (\Exception $e){

            Log::error($e->getTraceAsString());
            return false;
        }
    }

    public function update(Request $request)
    {
        $organization = Organization::find($request->id);
        $organization->organization_name = $request->organization_name;
        $organization->organization_address = $request->organization_address;
        $organization->phone = $request->phone;
        $organization->organization_type = $request->organization_type;
        $organization->zip_code = $request->zip_code;
        $organization->email = $request->email;
        $organization->registration_no = $request->registration_no;
        $organization->district_id = $request->district_id;
        $organization->division_id = $request->division_id;
        $organization->thana_id = $request->thana_id;
        $organization->save();
        return $organization;
    }

    public function destroy(Organization $organization)
    {

        $organization->delete();
    }

    public function storeValidate(Request $request){
        return Validator::make($request->all(), $this->organization->storeRules());
    }

    public function editValidate(Request $request){
        return Validator::make($request->all(), $this->organization->editRules());
    }

    private function storeOrganizationAdminUser($request){

        $userRequest = new \stdClass();
        $userRequest->name = 'blank';
        $userRequest->email = $request->email;
        $userRequest->password = Hash::make('secret');
        $userRequest->user_type = 3;
        $userRequest->phone = $request->phone;

        return $this->userServices->store($userRequest);
    }
}

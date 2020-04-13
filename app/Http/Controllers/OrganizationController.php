<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Organization;
use DB;
use App\Services\OrganizationService;
use Illuminate\Http\Request;
use yajra\Datatables\Datatables;

class OrganizationController extends Controller
{
    public $organizationService;


    public function __construct(OrganizationService $organizationService)
    {
        $this->organizationService = $organizationService;
    }

    public function index()
    {
        return view('doctor/master/organization/organization');
    }

    public function getData()
    {
        $resData = $this->organizationService->index();

        return Datatables::of($resData)
            ->addColumn('action', function ($resData) {
                $id = $resData['id'];
                return "<button style=' type='button' class='btn btn-success btn-sm' data-toggle='modal' data-target='#targetModal' onclick='edit_data($id)'>Edit</button><button style=' type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#targetModal' onclick='delete_data($id)'>Delete</button>";
            })
            ->editColumn('status', function ($resData) {
                if ($resData['status'] == 0) {
                    $activate = 'class="text-danger"';
                } else {
                    $activate = 'class="text-success"';
                }
                return '<span ' . $activate . '><b>' . $resData['status'] . '</b></span>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function create()
    {
        $divisions = DB::table('divisions')->select('divisions.*')->get();
        $data['divisions'] = $divisions;
        return view('doctor/master/organization/create')->with($data);
    }

    public function getOrganization(Request $request){
        $thana_id = $request['thana_id'];
        $organizations = Organization::select('id', 'organization_name')->where('thana_id', $thana_id)->get();

        // foreach ($organizations as $org) {
        //     $org_name = $org->organization_name;
        //     $id = $org->id;
        //     echo "<option value='$id'>$org_name</option>";
        //     $htmlContent .= "<option value='$thana->id'>$thana->name</option>";
        // }

        $htmlContent = '';
        $htmlContent = "<option value=''>Select One</option>";
        foreach ($organizations as $org) {
            $org_name = $org->organization_name;
            $id = $org->id;
            $htmlContent .= "<option value='$id'>$org->organization_name</option>";
        }

        echo $htmlContent;
        return;

    }

    public function edit($id)
    {
        $divisions = DB::table('divisions')->select('divisions.*')->get();
        $data['divisions'] = $divisions;
        $districts = DB::table('districts')->select('districts.*')->get();
        $data['districts'] = $districts;
        $thanas = DB::table('thanas')->select('thanas.*')->get();
        $data['thanas'] = $thanas;
        $organizations = DB::table('organizations')->select('organizations.*')->where('id', $id)->get();
        $data['result_data'] = $organizations[0];
        return view('doctor/master/organization/edit')->with($data);
    }

    public function search($field, $query)
    {
        try {

            return $this->organizationService->search($field, $query);

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            $validate = $this->organizationService->storeValidate($request);

            if ($validate->fails()) {
                return $this->respondInvalidRequest($validate->errors());
            }

            $organization = $this->organizationService->store($request);

            // return $this->respondCreated('Organization Created Successfully',  $organization);
            Session::flash('success', 'Data Save Successfully');

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    public function show($encryptedOrganizationId)
    {
        try {

            if (!$ogranizationId = $this->organizationService->decryptOrganizationId($encryptedOrganizationId)) {

                return $this->respondNotFound('Organization id is invalid');
            }

            return $this->respond($this->organizationService->findOrganization($ogranizationId));

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {

            // if (!$organizationId = $this->organizationService->decryptOrganizationId($encryptedOrganizationId)) {

            //     return $this->respondNotFound('Organization id is invalid');
            // }

            $validate = $this->organizationService->editValidate($request);

            if ($validate->fails()) {
                return $this->respondInvalidRequest($validate->errors());
            }

            /*if (!$organization = $this->organizationService->findOrganization($organizationId)) {

                return $this->respondNotFound('Organization does not exists');
            }*/

            $organization = $this->organizationService->update($request);

            // return $this->respond( $organization);
            Session::flash('success', 'Data Update Successfully');

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    public function delete($id)
    {
        return view('doctor/master/organization/delete')->with('main_id', $id);
    }

    public function destroy($orgId)
    {
        try {

            /*if (!$organizationId = $this->organizationService->decryptOrganizationId($encryptedOrganizationId)) {

                return $this->respondNotFound('Organization id is invalid');
            }*/

            if (!$orgId = $this->organizationService->findOrganization($orgId)) {

                Session::flash('success', 'Does Not exists');
            }

            $this->organizationService->destroy($orgId);

            // return $this->respondDeleted("Organization Deleted Successfully ");
            Session::flash('success', 'Data Delete Successfully');
            return redirect('chamber');


        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }
}

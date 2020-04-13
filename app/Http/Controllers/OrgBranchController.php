<?php

namespace App\Http\Controllers;

use App\Models\OrgBranch;
use App\Services\OrgBranchService;
use Illuminate\Http\Request;

class OrgBranchController extends Controller
{

    public  $organizationBranchService;

    /**
     * OrgBranchsController constructor.
     * @param $OrgBranchs
     */
    public function __construct(OrgBranchService  $organizationBranchService)
    {
        $this->organizationBranchService =  $organizationBranchService;
    }


    /**
     */
    public function index()
    {
        try {

            return  $this->organizationBranchService->index();


        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    /**
     * For search
     */
    public function search($field, $queryString)
    {
        try {

            return  $this->organizationBranchService->search($field, $queryString);

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        try {

            $validate = $this->organizationBranchService->storeValidate($request);

            if ($validate->fails()) {
                return $this->respondInvalidRequest($validate->errors());
            }

            $orgBranchs = $this->organizationBranchService->store($request);

            return $this->respondCreated('OrgBranchs Created Successfully',  $orgBranchs);

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     */
    public function show(OrgBranch $orgBranchs)
    {
        try {

            if (!$orgBranchs) {
                return $this->respondNotFound('OrgBranchs does not exists');
            }

            return $this->respond( $this->organizationBranchService->show($orgBranchs));

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     */
    public function update(Request $request, OrgBranch $orgBranchs)
    {
        try {

            $validate = $this->organizationBranchService->editValidate($request);

            if ($validate->fails()) {
                return $this->respondInvalidRequest($validate->errors());
            }

            $orgBranchs = $this->organizationBranchService->update($request, $orgBranchs);

            return $this->respond( $orgBranchs);

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     */
    public function destroy(OrgBranch $orgBranchs)
    {
        try {

            if (!$orgBranchs) {

                return $this->respondNotFound('OrgBranchs does not exists');
            }

            $this->organizationBranchService->destroy($orgBranchs);

            return $this->respondDeleted("OrgBranchs Deleted Successfully ");


        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }
}

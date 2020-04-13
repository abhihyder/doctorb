<?php

namespace App\Services;


use App\Models\OrgBranch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrgBranchService
{

    public $orgBranch;
    public $orgBranchsService;

    /**
     * OrgBranchsController constructor.
     * @param $OrgBranchs
     * @param $OrgBranchsService
     */
    public function __construct(OrgBranch $orgBranch)
    {
        $this->orgBranch = $orgBranch;
    }

    public function index()
    {
        return $this->orgBranch
            ->orderBy('id', 'DESC') ;
    }

    public function search( $field,  $query)
    {
        return $this->orgBranch->search($field, $query)->paginate(10);
    }

    public function store(Request $request)
    {
        $orgBranch = new OrgBranch();
        $orgBranch->name = $request->name;
        $orgBranch->organization_address = $request->organization_address;
        $orgBranch->phone = $request->phone;
        $orgBranch->email = $request->email;
        $orgBranch->image = $request->image;
        $orgBranch->status = $request->status;
        $orgBranch->organization_id = $request->organization_id;
        $orgBranch->created_by = $request->created_by;
        $orgBranch->save();
        return $orgBranch;
    }

    public function show(OrgBranch $orgBranch)
    {
        return $orgBranch;
    }

    public function update(Request $request, OrgBranch $orgBranch)
    {
        $orgBranch->name = $request->name;
        $orgBranch->organization_address = $request->organization_address;
        $orgBranch->phone = $request->phone;
        $orgBranch->email = $request->email;
        $orgBranch->image = $request->image;
        $orgBranch->status = $request->status;
        $orgBranch->organization_id = $request->organization_id;
        $orgBranch->created_by = $request->created_by;
        $orgBranch->save();
        return $orgBranch;
    }

    public function destroy(OrgBranch $orgBranch)
    {
        $orgBranch->delete();
    }

    public function storeValidate(Request $request){

        return Validator::make($request->all(), $this->orgBranch->storeRules());

    }

    public function editValidate(Request $request){

        return Validator::make($request->all(), $this->orgBranch->editRules());

    }
}

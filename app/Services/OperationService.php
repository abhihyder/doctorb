<?php

namespace App\Services;


use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OperationService
{

    public $operation;
    public $operationService;

    /**
     * operationController constructor.
     */
    public function __construct(Operation $operation)
    {
        $this->operation = $operation;
    }

    public function index()
    {

        return $this->operation
            ->orderBy('id', 'DESC') ;
    }

    public function search( $field,  $query)
    {
        return $this->operation->search($field, $query)->paginate(10);
    }

    public function store(Request $request)
    {
        $operation = new Operation();
        $operation->operation_title = $request->operation_title;
        $operation->organization = $request->organization;
        $operation->chamber = $request->chamber;
        $operation->patient_id = $request->patient_id;
        $operation->date_time = $request->date_time;
        $operation->save();
        return $operation;
    }

    public function show(Operation $operation)
    {
        return $operation;
    }

    public function update(Request $request, Operation $operation)
    {
        $operation->operation_title = $request->operation_title;
        $operation->organization = $request->organization;
        $operation->chamber = $request->chamber;
        $operation->patient_id = $request->patient_id;
        $operation->date_time = $request->date_time;
        $operation->save();
        return $operation;
    }

    public function destroy(Operation $operation)
    {
        $operation->delete();
    }

    public function storeValidate(Request $request){

        return Validator::make($request->all(), $this->operation->storeRules());

    }

    public function editValidate(Request $request){

        return Validator::make($request->all(), $this->operation->editRules());

    }
}

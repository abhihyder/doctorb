<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use App\Services\OperationService;
use Illuminate\Http\Request;

class OperationController extends Controller
{

    public $operationService;

    /**
     * operationController constructor.
     * @param $operation
     * @param $OperationService
     */
    public function __construct(OperationService $operationService)
    {
        $this->operationService = $operationService;
    }


    /**
     */
    public function index()
    {

        try {

            return  $this->operationService->index();


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

            return  $this->operationService->search($field, $queryString);

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

            $validate = $this->operationService->storeValidate($request);

            if ($validate->fails()) {
                return $this->respondInvalidRequest($validate->errors());
            }

            $operation = $this->operationService->store($request);

            return $this->respondCreated('operation Created Successfully',  $operation);

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     */
    public function show(operation $operation)
    {
        try {

            if (!$operation) {
                return $this->respondNotFound('operation does not exists');
            }

            return $this->respond( $this->operationService->show($operation));

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
    public function update(Request $request, operation $operation)
    {
        try {

            $validate = $this->operationService->editValidate($request);

            if ($validate->fails()) {
                return $this->respondInvalidRequest($validate->errors());
            }

            $operation = $this->operationService->update($request, $operation);

            return $this->respond( $operation);

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     */
    public function destroy(operation $operation)
    {
        try {

            if (!$operation) {

                return $this->respondNotFound('operation does not exists');
            }

            $this->operationService->destroy($operation);

            return $this->respondDeleted("operation Deleted Successfully ");


        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }


}

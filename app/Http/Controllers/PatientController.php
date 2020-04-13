<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Services\PatientService;
use Illuminate\Http\Request;

Class PatientController extends Controller
{

    public $patientService;

    /**
     * PatientController constructor.
     * @param $Patient
     * @param $PatientService
     */
    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }


    /**
     */
    public function index()
    {
        try {

            return $this->patientService->index();


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

            return $this->patientService->search($field, $queryString);

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        try {

            $validate = $this->patientService->storeValidate($request);

            if ($validate->fails()) {
                return $this->respondInvalidRequest($validate->errors());
            }

            $patient = $this->patientService->store($request);

            return $this->respondCreated('Patient Created Successfully', $patient);

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show(Patient $patient)
    {
        try {

            if (!$patient) {
                return $this->respondNotFound('Patient does not exists');
            }

            return $this->respond($this->patientService->show($patient));

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    public function update(Request $request, Patient $patient)
    {
        try {

            $validate = $this->patientService->editValidate($request);

            if ($validate->fails()) {
                return $this->respondInvalidRequest($validate->errors());
            }

            $patient = $this->patientService->update($request, $patient);

            return $this->respond($patient);

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy(Patient $patient)
    {
        try {

            if (!$patient) {

                return $this->respondNotFound('Patient does not exists');
            }

            $this->patientService->destroy($patient);

            return $this->respondDeleted("Patient Deleted Successfully ");


        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }
}

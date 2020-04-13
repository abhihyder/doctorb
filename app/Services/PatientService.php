<?php

namespace App\Services;


use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientService
{

    public $patient;
    public $patientService;

    /**
     * PatientController constructor.
     * @param $Patient
     * @param $PatientService
     */
    public function __construct(Patient $patient)
    {
        $this->patient = $patient;
    }

    public function index()
    {
        return $this->patient
            ->orderBy('id', 'DESC') ;
    }

    public function search( $field,  $query)
    {
        return $this->patient->search($field, $query)->paginate(10);
    }

    public function store(Request $request)
    {
        $patient = new Patient();
        $patient->booking_serial_code=$request->booking_serial_code;
        $patient->name=$request->name;
        $patient->email=$request->email;
        $patient->phone=$request->phone;
        $patient->serial_no=$request->serial_no;
        $patient->address=$request->address;
        $patient->patient_type=$request->patient_type;
        $patient->user_id=$request->user_id;
        $patient->organization_id=$request->organization_id;
        $patient->doctor_id=$request->doctor_id;
        $patient->chamber_id=$request->chamber_id;
        $patient->agent_id=$request->agent_id;
        $patient->save();
        return $patient;
    }

    public function show(Patient $Patient)
    {
        return $Patient;
    }

    public function update(Request $request, Patient $patient)
    {
        $patient->booking_serial_code=$request->booking_serial_code;
        $patient->name=$request->name;
        $patient->email=$request->email;
        $patient->phone=$request->phone;
        $patient->serial_no=$request->serial_no;
        $patient->address=$request->address;
        $patient->patient_type=$request->patient_type;
        $patient->user_id=$request->user_id;
        $patient->organization_id=$request->organization_id;
        $patient->doctor_id=$request->doctor_id;
        $patient->chamber_id=$request->chamber_id;
        $patient->agent_id=$request->agent_id;
        $patient->save();
        return $patient;
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
    }

    public function storeValidate(Request $request){

        return Validator::make($request->all(), $this->patient->storeRules());

    }

    public function editValidate(Request $request){

        return Validator::make($request->all(), $this->patient->editRules());

    }
}

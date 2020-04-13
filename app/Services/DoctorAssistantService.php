<?php

namespace App\Services;


use App\Models\DoctorAssistant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorAssistantService
{

    public $doctorAssistant;

    /**
     * DoctorAssistantController constructor.
     * @param $DoctorAssistant
     * @param $DoctorAssistantService
     */
    public function __construct(DoctorAssistant $doctorAssistant)
    {
        $this->doctorAssistant = $doctorAssistant;
    }

    public function index()
    {
        return $this->doctorAssistant
            ->orderBy('id', 'DESC');
    }

    public function search( $field,  $query)
    {
        return $this->doctorAssistant->search($field, $query)->paginate(10);
    }

    public function store(Request $request)
    {
        $doctorAssistant = new DoctorAssistant();
        $doctorAssistant->name=$request->name;
        $doctorAssistant->type=$request->type;
        $doctorAssistant->email=$request->email;
        $doctorAssistant->phone=$request->phone;
        $doctorAssistant->address=$request->address;
        $doctorAssistant->user_id='1';
        $doctorAssistant->organization_id=$request->organization_id;
        $doctorAssistant->doctor_id=$request->doctor_id;
        $doctorAssistant->save();
        return $doctorAssistant;
    }

    public function show(DoctorAssistant $doctorAssistant)
    {
        return $doctorAssistant;
    }

    public function update(Request $request)
    {
        $doctorAssistant = DoctorAssistant::find($request->id);
        
        $doctorAssistant->name=$request->name;
        $doctorAssistant->type=$request->type;
        $doctorAssistant->email=$request->email;
        $doctorAssistant->phone=$request->phone;
        $doctorAssistant->address=$request->address;
        // $doctorAssistant->user_id=$request->user_id;
        $doctorAssistant->user_id='1';
        $doctorAssistant->organization_id=$request->organization_id;
        $doctorAssistant->doctor_id=$request->doctor_id;
        $doctorAssistant->save();
        return $doctorAssistant;
    }

    public function findAssistant($doctorId)
        {
            return $this->doctorAssistant->find($doctorId);
        }

    public function destroy(DoctorAssistant $doctorAssistant)
    {
        $doctorAssistant->delete();
    }

    public function storeValidate(Request $request){

        return Validator::make($request->all(), $this->doctorAssistant->storeRules());

    }

    public function editValidate(Request $request){

        return Validator::make($request->all(), $this->doctorAssistant->editRules());

    }
}

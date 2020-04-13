<?php


namespace App\Services;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DoctorService extends AppService
{
    public $doctor;
    public $userServices;

    /**
     * DoctorController constructor.
     * @param $doctor
     * @param $doctorService
     */
    public function __construct(Doctor $doctor,  UserService $userServices)
    {
        $this->userServices = $userServices;
        $this->doctor = $doctor;
    }

    public function index()
    {
        return $this->doctor
            ->leftJoin('organizations', 'organizations.id', 'doctors.organization_id')
            ->leftJoin('chambers', 'chambers.id', 'doctors.chamber_id')
            ->orderBy('id', 'DESC')
            ->select([
                "doctors.*",
                "chambers.chamber_name",
                "organizations.organization_name",
            ]);
    }

    public function search($field, $query)
    {
        return $this->doctor->search($field, $query)->paginate(10);
    }

    public function store(Request $request){

        $image = $request->file('image');
        if ($image) {
            $image_name = str_random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_fullName = $image_name.'.'.$ext;
            $upload_path = 'public/photos/doctor/';
            $image_url = $upload_path.$image_fullName;
            $Successfully = $image->move($upload_path,$image_fullName);
        }
        // dd($image_fullName);

        $user = $this->storeDoctorUser($request);

        $doctor = new Doctor();
        $doctor->name = $request->name;

        if ($image_url) {
           $doctor->image = $image_url;
       }

        $doctor->degree = $request->degree;
        $doctor->doc_bmdc_no = $request->doc_bmdc_no;
        $doctor->address = $request->address;
        $doctor->phone = $request->phone;
        $doctor->email = $request->email;
        $doctor->gender = $request->gender;
        $doctor->district_id = $request->district_id;
        $doctor->division_id = $request->division_id;
        $doctor->thana_id = $request->thana_id;
        $doctor->d_b_status = $request->d_b_status;
        $doctor->user_id = $user->id;
        $doctor->organization_id = $request->organization_id;
        $doctor->chamber_id = $request->chamber_id;
        $doctor->doc_type = $request->doc_type;
        // $doctor->image = $request->image;
        $doctor->fees = $request->fees;
        $doctor->second_fees = $request->second_fees;
        $doctor->status = 1;
        // $doctor->created_by = Auth::user()->id;
        $doctor->save();
        $doctor->chambers()->attach([$request->chamber_id]);
        return $doctor;
    }

    public function findDoctor($doctorId)
    {
        return $this->doctor->find($doctorId);
    }

    public function decryptDoctorId($doctorEncryptedId){

        try{

            return $this->decryptString($doctorEncryptedId);

        }catch (\Exception $e){  return false; }
    }

    public function update(Request $request)
    {
        $image = $request->file('image');
        if ($image) {
            $image_name = str_random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_fullName = $image_name.'.'.$ext;
            $upload_path = 'public/photos/doctor/';
            $image_url = $upload_path.$image_fullName;
            $Successfully = $image->move($upload_path,$image_fullName);
        }
        $doctor = Doctor::find($request->id);
        $doctor->name = $request->name;
        $doctor->degree = $request->degree;
        $doctor->doc_bmdc_no = $request->doc_bmdc_no;
        $doctor->address = $request->address;
        $doctor->phone = $request->phone;
        $doctor->gender = $request->gender;
        $doctor->district_id = $request->district_id;
        $doctor->division_id = $request->division_id;
        $doctor->thana_id = $request->thana_id;
        $doctor->d_b_status = $request->d_b_status;
        $doctor->organization_id = $request->organization_id;
        $doctor->chamber_id = $request->chamber_id;
        $doctor->doc_type = $request->doc_type;

        if ($image_url) {
         $doctor->image = $image_url;
        }

        $doctor->fees = $request->fees;
        $doctor->second_fees = $request->second_fees;
        $doctor->save();

        $doctor->chambers()->sync([$request->chamber_id]);
        return $doctor;
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
    }
    public function storeValidate(Request $request){
        return Validator::make($request->all(), $this->doctor->storeRules());
    }

    public function editValidate(Request $request){
        return Validator::make($request->all(), $this->doctor->editRules());
    }

    private function storeDoctorUser($request)
    {
        $userRequest  =  new \stdClass();
        $userRequest->name  =  $request->name;
        $userRequest->email  =  $request->email;
        $userRequest->password  =  Hash::make('secret');
        $userRequest->user_type  =  2;
        $userRequest->phone  =  $request->phone;

        return $this->userServices->store($userRequest);
    }
}

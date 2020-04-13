<?php

namespace App\Http\Controllers;
use yajra\Datatables\Datatables;
use Session;
use DB;
use App\Models\DoctorAssistant;
use App\Services\DoctorAssistantService;
use Illuminate\Http\Request;

class DoctorAssistantController extends Controller
{

    public $doctorAssistantService;

    /**
     * DoctorAssistantController constructor.
     * @param $DoctorAssistant
     * @param $DoctorAssistantService
     */
    public function __construct(DoctorAssistantService $doctorAssistantService)
    {
        $this->doctorAssistantService = $doctorAssistantService;
    }


    /**
     */
    public function index()
    {
       return view('doctor/master/doctor_assistant/doctor_assistant');
    }

    public function getData()
    {
       $resData = $this->doctorAssistantService->index();
       return Datatables::of($resData)
       ->addColumn('action', function ($resData){
        $id = $resData['id'];
        return "<button style=' type='button' class='btn btn-success btn-sm' data-toggle='modal' data-target='#targetModal' onclick='edit_data($id)'>Edit</button><button style=' type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#targetModal' onclick='delete_data($id)'>Delete</button>";         
        })
    // ->removeColumn('id', 'is_sub_admin')
       ->rawColumns(['action'])
       ->make(true);
    }

    public function create(){
        $organizations = DB::table('organizations')->select('organizations.*')->get();
        $data['organizations'] = $organizations;
        return view('doctor/master/doctor_assistant/create')->with($data);
    }

    public function getDoctor(Request $request){
        $organization_id = $request['organization_id'];
        $doctors = DB::table('doctors')->select('doctors.*')->where('organization_id', $organization_id)->get();

        foreach ($doctors as $dis) {
            $dis_data = $dis->name;
            $id = $dis->id;
            echo "<option value='$id'>$dis_data</option>";
        }
        
    }

    public function edit($id){
        $organizations = DB::table('organizations')->select('organizations.*')->get();
        $data['organizations'] = $organizations;
        $doctors = DB::table('doctors')->select('doctors.*')->get();
        $data['doctors'] = $doctors;

        $doctor_assistants = DB::table('doctor_assistants')->select('doctor_assistants.*')->where('id', $id)->get();
        $data['result_data'] = $doctor_assistants[0];
        return view('doctor/master/doctor_assistant/edit')->with($data);
    }

    /**
     * For search
     */
    public function search($field, $queryString)
    {
        try {

            return  $this->doctorAssistantService->search($field, $queryString);

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        try {

            // $validate = $this->doctorAssistantService->storeValidate($request);

            // if ($validate->fails()) {
            //     return $this->respondInvalidRequest($validate->errors());
            // }

            $doctorAssistant = $this->doctorAssistantService->store($request);

            // return $this->respondCreated('DoctorAssistant Created Successfully',  $doctorAssistant);
            Session::flash('success', 'Data Save Successfully');

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(DoctorAssistant $doctorAssistant)
    {
        try {

            if (!$doctorAssistant) {
                return $this->respondNotFound('DoctorAssistant does not exists');
            }

            return $this->respond( $this->doctorAssistantService->show($doctorAssistant));

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
    public function update(Request $request)
    {
        try {

            // $validate = $this->doctorAssistantService->editValidate($request);

            // if ($validate->fails()) {
            //     return $this->respondInvalidRequest($validate->errors());
            // }

            $doctorAssistant = $this->doctorAssistantService->update($request);

            // return $this->respond( $doctorAssistant);
            Session::flash('success', 'Data Update Successfully');

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    public function delete($id){
        return view('doctor/master/doctor_assistant/delete')->with('main_id',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     */
    public function destroy($doctorId)
    {
        try {

            if (!$doc_assis = $this->doctorAssistantService->findAssistant($doctorId)) {

                Session::flash('success', 'Does Not exists');
            }

            $this->doctorAssistantService->destroy($doc_assis);

            // return $this->respondDeleted("DoctorAssistant Deleted Successfully ");
            Session::flash('success', 'Data Delete Successfully');
            return redirect('doctor_assistant');


        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

}

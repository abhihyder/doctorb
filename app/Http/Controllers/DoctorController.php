<?php

namespace App\Http\Controllers;

use App\Libraries\Encryption;
use App\Models\AreaInfo;
use App\Models\Booking;
use App\Models\Coin;
use App\Models\OperationSchedule;
use App\Models\Patient;
use App\Services\OperationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;
use App\Services\DoctorService;
use Illuminate\Http\Request;
use yajra\Datatables\Datatables;

class DoctorController extends Controller
{
    public $doctorService;
    public $doctorWrapper;

    /**
     * DoctorController constructor.
     */
    public function __construct(DoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return view('doctor/master/doctor/doctor');
    }

    public function getData()
    {
        $resData = $this->doctorService->index();
        return Datatables::of($resData)
            ->addColumn('action', function ($resData) {
                $id = $resData['id'];
                return "<button style=' type='button' class='btn btn-success btn-sm' data-toggle='modal' data-target='#targetModal' onclick='edit_data($id)'>Edit</button><button style=' type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#targetModal' onclick='delete_data($id)'>Delete</button><button style=' type='button' class='btn btn-primary btn-sm' onclick='coin_assign(".$resData['user_id'].")'>Coin Assign</button>";
            })
            ->addColumn('image', function ($resData) {
                $url = asset($resData['image']);
                return '<img src=' . $url . ' border="0" width="70" class="img-rounded" align="center" />';
            })
            ->editColumn('status', function ($resData) {
                if ($resData['status'] == 0) {
                    $activate = 'class="text-danger"';
                } else {
                    $activate = 'class="text-success"';
                }
                return '<span ' . $activate . '><b>' . $resData['status'] . '</b></span>';
            })
            ->rawColumns(['status', 'action', 'image'])
            ->make(true);
    }

    public function create()
    {
        $divisions = AreaInfo::division()->get();
        $data['divisions'] = $divisions;
        $organizations = DB::table('organizations')->select('organizations.*')->get();
        $data['organizations'] = $organizations;
        return view('doctor/master/doctor/create')->with($data);
    }

    public function edit($id)
    {
        $divisions = AreaInfo::division()->get();
        $data['divisions'] = $divisions;
        $districts = AreaInfo::allDistricts()->get();

        $data['districts'] = $districts;
        $thanas = AreaInfo::allThanas()->get();
        $data['thanas'] = $thanas;
        $organizations = DB::table('organizations')->select('organizations.*')->get();
        $data['organizations'] = $organizations;
        $chambers = DB::table('chambers')->select('chambers.*')->get();
        $data['chambers'] = $chambers;

        $doctors = DB::table('doctors')->select('doctors.*')->where('id', $id)->get();
        $data['result_data'] = $doctors[0];
        return view('doctor/master/doctor/edit')->with($data);
    }
    /**
     * For search
     */
    public function search($field, $queryString)
    {
        try {

            return $this->doctorService->search($field, $queryString);

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

            /*$validate = $this->doctorService->storeValidate($request);

            if ($validate->fails()) {
                return $this->respondInvalidRequest($validate->errors());
            }*/
            // dd($request->all());

            $doctor = $this->doctorService->store($request);

            // return $this->respondCreated('Doctor Created Successfully',  $doctor);
            Session::flash('success', 'Data Save Successfully');

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show($encryptedDoctorId)
    {
        try {

            if (!$doctorId = $this->doctorService->decryptDoctorId($encryptedDoctorId)) {

                return $this->respondNotFound('Doctor id is invalid');
            }

            return $this->respond($this->doctorService->findDoctor($doctorId));

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
    public function update(Request $request)
    {
        try {

            /*if (!$doctorId = $this->doctorService->decryptDoctorId($encryptedDoctorId)) {

                return $this->respondNotFound('Doctor id is invalid');
            }
            $validate = $this->doctorService->editValidate($request);

            if ($validate->fails()) {
                return $this->respondInvalidRequest($validate->errors());
            }

            if (!$doctor = $this->doctorService->findDoctor($doctorId)) {

                return $this->respondNotFound('Doctor does not exists');
            }*/

            $doctor = $this->doctorService->update($request);
            Session::flash('success', 'Data Update Successfully');

            // return $this->respond( $doctor);

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */

    public function delete($id)
    {
        return view('doctor/master/doctor/delete')->with('main_id', $id);
    }

    public function destroy($doctorId)
    {
        try {

            /* if (!$doctorId = $this->doctorService->decryptDoctorId($encryptedDoctorId)) {

                 return $this->respondNotFound('Doctor id is invalid');
             }*/

            if (!$doctor = $this->doctorService->findDoctor($doctorId)) {

                Session::flash('success', 'Does Not exists');
            }

            $this->doctorService->destroy($doctor);
            Session::flash('success', 'Data Delete Successfully');
            return redirect('doctor');
            // return $this->respondDeleted("Doctor Deleted Successfully ");


        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }



    // For doctor panel----------------------------------------------

    public function patientListByDoctor()
    {
	    return view('doctor/doctorpanel/patient_list');
    }

	public function getPatientList()
	{
		$doctor_id = Auth::user()->id ;
		$patientList = Booking::where('doc_id',$doctor_id)
		                      ->orderby('id','desc')
		                      ->get(['id','patient_name','mobile_no','address']);
		return Datatables::of($patientList)
		                 ->addColumn('action', function ($patientList) {
			                 $id = Encryption::encodeId($patientList->id);
			                 return "<a href=". url('/doctor-panel/view-patient-details/'.$id ). " style=' type='button' class='btn btn-success btn-sm'>View Details</a>";
		                 })

//		                 ->editColumn('status', function ($resData) {
//			                 if ($resData['status'] == 0) {
//				                 $activate = 'class="text-danger"';
//			                 } else {
//				                 $activate = 'class="text-success"';
//			                 }
//			                 return '<span ' . $activate . '><b>' . $resData['status'] . '</b></span>';
//		                 })

		                 ->rawColumns(['action'])
		                 ->make(true);
	}

	public function viewPatientDetails($booking_id)
	{
		$booking_id = Encryption::decodeId($booking_id);
		$detailsInfo = Booking::find($booking_id);
		return view('doctor/doctorpanel/patient_details',compact('detailsInfo'));
	}


	// ====== Operation Schedule Part ====== //

	public function  operationSchedule()
	{
		return view('doctor/doctorpanel/operation_schedule');
	}

	public function operationScheduleList()
	{
		$doctor_id = Auth::user()->id ;
		$operationList = OperationSchedule::where('doctor_id',$doctor_id)
		                      ->orderby('id','desc')
		                      ->get(['id','title','organization','date','time','status']);
		return Datatables::of($operationList)
		                 ->addColumn('action', function ($operationList) {
			                 $id = Encryption::encodeId($operationList->id);
			                 return "<a href=". url('/doctor-panel/view-operation-schedule-details/'.$id ). " style=' type='button' class='btn btn-success btn-sm'>View Details</a> <button class='btn btn-warning btn-sm edit_operation_schedule' value=".$id.">Edit</button>";
		                 })

		                 ->editColumn('status', function ($resData) {
			                 if ($resData->status == 3) {
				                 $activate = 'class="text-danger"';
				                 $status = "High";
			                 }elseif ($resData->status == 2) {
				                 $activate = 'class="text-info"';
				                 $status = "Medium";
			                 } else {
				                 $activate = 'class="text-success"';
				                 $status = "Low";
			                 }
			                 return '<span ' . $activate . '><b>' . $status . '</b></span>';
		                 })
                         ->rawColumns(['action','status'])
		                 ->make(true);
	}

	public function operationScheduleStore(Request $request)
	{
		try {

			$this->validate($request,[
				'title' => 'required',
				'organization' => 'required',
			]);

			$title = $request->get('title');
			$details = $request->get('details');
			$organization = $request->get('organization');
			$date = $request->get('date');
			$time = $request->get('time');
			$status = $request->get('status');

			DB::beginTransaction();
			$opScheduleObj = new OperationSchedule();
			$opScheduleObj->doctor_id = Auth::user()->id;
			$opScheduleObj->title = $title;
			$opScheduleObj->details = $details;
			$opScheduleObj->organization = $organization;
			$opScheduleObj->date = $date;
			$opScheduleObj->time = $time;
			$opScheduleObj->status = $status;
			$opScheduleObj->save();

			DB::commit();

			Session::flash('success','Successfully Store Data');
			return redirect()->back();

		}catch(\Exception $e){
			DB::rollBack();
			Session::flash('success','Something went wrong'.$e->getMessage());
			return redirect()->back();
		}
	}
	public function operationScheduleUpdate(Request $request)
	{
		try {

			$this->validate($request,[
				'title' => 'required',
				'organization' => 'required',
			]);

			$id = Encryption::decodeId($request->get('id'));

			DB::beginTransaction();
			OperationSchedule::where('id',$id)->update([
				'title' => $request->get('title'),
				'details' => $request->get('details'),
				'organization' => $request->get('organization'),
				'date' => $request->get('date'),
				'time' => $request->get('time'),
				'status' => $request->get('status'),
			]);
			DB::commit();

			Session::flash('success','Successfully Updated Data');
			return redirect()->back();

		}catch(\Exception $e){
			DB::rollBack();
			Session::flash('success','Something went wrong'.$e->getMessage());
			return redirect()->back();
		}
	}

	public function operationScheduleEdit(Request $request)
	{
		try {

			$id = Encryption::decodeId($request->get('id'));
			$opScheduleInfo = OperationSchedule::find($id);
			$data = strval(view('doctor/doctorpanel/operation_schedule_edit',compact('opScheduleInfo')));
			return response()->json(['responseCode' => 1,'data' => $data]);

		}catch(\Exception $e){
			return response()->json(['responseCode' => 0,'data' => 'Something went wrong'.$e->getMessage()]);
		}
	}

	// ====== End Operation Schedule Part ====== //


	public function  doctorCoinAssign(Request $request)
	{
		try{


			$this->validate($request , [
				'coin' => 'required',
				'doctor_user_id' => 'required',
			]);

			$coinObj = Coin::where(['user_id' => $request->get('doctor_user_id')])->first();

			if($coinObj){
				$coinObj->total_coin = intval($coinObj->total_coin) + $request->get('coin');
				$coinObj->save();
			}else{
				$coinObj = new Coin();
				$coinObj->total_coin = $request->get('coin');
				$coinObj->user_id = $request->get('doctor_user_id');
				$coinObj->save();
			}

			Session::flash('success','Coin Assigned Successfully ');
			return redirect()->back();

		} catch (\Exception $e){
			Session::flash('error','Something Went Wrong'.$e->getMessage());
			return redirect()->back();
		}
	}


	public function  doctorCoins()
	{
		$coinsInfo = Coin::where('user_id',Auth::user()->id)->first();
		return view('doctor/doctorpanel/doctor_coins','coinsInfo');
	}

}

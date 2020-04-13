<?php

namespace App\Http\Controllers;

use App\Models\AreaInfo;
use App\Models\Chamber;
use App\Models\Organization;
use App\Libraries\Encryption;
use Illuminate\Support\Facades\Session;
use App\Services\ChamberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use yajra\Datatables\Datatables;

class ChamberController extends Controller
{
    public $chamberService;


    public function __construct(ChamberService $chamberService)
    {
        $this->chamberService = $chamberService;
    }

    public function index()
    {
        return view('doctor/master/chamber/chamber');

    }

    public function getChamber(Request $request){
        $organization_id = $request['organization_id'];
        $org_datas = DB::table('chambers')->select('chambers.*')->where('organization_id', $organization_id)->get();

        foreach ($org_datas as $org_data) {
            $dis_data = $org_data->chamber_name;
            $id = $org_data->id;
            echo "<option value='$id'>$dis_data</option>";
        }

    }

    public function getData()
    {
        $resData = $this->chamberService->index();
        // echo "<pre>";print_r($resData);die;
        return Datatables::of($resData)
            ->addColumn('action', function ($resData) {
                $id = $resData['id'];
                $delId = Encryption::encodeId($id);
                return "<button style=' type='button' class='btn btn-success btn-sm' data-toggle='modal' data-target='#targetModal' onclick='view_data($id)'>View</button>

                <button style=' type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#targetModal' onclick='edit_data($id)'>Edit</button>

                <a  href='". url('chamber/delete/'. $delId )."' class='btn btn-danger btn-sm' data-toggle='confirm' data-text='Are you sure want to delete?'>
                Delete
            </a>";
            })
            ->editColumn('status', function ($resData) {
                if ($resData['status'] == 0) {
                    $activate = 'class="text-danger"';
                } else {
                    $activate = 'class="text-success"';
                }
                return '<span ' . $activate . '><b>' . $resData['status'] . '</b></span>';
            })
            // ->removeColumn('id', 'is_sub_admin')
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function create()
    {
        // $divisions = DB::table('divisions')->select('divisions.*')->get();
        $divisions = AreaInfo::select('id','name')->where('area_type', 1)->get();
        $data['divisions'] = $divisions;
        return view('doctor/master/chamber/create')->with($data);
    }

    public function edit($id)
    {
        $areaInfo = AreaInfo::select('id','name')->get();
        $data['areaInfo'] = $areaInfo;
        // $districts = DB::table('districts')->select('districts.*')->get();
        // $data['districts'] = $districts;
        // $thanas = DB::table('thanas')->select('thanas.*')->get();
        // $data['thanas'] = $thanas;
        $organizations = Organization::get();
        $data['organizations'] = $organizations;

        $chambers = Chamber::find($id);
        $data['result_data'] = $chambers;
        return view('doctor/master/chamber/edit')->with($data);
    }


    public function delete($id)
    {
        $id = Encryption::decodeId($id);
        $chamber= Chamber::find($id); //fetch data
        $chamber->delete(); // Data delete
        Session::flash('success', 'Data Deleted Successfully');
        return redirect('chamber');
        // return view('doctor/master/chamber/delete')->with('main_id', $id);
    }


    public function search($field, $query)
    {
        try {

            return $this->chamberService->search($field, $query);

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
        
 
            // $validate = $this->chamberService->storeValidate($request);

            // if ($validate->fails()) {
            //     return $this->respondInvalidRequest($validate->errors());
            // }

            // $chamber = $this->chamberService->store($request);
            // // return $this->respondCreated('Chamber Created Successfully',  $chamber);
            // Session::flash('success', 'Data Save Successfully');

            // My store code----------------
            $data=[
                'organization_id'=>$request->organization_id,
                'chamber_name'=>$request->chamber_name,
                'chamber_address'=> $request->chamber_address,
                'division_id'=> $request->division_id,
                'district_id'=> $request->district_id,
                'thana_id'=> $request->thana_id,
                'room_no'=> $request->room_no,
                'phone'=> $request->phone,
                'status'=> 0,
            ];
            // return response()->json($data);

            DB::beginTransaction();
            Chamber::create($data);

			DB::commit();

			Session::flash('success','Successfully Store Data');
			return redirect()->back();

        } catch (\Exception $e) {
			DB::rollBack();
			Session::flash('success','Something went wrong'.$e->getMessage());
			return redirect()->back();
        }
    }

    public function details($id)
    {
        try {

            $chamber = Chamber::where('chambers.id', $id)->first();

            $divId= $chamber->division_id;
            $disId= $chamber->district_id;
            $thaId= $chamber->thana_id;
            $orgId= $chamber->organization_id;
            
            $areaInfo = AreaInfo::select('name')
            ->whereIn('id', [$divId,  $disId, $thaId])
            ->get();
            $data['areaInfo'] = $areaInfo;

            $organization = Organization::select('organization_name')
            ->where('id', $orgId)
            ->first();
            $data['organization'] = $organization;

            $data['chamber'] = $chamber;
            return view('doctor/master/chamber/view')->with($data);

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }
    public function show($encryptedChamberId)
    {
        try {

            if (!$chamberId = $this->chamberService->decryptChamberId($encryptedChamberId)) {

                return $this->respondNotFound('Chamber id is invalid');
            }

            return $this->respond($this->chamberService->findChamber($chamberId));

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {

            /*if (!$chamberId = $this->chamberService->$encryptedChamberId) {

                return $this->respondNotFound('Chamber id is invalid');
            }

            $validate = $this->chamberService->editValidate($request);

            if ($validate->fails()) {
                return $this->respondInvalidRequest($validate->errors());
            }

            if (!$chamber = $this->chamberService->findChamber($chamberId)) {

                return $this->respondNotFound('Chamber does not exists');
            }*/

            $chamber = $this->chamberService->update($request);

            // return $this->respond( $chamber);
            Session::flash('success', 'Data Update Successfully');

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    public function destroy($chamberId)
    {
        try {

            /*if (!$chamberId = $this->chamberService->decryptChamberId($encryptedChamberId)) {

                return $this->respondNotFound('Chamber id is invalid');
            }*/

            if (!$chamber = $this->chamberService->findChamber($chamberId)) {

                Session::flash('success', 'Does Not exists');
            }

            $this->chamberService->destroy($chamber);

            // return $this->respondDeleted("Chamber Deleted Successfully ");
            Session::flash('success', 'Data Delete Successfully');
            return redirect('chamber');


        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }
}

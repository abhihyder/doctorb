<?php

namespace App\Services;

use App\Models\Chamber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ChamberService extends AppService
{
    public $chamber;

    /**
     * ChamberController constructor.
     * @param $chamber
     */
    public function __construct(Chamber $chamber)
    {
        $this->chamber = $chamber;
    }

    public function index()
    {
        return $this->chamber
            ->leftJoin('organizations', 'organizations.id', 'chambers.organization_id')
            ->leftJoin('doctor_chambers', 'doctor_chambers.chamber_id', 'chambers.id')
            ->leftJoin('doctors', 'doctors.id', 'doctor_chambers.doctor_id')
            ->orderBy('id', 'DESC')
            ->select([
                "chambers.*",
                "doctors.name as assigned_doctor",
                "organizations.organization_name"
            ])->get();

    }

    public function search($field, $query)
    {
        return $this->chamber->search($field, $query)->paginate(10);
    }

    public function store(Request $request)
    {
        $chamber = new Chamber();
        $chamber->chamber_name = $request->chamber_name;
        $chamber->chamber_address = $request->chamber_address;
        $chamber->phone = $request->phone;
        $chamber->room_no = $request->room_no;
        $chamber->district_id = $request->district_id;
        $chamber->division_id = $request->division_id;
        $chamber->thana_id = $request->thana_id;
        $chamber->organization_id = $request->organization_id;
        // $chamber->created_by = Auth::user()->id;
        $chamber->status = 1;
        $chamber->save();
        return $chamber;
    }

    public function findChamber($chamberId)
    {
        return $this->chamber->find($chamberId);
    }

    public function decryptChamberId($chamberEncryptedId)
    {
        try {

            return $this->decryptString($chamberEncryptedId);

        } catch (\Exception $e) {

            Log::error($e->getTraceAsString());
            return false;
        }
    }

    public function update(Request $request)
    {
        $chamber = Chamber::find($request->id);
        $chamber->chamber_name = $request->chamber_name;
        $chamber->chamber_address = $request->chamber_address;
        $chamber->phone = $request->phone;
        $chamber->room_no = $request->room_no;
        $chamber->district_id = $request->district_id;
        $chamber->division_id = $request->division_id;
        $chamber->thana_id = $request->thana_id;
        $chamber->organization_id = $request->organization_id;
        $chamber->save();
        return $chamber;
    }

    public function destroy(Chamber $chamber)
    {
        $chamber->delete();
    }

    public function storeValidate(Request $request)
    {
        return Validator::make($request->all(), $this->chamber->storeRules());
    }

    public function editValidate(Request $request)
    {
        return Validator::make($request->all(), $this->chamber->editRules());
    }

}

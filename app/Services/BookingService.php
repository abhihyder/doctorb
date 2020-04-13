<?php

namespace App\Services;


use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookingService
{

    public $booking;
    public $bookingService;

    /**
     * BookingController constructor.
     * @param $booking
     * @param $bookingService
     */
    public function __construct(Booking $booking)
    {
        $this->booking  = $booking;
    }

    public function index()
    {
        return $this->booking
            ->orderBy('id', 'DESC');
    }

    public function search( $field,  $query)
    {
        return $this->booking->search($field, $query)->paginate(10);
    }

    public function store(Request $request)
    {
        $booking = new Booking();
        $booking->booking_serial_code = uniqid(time());
        $booking->patient_name = $request->patient_name;
        $booking->mobile_no = $request->mobile_no;
        $booking->serial_no = $request->serial_no;
        $booking->visited_time = $request->visited_time;
        $booking->address = $request->address;
        $booking->organization_id = $request->organization_id;
        $booking->doctor_id = $request->doctor_id;
        $booking->patient_id = $request->patient_id;
        $booking->agent_id = $request->agent_id;
        $booking->chamber_id = $request->chamber_id;
        $booking->organization_branch_id = $request->organization_branch_id;
        $booking->user_id = $request->user_id;
        $booking->created_by = (Auth::check()) ? Auth::user()->id : 0;
        $booking->created_at = $request->created_at;
        $booking->save();
        return $booking;
    }



    public function show(Booking $booking)
    {
        return $booking;
    }

    public function update(Request $request, Booking $booking)
    {
        $booking->patient_name = $request->patient_name;
        $booking->mobile_no = $request->mobile_no;
        $booking->serial_no = $request->serial_no;
        $booking->visited_time = $request->visited_time;
        $booking->address = $request->address;
        $booking->organization_id = $request->organization_id;
        $booking->doctor_id = $request->doctor_id;
        $booking->patient_id = $request->patient_id;
        $booking->agent_id = $request->agent_id;
        $booking->chamber_id = $request->chamber_id;
        $booking->organization_branch_id = $request->organization_branch_id;
        $booking->updated_at = now();
        $booking->save();
        return $booking;
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
    }

    public function storeValidate(Request $request){

        return Validator::make($request->all(), $this->booking->storeRules());

    }

    public function editValidate(Request $request){

        return Validator::make($request->all(), $this->booking->editRules());

    }
}

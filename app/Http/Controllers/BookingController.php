<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\Request;
use yajra\Datatables\Datatables;

class BookingController extends Controller
{

    public $bookingService;

    /**
     * BookingController constructor.
     * @param $booking
     * @param $bookingService
     */
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function getData()
    {
       $resData = $this->bookingService->index();
       return Datatables::of($resData)
       ->addColumn('action', function ($resData){
        $id = $resData['id'];
        return "<button style=' type='button' class='btn btn-success btn-sm' data-toggle='modal' data-target='#targetModal' onclick='edit_data($id)'>Edit</button><button style=' type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#targetModal' onclick='delete_data($id)'>Delete</button>";
        })
      /* ->editColumn('status', function ($resData) {
        if ($resData['status'] == 0) {
            $activate = 'class="text-danger"';
        } else {
            $activate = 'class="text-success"';
        }
        return '<span ' . $activate . '><b>' . $resData['status'] . '</b></span>';
    })*/
       ->rawColumns(['action'])
       ->make(true);
    }

    /**
     */
    public function index()
    {

        return view('doctor/master/booking/booking');
    }

    /**
     * For search
     */
    public function search($field, $queryString)
    {
        try {

            return $this->bookingService->search($field, $queryString);

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $validate = $this->bookingService->storeValidate($request);

            if ($validate->fails()) {
                return $this->respondInvalidRequest($validate->errors());
            }

            $booking = $this->bookingService->store($request);

            return $this->respondCreated('Booking Created Successfully', $booking);

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        try {

            if (!$booking) {
                return $this->respondNotFound('Booking does not exists');
            }

            return $this->respond($this->bookingService->show($booking));

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        try {

            $validate = $this->bookingService->editValidate($request);

            if ($validate->fails()) {
                return $this->respondInvalidRequest($validate->errors());
            }

            $booking = $this->bookingService->update($request, $booking);

            return $this->respond($booking);

        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        try {

            if (!$booking) {

                return $this->respondNotFound('Booking does not exists');
            }

            $this->bookingService->destroy($booking);

            return $this->respondDeleted("Booking Deleted Successfully ");


        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }
}

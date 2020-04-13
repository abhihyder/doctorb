<?php
namespace App\Http\Controllers;
use Session;
use DB;
use App\Services\BookingService;
use Illuminate\Http\Request;
use yajra\Datatables\Datatables;
use App\Libraries\Encryption;

/**
 * 
 */
class ChamberPanelController extends Controller
{
	public $bookingService;
	
	function __construct(BookingService $bookingService)
	{
		$this->bookingService = $bookingService;
	}

	public function index(){
		return view('doctor/doctorpanel/chamber/index');
	}

	public function getChamber(){
		return view('doctor/doctorpanel/chamber/list');
	}

	public function getData()
	{
	   $resData = $this->bookingService->index();
       return Datatables::of($resData)
       ->addColumn('action', function ($resData){
        $id = $resData['id'];
        return "<button style=' type='button' class='btn btn-success btn-sm' data-toggle='modal' data-target='#targetModal' onclick='view_data($id)'>View</button>";
        })
       ->rawColumns(['action'])
       ->make(true);
	}


	public function view_data($id){
		return view('doctor/doctorpanel/chamber/details');
	}










}
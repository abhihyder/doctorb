<?php
namespace App\Http\Controllers;
use Session;
use DB;
use App\Services\PrescriptionService;
use Illuminate\Http\Request;
use yajra\Datatables\Datatables;
use App\Libraries\Encryption;

/**
 * 
 */
class PrescriptionController extends Controller
{
	public $prescriptionService;
	
	function __construct(PrescriptionService $prescriptionService)
	{
		$this->prescriptionService = $prescriptionService;
	}

	public function index(){
		$date = date('Y-m-d');
		$bookings = DB::table('bookings')->select('bookings.*')->where('created_at',$date)->get();
		$data['bookings'] = $bookings;
		return view('doctor/master/prescription/index')->with($data);
	}

	public function getPationsName($id){
	    $bookings = DB::table('bookings')->select('bookings.*')->where('id', $id)->get();

	    // echo $bookings;
	    if (!empty($bookings)) {
	    	$dataBooking = $bookings[0];
	    }
	    echo json_encode($dataBooking);
	    
	}

	public function store(){
		echo "mjjh";die;
	}










}
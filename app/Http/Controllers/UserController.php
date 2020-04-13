<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{

    public $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function index()
    {
        try {

//            return $this->userService->index();
	        return view('user.index');


        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        //
    }

    public function getList()
    {
	    $data = $this->userService->dataTableData();
	    return Datatables::of($data)
	                     ->addColumn('action', function ($resData){
		                     return ' <a href="' . url('users/view/' . $resData['id'] ). '" class="btn btn-sm btn-primary open" ><i class="fa fa-folder-open-o"></i> Edit</a>';
	                     })
//	                     ->editColumn('status', function ($resData) {
//		                     if ($resData['status'] == 0) {
//			                     $activate = 'class="text-danger"';
//		                     } else {
//			                     $activate = 'class="text-success"';
//		                     }
//		                     return '<span ' . $activate . '><b>' . $resData['status'] . '</b></span>';
//	                     })
		               ->removeColumn('id')
		                 ->rawColumns(['status','action'])
	                     ->make(true);
    }
}

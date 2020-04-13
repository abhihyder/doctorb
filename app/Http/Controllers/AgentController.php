<?php

namespace App\Http\Controllers;
use Session;
use DB;
use App\Services\AgentService;
use Illuminate\Http\Request;
use yajra\Datatables\Datatables;
use App\Libraries\Encryption;
class AgentController extends Controller
{

    public $agentService;

    /**
     * AgentController constructor.
     * @param $agent
     * @param $agentService
     */
    public function __construct(AgentService $agentService)
    {
        $this->agentService = $agentService;
    }


    /**
     * @return \App\Http\Resources\Agent\AgentCollection
     */
    public function index()
    {
        return view('doctor/master/agent/agent');
    }
    public function getData()
    {
       $resData = $this->agentService->index();
       return Datatables::of($resData)
       ->addColumn('action', function ($resData){
           $id = Encryption::encodeId($resData['id']);
           return "<button style=' type='button' class='btn btn-success btn-sm' data-toggle='modal' data-target='#targetModal' onclick='edit_data($id)'>Edit</button><button style=' type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#targetModal' onclick='delete_data($id)'>Delete</button>";

       })
       ->make(true);
    }


     public function create(){
        $organizations = DB::table('organizations')->select('organizations.*')->get();
        $data['organizations'] = $organizations;
        $users = DB::table('users')->select('users.*')->get();
        $data['users'] = $users;
        return view('doctor/master/agent/create')->with($data);
    }

    public function edit($id){
        $id = Encryption::decodeId($id);
        $organizations = DB::table('organizations')->select('organizations.*')->get();
        $data['organizations'] = $organizations;
        $chambers = DB::table('chambers')->select('chambers.*')->get();
        $data['chambers'] = $chambers;
        $users = DB::table('users')->select('users.*')->get();
        $data['users'] = $users;
        $agents = DB::table('agents')->select('agents.*')->where('id', $id)->get();
        $data['result_data'] = $agents[0];
        return view('doctor/master/agent/edit')->with($data);
    }

    /**
     * For search
     */
    public function search($field, $queryString)
    {
        try {

            return $this->agentService->search($field, $queryString);

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

            $validate = $this->agentService->storeValidate($request);

            if ($validate->fails()) {
                return $this->respondInvalidRequest($validate->errors());
            }

            $agent = $this->agentService->store($request);

            // return $this->respondCreated('Agent Created Successfully', $agent);
            Session::flash('success', 'Data Save Successfully');

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
    public function show(Agent $agent)
    {
        try {

            if (!$agent) {
                return $this->respondNotFound('Agent does not exists');
            }

            return $this->respond($this->agentService->show($agent));

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
    public function update(Request $request)
    {
        try {

           /* $validate = $this->agentService->editValidate($request);

            if ($validate->fails()) {
                return $this->respondInvalidRequest($validate->errors());
            }*/

            $agent = $this->agentService->update($request);

            // return $this->respond($agent);
            Session::flash('success', 'Data Update Successfully');

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

    public function delete($id){
        return view('doctor/master/agent/delete')->with('main_id',$id);
    }

    public function destroy($agentId)
    {
        try {

            if (!$agentId = $this->agentService->findChamber($agentId)) {

                Session::flash('success', 'Does Not exists');
            }

            $this->agentService->destroy($agentId);

            // return $this->respondDeleted("Agent Deleted Successfully ");
            Session::flash('success', 'Data Delete Successfully');
            return redirect('agent');


        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
    }

}

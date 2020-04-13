<?php

namespace App\Services;


use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgentService
{

    public $agent;
    public $agentService;

    /**
     * AgentController constructor.
     * @param $agent
     * @param $agentService
     */
    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }

    public function index()
    {
        return $this->agent
            ->orderBy('id', 'DESC');
    }

    public function search( $field,  $query)
    {
        return $this->agent->search($field, $query)->paginate(10);
    }

    public function store(Request $request)
    {
        $agent = new Agent();
        $agent->name = $request->name;
        $agent->phone = $request->phone;
        $agent->organization_id = $request->organization_id;
        $agent->user_id = $request->user_id;
        $agent->chamber_id = $request->chamber_id;
        // $agent->created_by = $request->created_by;
        // $agent->updated_at = $request->updated_at;
        // $agent->created_at = $request->created_at;
        $agent->save();
        return $agent;
    }

    public function show(Agent $agent)
    {
        return $agent;
    }

    public function update(Request $request)
    {
        $agent = Agent::find($request->id);
        $agent->name = $request->name;
        $agent->phone = $request->phone;
        $agent->organization_id = $request->organization_id;
        $agent->user_id = $request->user_id;
        $agent->chamber_id = $request->chamber_id;
        $agent->created_by = $request->created_by;
        $agent->updated_at = $request->updated_at;
        $agent->created_at = $request->created_at;
        $agent->save();
        return $agent;
    }

    public function findChamber($agentId)
    {
        return $this->agent->find($agentId);
    }

    public function destroy(Agent $agent)
    {
        $agent->delete();
    }


    public function storeValidate(Request $request){

        return Validator::make($request->all(), $this->agent->storeRules());

    }

    public function editValidate(Request $request){

        return Validator::make($request->all(), $this->agent->editRules());

    }
}

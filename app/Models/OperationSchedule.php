<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OperationSchedule extends Model
{
	public function storeRules()
	{
		return [
			'title' => 'required',
			'doctor_id' => 'required',
			'date' => 'required',
			'time' => 'required',

		];
	}

	public function editRules()
	{
		return [
			'title' => 'required',
			'doctor_id' => 'required',
			'date' => 'required',
			'time' => 'required',

		];
	}
}

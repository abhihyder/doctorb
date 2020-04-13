<?php

use App\Models\AreaInfo;
use Illuminate\Database\Seeder;

class AreaInfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_array=array();
        $jsonString = json_decode(file_get_contents(base_path('public/json/area.json')));
        foreach ($jsonString->divisions as $divisions) {
			$data_array[]=[
			    'id'=> $divisions->id,
            'name' => $divisions->name,
            'name_bn' =>$divisions->name_bn,
            'area_type' => $divisions->area_type,
            'parent_id' => 0];
            foreach ($divisions->districts as $districts) {
                $data_array[]=['id' => $districts->id,
                'name' => $districts->name,
                'name_bn' =>$districts->name_bn,
                'area_type' =>  $districts->area_type,
                'parent_id' => $divisions->id
				];
                foreach ($districts->thana as $thana) {
                    $data_array[]=['id' => $thana->id,
                    'name' => $thana->name,
                    'name_bn' =>$thana->name_bn,
                    'area_type' => $thana->area_type,
                    'parent_id' => $districts->id
					];
                }
            }
        }
        AreaInfo::insert($data_array);
    }
}

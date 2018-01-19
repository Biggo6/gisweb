<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WaterMonitoringController extends Controller
{
    //
	public function store(){
		
		$monitoring_station = request('monitoring_station');
		$sampling_date      = request('sampling_date');
		
		
		$data = request()->all();
		
		$check = \DB::table('waterqualities')->where('sampling_date', '=', $sampling_date)->where('monitoring_station', $monitoring_station)->count();
		
		if($check != 0){
			//update the exist!
			$id = \DB::table('waterqualities')->where('sampling_date', '=', $sampling_date)->where('monitoring_station', $monitoring_station)->first()->id;
			\DB::table('waterqualities')->where('id', $id)->update($data);
		}else{
			\DB::table('waterqualities')->insert($data);
		}
	
	}
}

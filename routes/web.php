<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\LandUse;
use App\CatchmentCod;



function uplodFileThenReturnPath($fileStringInput, $destinationPath='uploads/')
{
        $file            = request()->file($fileStringInput);
        $archivo         = value(function () use ($file) {
            $filename = str_random(10) . '.' . $file->getClientOriginalExtension();
            return strtolower($filename);
        });
        $filename = $archivo; //str_random(6) . '_' . $file->getClientOriginalName();
        $url      = $destinationPath . $filename;
        try {
            $uploadSuccess = $file->move($destinationPath, $filename);
            if ($uploadSuccess) {
                $path = ($url);
                return $path;
            }
        } catch (Exception $ex) {
            return $ex->getMessage(); 
        }
}

Route::post('getWaterMonitoringData', function(){
	
	$sampling = request('sampling_date');
	$station  = request('station');
	
	$data = \DB::table('waterqualities')->where('sampling_date', '=', $sampling)->where('monitoring_station', $station)->first();
	
	return response()->json($data);
	
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('download/template', function(){
	$pathToFile = public_path("template.xls");

    $name = time().'.xls';

    $headers = ['Content-Type: application/xls'];

    return response()->download($pathToFile, $name, $headers);
});

function checkHeader($header, $sheet){
	
	
	
	$arr = [];
	
	if($header->keys()[0] != "monitoring_station"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[0]);
	}else{
		$arr["monitoring_station"] = $header->{$header->keys()[0]};
	}	
		
	if($header->keys()[1] != "lab_id"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[1]);
	}else{
		$arr["labid"] = $header->{$header->keys()[1]};
	}
	
	
	if($header->keys()[2] != "sampling_date"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[2]);
	}else{
		$arr["sampling_date"] = date('d-m-Y', strtotime($header->{$header->keys()[2]}));
	}
	
	
	if($header->keys()[3] != "temperature_degrees_c"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[3]);
	}else{
		$arr["temperature"] = $header->{$header->keys()[3]};
	}
	
	if($header->keys()[4] != "ph_potential_hydrogen"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[4]);
	}else{
		$arr["pH"] = $header->{$header->keys()[4]};
	}
	
	
	if($header->keys()[5] != "ec_electrical_conductivity_uscm"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[5]);
	}else{
		$arr["ec"] = $header->{$header->keys()[5]};
	}
	
	
	if($header->keys()[6] != "tds_total_dissolve_solids_mgl"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[6]);
	}else{
		$arr["tds"] = $header->{$header->keys()[6]};
	}
	
	
	if($header->keys()[7] != "orp_oxydation_reduction_potential_mv"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[7]);
	}else{
		$arr["orp"] = $header->{$header->keys()[7]};
	}
	
	
	if($header->keys()[8] != "do_dissolved_oxygen_in_mgl"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[8]);
	}else{
		$arr["wdo"] = $header->{$header->keys()[8]};
	}
	
	if($header->keys()[9] != "nh3_n_nitrogen_ammonia_mgl"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[9]);
	}else{
		$arr["nh3_n"] = $header->{$header->keys()[9]};
	}
	
	if($header->keys()[10] != "turbidity_ntu"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[10]);
	}else{
		$arr["turbidity"] = $header->{$header->keys()[10]};
	}
	
	if($header->keys()[11] != "salinity_ppt"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[11]);
	}else{
		$arr["salinity"] = $header->{$header->keys()[11]};
	}
	
	if($header->keys()[12] != "so42_sulphates_mgl"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[12]);
	}else{
		$arr["so42"] = $header->{$header->keys()[12]};
	}
	
	if($header->keys()[13] != "tss_total_suspended_solids"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[13]);
	}else{
		$arr["tss"] = $header->{$header->keys()[13]};
	}
	
	if($header->keys()[14] != "no3_nitrates_mgl"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[14]);
	}else{
		$arr["no3"] = $header->{$header->keys()[14]};
	}
	
	if($header->keys()[15] != "cl_chlorides_mgl"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[15]);
	}else{
		$arr["cl"] = $header->{$header->keys()[15]};
	}
	
	if($header->keys()[16] != "tc_total_colforms_cfu100ml"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[16]);
	}else{
		$arr["tc"] = $header->{$header->keys()[16]};
	}
	
	if($header->keys()[17] != "fc_faecal_coliforms_cfu100ml"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[17]);
	}else{
		$arr["fc"] = $header->{$header->keys()[17]};
	}
	
	if($header->keys()[18] != "cod_chemical_oxygen_demand_mgl"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[18]);
	}else{
		$arr["cod"] = $header->{$header->keys()[18]};
	}
	
	if($header->keys()[19] != "bod_biochemical_oxygen_demand_mgl"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[19]);
	}else{
		$arr["bod"] = $header->{$header->keys()[19]};
	}
	
	if($header->keys()[20] != "colour_mgpt"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[20]);
	}else{
		$arr["color"] = $header->{$header->keys()[20]};
	}
	
	
	if($header->keys()[21] != "total_alkalinity_mgl"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[21]);
	}else{
		$arr["total_alkalinity"] = $header->{$header->keys()[21]};
	}
	
	
	if($header->keys()[22] != "total_hardness_mgl"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[22]);
	}else{
		$arr["total_hardness"] = $header->{$header->keys()[22]};
	}
	
	if($header->keys()[23] != "calcium_mgl"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[23]);
	}else{
		$arr["calcium"] = $header->{$header->keys()[23]};
	}
	
	if($header->keys()[24] != "magnesium_mgl"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[24]);
	}else{
		$arr["magnesium"] = $header->{$header->keys()[24]};
	}
	
	
	if($header->keys()[25] != "iron_mgl"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[25]);
	}else{
		$arr["iron"] = $header->{$header->keys()[25]};
	}
	
	if($header->keys()[26] != "orthophosphate_mgl"){
		throw new Exception("Please file upload does not seem to follow the template structure: " . $header->keys()[26] . " Sheet Name: " . $sheet);
	}else{
		$arr["ortho"] = $header->{$header->keys()[26]};
	}
	
	\DB::table('waterqualities')->insert($arr);
	
}

Route::post('upload/template', function(){
	if(request()->hasFile('templatefile')){
		$file = request()->file('templatefile'); 
		$extension = $file->extension();
		
		if($extension == "xls" || $extension == "xlsx" ){
			
			$path = uplodFileThenReturnPath('templatefile');
			
			if($path){
				$data = Excel::load($path, function($reader) {
					return $reader;
				});
				
				
				
				
				try{
				
					
					$i = 1;
					
					$res = $data->each(function($sheet) use ($i) {
						
						checkHeader($sheet, $i);
						
					});
					
					return response()->json(['error'=>false, 'msg'=> 'Successfully imported! and saved']);
					
					
					
				
				}catch(Exception $x){
					return response()->json(['error'=>true, 'msg'=> $x->getMessage()]);
				}
				
				
			}
			
			
			
			
		}else{
			return response()->json(['error'=>true, 'msg'=>'Please attach excel file']);
		}
		
		
	}else{
		 return response()->json(['error'=>true, 'msg'=>'Please attach file']);
	}
});

Route::get('/watermonitoring', function () {
    return view('watermonitoring');
});

Route::post('water_monitoring', 'WaterMonitoringController@store');

Route::post('getStaticsCatchment', function(){
	return view('statics')->with('catchment', request('catchment'));
});

Route::post('getStaticsRegion', function(){
	return view('statics_region')->with('region', request('region'));
});

Route::post('getStaticsWard', function(){
	return view('statics_ward')->with('wardname', request('wardname'));
});

Route::post('getStaticsDistrict', function(){
	return view('statics_district')->with('distriname', request('distriname'));
});

Route::post('getRegionsCatchment', function(){
	$catchment = request('catchment');
	$data = LandUse::where('catchment', $catchment)->distinct()->get(['regionname']);
	$opts = '<option value="">--Select--</option>';
	foreach($data as $d){
		if($d->regionname != ''){
			$opts .= '<option>'.$d->regionname.'</option>';
		}
	}
	return $opts;
});

Route::post('getCoords', function(){
	if(request()->has('catchment')){
		$catchment = request('catchment');
		$data = CatchmentCod::where('catchment', $catchment)->first();
		return response()->json(['lg'=> $data->long, 'lat'=> $data->lat]);	
	}
	if(request()->has('regions')){
		$regions = request('regions');
		$data = \DB::table('ruvu_and_zigi_regions_centroids')->where('region_nam', $regions)->first();
		return response()->json(['lg'=> $data->long, 'lat'=> $data->lat]);	
	}
	if(request()->has('districts')){
		$regions = request('districts');
		$data = \DB::table('ruvu_and_zigi_regions_centroids')->where('region_nam', $regions)->first();
		return response()->json(['lg'=> $data->long, 'lat'=> $data->lat]);	
	}
	if(request()->has('wards')){
		$wards = request('wards');
		$data = \DB::table('ruvu_and_zigi_wards_centroids')->where('wardname', $wards)->first();
		return response()->json(['lg'=> $data->long, 'lat'=> $data->lat]);	
	}

});

Route::post('getRegionDistricts', function(){
	$regions = request('regions');
	$data = LandUse::where('regionname', $regions)->distinct()->get(['distriname']);
	$opts = '<option value="">--Select--</option>';
	foreach($data as $d){
		if($d->distriname != ''){
			$opts .= '<option>'.$d->distriname.'</option>';
		}
	}
	return $opts;
});

Route::post('getDistrictWards', function(){
	$districts = request('districts');
	$data = LandUse::where('distriname', $districts)->distinct()->get(['wardname']);
	$opts = '<option value="">--Select--</option>';
	foreach($data as $d){
		if($d->wardname != ''){
			$opts .= '<option>'.$d->wardname.'</option>';
		}
	}
	return $opts;
});

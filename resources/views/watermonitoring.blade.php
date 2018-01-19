@extends('layout')


@section('main')
<div class="starter-template " style="padding: 8px" >


		<ul class="nav nav-tabs" id="myTab" role="tablist">
		  <li class="nav-item">
			<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-edit"></i> Water Monitoring Form</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-cog"></i> Query/Analysis</a>
		  </li>
		  
		</ul>
		<div class="tab-content" id="myTabContent">
		  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
				<br/>
				<h5 class="alert alert-warning">Water Monitoring Form</h5>
				
				<hr/>
				
				
					<h3>Upload Water Monitoring Excel or Csv File</h3>
					<hr/>
					<form style="margin: 0px 20px" id="uploadFile">
						<div class="row">
						<div class="col-md-3">
								<div class="form-group">
									<input type="file" id="templatefile" name="templatefile" class="filestyle">
								</div>
						</div>
						<div class="col-md-2">
								<div class="form-group">
									<button class="btn btn-primary" id="uploadNow" type="button"><i class="fa fa-upload"></i> Upload File</button>
								</div>
						</div>
					</form>
					<div class="col-md-2">
							<div class="form-group">
								<a href="{{url('download/template')}}" class="btn btn-success"><i class="fa fa-download"></i> Download Template</a>
							</div>
					</div>
					</div>
				
				
				<br/>
				
				<hr/>
				
				<?php
				
					$stations = DB::table('waterqualitystations')->get();
					
				?>
				
				    

				<form style="margin: 0px 20px" id="water_monitoring_form">
					<h3>Fill Water Monitoring  Form</h3>
					<hr/>
					<div id="fdbk" class="alert alert-success" style="display:none">Successfully added!</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="monitoring_station">Monitoring Station:</label>
								<select class="form-control validate[required] basic-single" id="monitoring_station" 
								
								data-errormessage-value-missing="Monitoring Station is required!" name="monitoring_station" placeholder="">
									<option value="">Select Monitoring Station</option>
									@foreach($stations as $s)
										<option>{{$s->station}}  </option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="labid">Lab ID:</label>
								<input type="text" class="form-control" id="labid" name="labid" 
								data-errormessage-value-missing="Lab ID is required!" placeholder="22">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="sampling_date">Sampling Date <img id="loader" style="display:none" src="{{url('ajax-loader.gif')}}" /></label>
								<input type="text"  class="form-control datepicker validate[required]" id="sampling_date" name="sampling_date" 
								data-errormessage-value-missing="Sampling date is required!" placeholder="Sampling Date">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="temperature">Temperature (degrees C)</label>
								<input type="text" class="form-control" 
								data-errormessage-value-missing="Temperature is required!" id="temperature" name="temperature" placeholder="26.32">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="pH">pH (potential Hydrogen): </label>
								<input type="text" class="form-control"
								data-errormessage-value-missing="pH (potential Hydrogen) is required!" id="pH" name="pH" placeholder="7.64">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="ec">EC (Electrical Conductivity, µS/cm) :</label>
								<input type="text" 
								data-errormessage-value-missing="EC (Electrical Conductivity, µS/cm) is required!" class="form-control" id="ec" name="ec" placeholder="1288.22">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="tds">TDS (Total Dissolve Solids, mg/l):</label>
								<input type="text" 
								data-errormessage-value-missing="TDS (Total Dissolve Solids, mg/l) is required!" class="form-control" id="tds" name="tds" placeholder="826.22">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="orp">ORP ( Oxydation Reduction Potential, mV):</label>
								<input type="text" 
								data-errormessage-value-missing="ORP ( Oxydation Reduction Potential, mV) is required!" class="form-control" id="orp" name="orp" placeholder="52.91">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="wdo">DO (Dissolved Oxygen) in mg/l: </label>
								<input type="text" 
								data-errormessage-value-missing="DO (Dissolved Oxygen) in mg/l is required!" class="form-control" id="wdo" name="wdo" placeholder="2.69">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="nh3_n">NH3-N (nitrogen-ammonia, mg/l)</label>
								<input type="text"
								data-errormessage-value-missing="NH3-N (nitrogen-ammonia, mg/l) is required!" class="form-control" id="nh3_n" name="nh3_n" placeholder="0.94">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="turbidity">Turbidity (NTU): </label>
								<input type="text" class="form-control" 
								data-errormessage-value-missing="Turbidity (NTU) is required!" id="turbidity" name="turbidity" placeholder="59.71">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="salinity">Salinity (ppt):</label>
								<input type="text" class="form-control"
								data-errormessage-value-missing="Salinity (ppt) is required!" id="salinity" name="salinity" placeholder="0.64">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="so42">SO42 (Sulphates, mg/l) </label>
								<input type="text" class="form-control" 
								data-errormessage-value-missing="SO42 (Sulphates, mg/l) is required!" id="so42" name="so42" placeholder="35.11">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="tss">TSS (Total Suspended Solids)</label>
								<input type="text"
								data-errormessage-value-missing="TSS (Total Suspended Solids) is required!" class="form-control" id="tss" name="tss" placeholder="10.11">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="no3">NO3 (Nitrates, mg/l): </label>
								<input type="text"
								data-errormessage-value-missing="NO3 (Nitrates, mg/l) is required!" class="form-control" id="no3" name="no3" placeholder="0.81">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="cl">Cl- (Chlorides, mg/l)</label>
								<input type="text"
								data-errormessage-value-missing="Cl- (Chlorides, mg/l) is required!" class="form-control" id="cl" name="cl" placeholder="140.38">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="tc">TC (Total colforms) CFU/100ml</label>
								<input type="text" 
								data-errormessage-value-missing="TC (Total colforms) CFU/100ml is required!" class="form-control" id="tc" name="tc" placeholder="14400.11">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="fc">FC (Faecal Coliforms) CFU/100ml</label>
								<input type="text" 
								data-errormessage-value-missing="FC (Faecal Coliforms) CFU/100ml is required!" class="form-control" id="fc" name="fc" placeholder="6880.44">
							</div>
						</div>
						
					</div>
					<div class="row">
						
						<div class="col-md-2">
							<div class="form-group">
								<label for="cod">COD (Chemical Oxygen Demand, mg/l) )</label>
								<input type="text" 
								data-errormessage-value-missing="COD (Chemical Oxygen Demand, mg/l) ) is required!" class="form-control" id="cod" name="cod" placeholder="126.43">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="bod">BOD (Biochemical Oxygen Demand,  mg/l)</label>
								<input type="text" 
								data-errormessage-value-missing="BOD (Biochemical Oxygen Demand,  mg/l) is required!" class="form-control" id="bod" name="bod" placeholder="56.33">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="color">Colour (mg/Pt): </label>
								<input type="text" class="form-control" 
								data-errormessage-value-missing="Colour (mg/Pt) is required!" id="color" name="color" placeholder="23.22">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="total_alkalinity">Total Alkalinity (m/gl):</label>
								<input type="text" class="form-control" 
								data-errormessage-value-missing="Total Alkalinity (m/gl) is required!" id="total_alkalinity" name="total_alkalinity" placeholder="92.22">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="total_hardness">Total Hardness (m/gl)</label>
								<input type="text" class="form-control" 
								data-errormessage-value-missing="Total Hardness (m/gl) is required!" id="total_hardness" name="total_hardness" placeholder="12.11">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="calcium">Calcium (m/gl) </label>
								<input type="text" class="form-control"
								data-errormessage-value-missing="Calcium (m/gl) is required!" id="calcium" name="calcium" placeholder="22.02 ">
							</div>
						</div>
					</div>
					<div class="row">
						
						<div class="col-md-2">
							<div class="form-group">
								<label for="magnesium">Magnesium (mg/l)</label>
								<input type="text" class="form-control" 
								data-errormessage-value-missing="Magnesium (mg/l) is required!" id="magnesium" name="magnesium" placeholder="21.11">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="iron">Iron (mg/l):</label>
								<input type="text" class="form-control" 
								data-errormessage-value-missing="Iron (mg/l) is required!" id="iron" name="iron" placeholder="11.90">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="ortho">Orthophosphate (mg/l) </label>
								<input type="text" class="form-control" 
								data-errormessage-value-missing="Orthophosphate (mg/l) is required!" id="ortho" name="ortho" placeholder="11.22">
							</div>
						</div>
						
					</div>
					

					<hr />
					<p>
						<button type="button" id="saveinfo" class="btn btn-success"><i class="fa fa-save"></i> Save Information</button>
						<button type="reset" class="btn btn-danger"><i class="fa fa-ban"></i> Cancel </button>
					</p>
				</form>
		  </div>
		  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
		  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
		</div>

		
		
	</div>
@stop

@section('script')
<script>
$(function(){
	$('body').on('change', '#sampling_date', function(){
		var sampling_date = $(this).val();
		var station = $('#monitoring_station').val();
		if(station){
			$('#loader').show();
			$.post('{{url('getWaterMonitoringData')}}', {sampling_date: sampling_date, station: station}, function(res){
				$('#loader').hide();
				console.log(res);
				var water_monitoring_form = $('#water_monitoring_form').serializeArray();
				if(res.sampling_date != null){
					$.each(water_monitoring_form, function(i, k){
						$('#' + k.name).val(res[k.name]);
					});
				}
			});
		}
	});
});
</script>
@stop
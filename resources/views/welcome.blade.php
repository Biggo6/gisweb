@extends('layout')

@section('main')


	<div class="starter-template " style="padding: 8px" >
		<h5>Land Use And Cover </h5>

		<form class="form-inline" id="lulc_form">
		  <div class="form-group">
			<label for="year" style="padding-right: 12px"><b>Year</b></label>
			<select style="width: 120px" class="form-control mx-sm-3 basic-single" id="year" name="year" style="padding-right: 12px">
				<option value="">--Select--</option>
				<option value="2010">2017</option> 
			</select>
		  </div>
		  <div class="form-group">
			<label for="catchment" style="padding-right: 12px; padding-left: 12px"><b>Catchment</b></label>
			<select id="catchment" name="catchment" style="width: 120px" class="form-control mx-sm-3 basic-single" style="padding-right: 12px">
				<option value="">--Select--</option>
				<option>Ruvu</option>
				<option>Zigi</option>
			</select>
		  </div>
		  <div class="form-group">
			<label for="regions" style="padding-right: 12px; padding-left: 12px"><b>Regions</b></label>
			<select id="regions" name="regions" style="width: 120px" class="form-control mx-sm-3 basic-single" style="padding-right: 12px">
				<option value="">--Select--</option>
			</select>
		  </div>
		  <div class="form-group">
			<label for="districts" style="padding-right: 12px; padding-left: 12px"><b>Districts</b></label>
			<select id="districts" name="districts" style="width: 150px" class="form-control mx-sm-3 basic-single" style="padding-right: 12px">
				<option value="">--Select--</option>
			</select>
		  </div>
		  <div class="form-group">
			<label for="wards" style="padding-right: 12px; padding-left: 12px"><b>Wards</b></label>
			<select id="wards" name="wards" style="width: 170px" class="form-control mx-sm-3 basic-single" style="padding-right: 12px">
				<option value="">--Select--</option>
			</select>
		  </div>
		  <div class="col-auto">
			  <button type="button" id="query" class="btn btn-warning"><i class="fa fa-search" aria-hidden="true"></i> Fetch </button>
		  </div>
		</form>
		
		<div class="row">
			<div class="col-md-5">
				<div id="map" style="width: 100%; height: 900px">
				</div>
			</div>
			<div class="col-md-1" style="background-color: #fff">
				 <h6>Legend</h6>
				 <hr/>
				 <img style="border: 1px solid #ccc" src="http://34.203.242.9/geoserver/giswebproject/wms?Service=WMS&REQUEST=GetLegendGraphic&VERSION=1.0.0&FORMAT=image/png&WIDTH=12&HEIGHT=12&LAYER=giswebproject:land_use_and_cover_2010">
			</div>
			<div id="result" class="col-md-6" style="background-color: #fff">
				<center>
					<h2>SLM INFORM</h2><br/>
					<h5>The Spatial Approach to Sustainable Land Management (SLM) in Tanzanian Catchments<h5>
				</center>
				
				<hr/>
				<p>SLM INFORM is a web-based geospatial service that enables visual and statistical analyses of phenomena related to catchment services usage and health. It contains geospatial data and operations to support knowledge-based decision-making for sustainable land management. The functions are classed in five main areas  of : 1) Land use and cover  dynamics 2)  Monitoring Land Degradation  The system serves a broad scope of institutional,  individual, and community stakeholders 3) Monitoring water quality and quantity 4) Tracking payment and compliance for water use services,  and 5) Socio-economic operators. Currently the service serves the extents of Zigi and and Ruvu catchments in Pangani and Wami-Ruvu water basins in Tanzania,  where a broader SLM project is being implemented. It is expected to grow and cover whole national water basins. 
				In the institutional context, SLM INFORM facilitates the spatial information needs of  The Ministry of Water and Irrigation and others involved in natural resources, basin water boards and water offices,  catchment water committees,  water user associations, the National land Use planning Commission,  The Vice-President’s Office Division of Environment,  the local government councils, academic and research institutions,  NGOs,  and development partners. 
				SLM INFORM supports the evaluation of successful implementation of the broader SLM project funded by development partners and institutions of the Government of Tanzania. It is a model of the broader country programmes the decisions of which base on scientific evidence for sustainability and realisation of human well-being.  
				</p> 
			</div>
		</div>
	</div>


@stop

@section('script')
	<script src="{{url('custom/map.js')}}"></script>
@stop
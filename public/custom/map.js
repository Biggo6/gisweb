$(function(){
	//Catchment
	$('body').on('change', '#catchment', function(){
		var catchment = $(this).val();
		$('#regions').prop('disabled', true);
		$('#districts').html('<option value="">--Select--</option>');
		$('#wards').html('<option value="">--Select--</option>');
		$.post('getRegionsCatchment', {catchment:catchment}, function(res){
			$('#regions').prop('disabled', false);
			$('#regions').html(res);
		});
	});
	//Regions
	$('body').on('change', '#regions', function(){
		var regions = $(this).val();
		$('#districts').prop('disabled', true);
		$.post('getRegionDistricts', {regions:regions}, function(res){
			$('#districts').prop('disabled', false);
			$('#districts').html(res);
		});
	});
	//District
	$('body').on('change', '#districts', function(){
		var districts = $(this).val();
		$('#wards').prop('disabled', true);
		$.post('getDistrictWards', {districts:districts}, function(res){
			$('#wards').prop('disabled', false);
			$('#wards').html(res);
		});
	});
	
});

// Layers

var control = new ol.control.FullScreen();

var osm = new ol.layer.Tile(
{	title: "OSM",
	source: new ol.source.OSM()
});

var keyBing = 'AqrysljmdevJj6sZoqWybmdjhrSlhIABScUOekHnOFX8_3GHEqJRFFU1dN_iqLYj';

var sourceBingMaps = new ol.source.BingMaps({
	key: keyBing,
	imagerySet: 'Road',
	culture: 'fr-FR'
});

var bingMapsRoad = new ol.layer.Tile({
	title: 'Road',
	preload: Infinity,
	source: sourceBingMaps
});

var bingMapsAerial = new ol.layer.Tile({
	title: 'Aerial',
	preload: Infinity,
	source: new ol.source.BingMaps({
	  key: keyBing,
	  imagerySet: 'Aerial',
	})
});

var bingMapsAerialWithLabels = new ol.layer.Tile({
	preload: Infinity,
	title: 'Aerial With Labels',
	source: new ol.source.BingMaps({
	  key: keyBing,
	  imagerySet: 'AerialWithLabels',
	})
});

var bingMapsordnanceSurvey = new ol.layer.Tile({
	preload: Infinity,
	title: 'Ordnance Survey',
	source: new ol.source.BingMaps({
	  key: keyBing,
	  imagerySet: 'ordnanceSurvey',
	})
});


// create Maps

var cords = [38.276638, -6.816330];

var map = new ol.Map({
	layers: [osm, bingMapsRoad, bingMapsAerial, bingMapsordnanceSurvey, bingMapsAerialWithLabels],
	target: 'map',
	controls: ol.control.defaults().extend([  // Add a new Layerswitcher to the map
	  new ol.control.LayerSwitcher(), control
	]),
    view: new ol.View({
		center: ol.proj.fromLonLat(cords),
		zoom: 8
	})	
});

// Add Layers

var url = 'http://34.203.242.9/geoserver/giswebproject/wms';
var params = {
	'LAYERS': 'giswebproject:land_use_and_cover_2010'
};

var landusecover = new ol.layer.Image({
	title: 'LULC',
	source: new ol.source.ImageWMS({
		url: url,
		params: params,
		serverType: 'geoserver'
	})
});

landusecover.setOpacity(0.9);

map.addLayer(landusecover);

function CenterMap(lng, lat, catc){ 
	var coords = [parseFloat(lng), parseFloat(lat)];
    map.getView().setCenter(ol.proj.fromLonLat(coords));
    if(catc == "Zigi"){
		map.getView().setZoom(10);
	}
	
	if(catc == "Ruvu"){
		map.getView().setZoom(9);
	}
}

function updateLandusercoverCatchment(catchment, year){
	var cqlfilter = "catchment='"+ catchment +"'";
	
	// Year - 2010
	if(year == "2010"){
	
		new_params = {
			'LAYERS': 'giswebproject:land_use_and_cover_2010',
			'CQL_FILTER': cqlfilter
		};
		
		$.post('getCoords', {catchment:catchment}, function(res){
			CenterMap(res.lg, res.lat, catchment);
			landusecover.getSource().updateParams(new_params);
		});	
		
		$('#result').html('Please wait...');
		
		$.post('getStaticsCatchment', {catchment:catchment}, function(res){
			$('#result').html(res);
		});	
	
	}
	
	
	
	/* $('#map').css('height', '100%');
	$('#map').css('width', '50%');
	$('#result').css({
		backgroundColor: 'red',
		height: '100%'
	}).html('gsfgjhasfgjhasfjas').css('float','left');; */
	
}

function updateLandusercoverRegion(regions, year){
	var cqlfilter = "regionname='"+ regions +"'";
	
	// Year - 2010
	if(year == "2010"){
	
		new_params = {
			'LAYERS': 'giswebproject:land_use_and_cover_2010',
			'CQL_FILTER': cqlfilter
		};
		
		$.post('getCoords', {regions:regions}, function(res){
			CenterMap(res.lg, res.lat, regions);
			landusecover.getSource().updateParams(new_params);
			map.getView().setZoom(8);
		});	
		
		$('#result').html('Please wait...');
		
		$.post('getStaticsRegion', {region:regions}, function(res){
			$('#result').html(res);
		});	
	
	}
}

function updateLandusercoverDistrict(districts, year){
	var cqlfilter = "distriname='"+ districts +"'";
	
	// Year - 2010
	if(year == "2010"){
	
		new_params = {
			'LAYERS': 'giswebproject:land_use_and_cover_2010',
			'CQL_FILTER': cqlfilter
		};
		
		$.post('getCoords', {districts:districts}, function(res){
			CenterMap(res.lg, res.lat, districts);
			landusecover.getSource().updateParams(new_params);
			map.getView().setZoom(8);
		});	
		
		$('#result').html('Please wait...');
		
		$.post('getStaticsDistrict', {distriname:districts}, function(res){
			$('#result').html(res);
		});	
	
	}
}

function updateLandusercoverWard(wards, year){
	var cqlfilter = "wardname='"+ wards +"'";
	
	// Year - 2010
	if(year == "2010"){
	
		new_params = {
			'LAYERS': 'giswebproject:land_use_and_cover_2010',
			'CQL_FILTER': cqlfilter
		};
		
		$.post('getCoords', {wards:wards}, function(res){
			CenterMap(res.lg, res.lat, wards);
			landusecover.getSource().updateParams(new_params);
			map.getView().setZoom(8);
		});	
		
		$('#result').html('Please wait...');
		
		$.post('getStaticsWard', {wardname:wards}, function(res){
			$('#result').html(res);
		});	
	
	}
}

$(function(){
	// Perform Query function
	$('body').on('click', '#query', function(){
		var data = $('#lulc_form').serializeArray();
		// For test purposes
		console.log(data);
		
		var year = data[0].value;
		// Regions data[2]
		var regions = data[2].value;
		// Districts data[3]
		var districts = data[3].value;
		// Wards data[4]
		var wards = data[4].value;
		
		
		if(year == ""){
			swal("Oops!", "Please provide the year first!", "error");
			return;
		}
		var catchment = data[1].value;
		if(catchment == ""){
			swal("Oops!", "Please provide the catchment also first!", "error");
			return;
		}
		
		if(catchment != "" && regions == "" && districts == "" && wards == ""){
			updateLandusercoverCatchment(catchment, year);
		}
		
		if(regions != "" && districts == "" && wards == ""){
			updateLandusercoverRegion(regions, year);
		}
		
		
		if(districts != "" && wards == ""){
			updateLandusercoverDistrict(districts, year);
		}
		
		
		if(wards != ""){
			updateLandusercoverWard(wards, year);
		}
		
	});
});
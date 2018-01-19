
<?php 

	$data = \App\LandUse::where('wardname', $wardname)
				->select('lulcdescri', DB::raw('sum(areakm2) as total_areakm2'),  DB::raw('sum(areaha) as total_areaha'))
                ->groupBy('lulcdescri')
                ->get(); 
	$i    = 1;
?>

<table class="" id="myTable">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th>LULC Names</th>
      <th>Area Km2</th>
	  <th>Area Ha</th>
      <th>Ward Area</th>
    </tr>
  </thead>
  <tbody>
	<?php $names = []; $areakms = []; $areahas = []; ?>
	@foreach($data as $d)
    <tr>
      <th scope="row">{{$i}}</th>
      <td>{{$d->lulcdescri}}</td>
      <td>{{$d->total_areakm2}}</td>
      <td>{{$d->total_areaha}}</td>
      <td>{{$wardname}}</td>
    </tr>
	<?php $i++; $names[] = $d->lulcdescri; $areakms[] = $d->total_areakm2; $areahas[] = $d->total_areaha; ?>
	@endforeach
    
  </tbody>
</table>


<?php 

$chart = Charts::create('bar', 'material')
             ->title('Land Use Cover')
             ->elementLabel('Area Km2')
             ->labels($names)
             ->values($areakms)
             ->responsive(true);

$chart_pie =  Charts::create('pie', 'highcharts')
			->title('Land Use Cover - Pie')
			->labels($names)
			->values($areakms)
			->dimensions(1000,500)
			->responsive(false);

?>

{!! $chart->html() !!}
<center>
{!! $chart_pie->html() !!}
</center>


{!! $chart->script() !!}
{!! $chart_pie->script() !!}

<script>
$(document).ready(function(){
   $('#myTable').DataTable({
		"pageLength": 3
	});
});
</script>
<nav class="navbar navbar-expand-md navbar-dark bg-dark ">
  <a class="navbar-brand" href="#"><img src="{{url('coat.png')}}" style="width: 64px; height: 64px" />  SLM INFORM</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
	<ul class="navbar-nav mr-auto">
	  <li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle active" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-database" aria-hidden="true"></i> Query</a>
		<div class="dropdown-menu" aria-labelledby="dropdown01">
		  <a class="dropdown-item" href="{{url('/')}}"><i class="fa fa-list"></i> Land Use And Cover</a>
		  <a class="dropdown-item" href="{{url('/watermonitoring')}}"><i class="fa fa-list"></i> Water Monitoring</a>  
		</div>
	  </li>
	  <li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle active" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-edit" aria-hidden="true"></i> Manage</a>
		<div class="dropdown-menu" aria-labelledby="dropdown01">
		  <a class="dropdown-item" href="{{url('/watermonitoring')}}"><i class="fa fa-pencil"></i> Water Monitoring Form</a>  
		</div>
	  </li>
	</ul>
	
  </div>
</nav>
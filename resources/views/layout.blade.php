@include('incs.header')

    <body style="background-color: #ccc">
	
		<main role="main" >
		
		<div style="background-color: #fff;">	
			
			@include('incs.nav')
			
			@yield('main')
		
		</div>


		</main><!-- /.container -->
		
    </body>

@include('incs.footer')

@yield('script')

</html>

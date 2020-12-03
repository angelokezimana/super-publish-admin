<!doctype html>
<html class="no-js" lang="en">

@include('inc.head')

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Start Left menu area -->
    @include('inc.sidebar')
    <!-- End Left menu area -->
    
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">

        @include('inc.nav')

            <div class="container-fluid mt-custom">
                <div class="row">
                    @yield('content')
                </div>              
            </div>
        </div>
      

        @include('inc.footer')
        
    @include('inc.script')
   
</body>

</html>
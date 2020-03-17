<!doctype html>
<html lang="en">
  
  <head>
  
        @include('backoffice.includes.head')

        @include('backoffice.includes.scripts')
  </head>
  
    <body class="goto-here">
        <!-- SPINNER 1
        <div class="cs-loader" id="spinner">
            <div class="cs-loader-inner">
                <label>●</label>
                <label>●</label>
                <label>●</label>
                <label>●</label>
                <label>●</label>
                <label>●</label>
            </div>
        </div>
        -->
        <!-- SPINNER 2 -->
        
        <div id="spinner" class="container--box">
            <div class="box">
                <div class="inner-image">
                    <img src="{{ asset('/images/util/spinner.png') }}" class="spinner_img" />
                </div>
                <div class="spinner spinner--6" >
                    
                </div>
                
            </div>
        </div>
        
        <div class="wrapper">
        
            @include('backoffice.includes.navbar')
                    
            @include('backoffice.includes.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">   

            @yield('content')

            </div>
            
            @include('backoffice.includes.footer')

        </div>    

        

    </body>

</html>
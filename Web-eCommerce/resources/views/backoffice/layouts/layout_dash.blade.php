<!DOCTYPE html>
<html lang="en">
  
  <head>
  
      @include('backoffice.includes.head')
  
  </head>
  
    <body class="goto-here">
        
        <div class="wrapper">
        
            @include('backoffice.includes.navbar')
                    
            @include('backoffice.includes.sidebar')

            @yield('content')

            @include('backoffice.includes.footer')

            @include('backoffice.includes.scripts')

        </div>    

    </body>

</html>
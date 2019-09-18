<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Bil Wifi" content="{{ config('app.name') }} by KinDev">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ !empty ($title) ? $title .' | '. config('app.name') : config('app.name') }}  </title>
    <!-- Fonts -->
    {{-- <link href = "https://fonts.googleapis.com/css?family= Roboto " rel = "stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- Styles --}}
    {{-- <link href="{{ asset('bootstrap/css/style.css') }}" rel="stylesheet"> --}}
    <style type="text/css">
        body{
            margin: 5%;
            background-image: url({{ asset('img/cover.jpg')}});
            background-repeat : no-repeat;
            background-position: center;
        }
        .bg-purple { background-color: #6f42c1; }
    </style>
    @yield('stylesheet')
    @stack('stylesheets')

</head>

<body class="text-monospace">
    <div class="container bg-transparent  text-white" >
      <h6 class="text-center">Hôpital Biamba Marie Mutombo</h6>
      <div class="text-center">
        <small class="text-center">HBMM</small>
      </div>
      {{-- <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm text-center bg-transparent">
        <div class="text-monospace">
          <h6 class="mb-0 text-white lh-100">Hôpital Biamba Marie Mutombo</h6>
          <small>HBMM</small>
        </div>
      </div> --}}
        @yield('content')
         @auth
        <small class="d-block text-right mt-3">
          <a href="{{ route('home') }}">Accueil</a>
          <a href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
              Déconnexion
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </small>
        @else
          <small class="d-block text-right mt-3">
          
          <a href="{{ route('login') }}">Connexion</a>
        </small>
        @endauth
    </div>
     
    {{-- Container   --}}
    
    {{-- Session Flash --}}
    @yield('msg_flash')
    <footer class="footer">
        @yield('footer')
        <script src="{{ asset('backend/assets/libs/jquery/dist/jquery.min.js') }}"></script>
        <!-- <script src="dist/js/jquery.ui.touch-punch-improved.js"></script>
        <script src="dist/js/jquery-ui.min.js"></script> -->
        <!-- Bootstrap tether Core JavaScript -->
        <script src="{{ asset('backend/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
         {{-- <script type="text/javascript" src="{{ asset('dataTables/datatables.min.js') }}"></script> --}}
        <script type="text/javascript">
          function getPage(link){
            $.ajax({
                type: 'get',
                url: link,
                success: function(data) {
                    $('#html_content').html(data);
                    
                },
                error:function(data) {
                    var errors = data.responseJSON.errors;
                      $.each(errors, function (key, value) {
                        document.getElementById('msgErrors').innerHTML += "<li>"+value+"</li>"
                        $('#msgErrors').removeAttr('hidden');
                    });
                }
            });
          }
        </script>
        @yield('script')
        
        @stack('scripts')
        @include('flashy::message')

    </footer>
</body>
</html>

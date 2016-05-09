<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Laravel
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">

                    <!-- Menu for admin -->
                    @if(!auth()->guest())
                    @if(user()->hasRoles('administrator'))
                    <li><a href="{{ url('admin/status') }}">Status</a></li>
                    <li><a href="{{ url('admin/types') }}">Types</a></li>
                    <li><a href="{{ url('admin/roles') }}">Roles</a></li>
                    @endif

                    <li>
                        @if(user()->hasRoles('moderator'))
                        <a href="{{ url('moderator') }}">Tasks</a>
                        @endif

                        @if(user()->hasRoles('client'))
                        <a href="{{ url('client') }}">My Tasks</a>
                        @endif

                        @if(user()->hasRoles('user'))
                        <a href="{{ url('user') }}">My Tasks</a>
                        @endif
                    </li>
                    @endif

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    @if (!Auth::guest())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->email }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    

    <div class="container">

        @if(! auth()->guest() && auth()->user()->confirmed == 0 && request()->segment(1) != 'account')
            @include('partials.notifications.success')
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Please confirm your email address for use complete this application. 
                {!! link_to('account/resend', 'Resend Activation') !!}
            </div>
        @endif

        @yield('content')
    </div>
    
    @include('partials.modals.login')
    @include('partials.modals.forgot')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(function() {

        $(".form").submit(function (e) {
            e.preventDefault();

            var formId = $(this).attr('id');
            var modalId = $(this).closest('.modal').attr('id');
            var urlAction = $(this).attr('action');
            
            $('input+span.help-block').text('');
            $('input').parent().removeClass('has-error');

            $.ajax({
                method: $(this).attr('method'),
                url: urlAction,
                data: $(this).serialize(),
                dataType: "json"
            })
            .done(function(data) {
                $('.alert-success').removeClass('hidden');
                $(modalId).modal('hide');
                window.location.replace(data.redirect);
            })
            .fail(function(data) {
                $.each(data.responseJSON, function(key, value) {
                    var input = '#'+formId + ' input[name=' + key + ']';
                    $(input + '+span').text(value);
                    $(input).parent().addClass('has-error');
                });
            });
        });

        $(document).ready(function() {

            if (window.location.href.indexOf('#login') != -1) {
                $('#login').modal('show');
            }

            if (window.location.href.indexOf('#reset') != -1) {
                $('#reset').modal('show');
            }

        });

        $('#client_tab a').click(function(e) {
            e.preventDefault()
            $(this).tab('show')
        });

        $('#user_tab a').click(function(e) {
            e.preventDefault()
            $(this).tab('show')
        });

        $('#moderator_tab a').click(function(e) {
            e.preventDefault()
            $(this).tab('show')
        });
    })

    </script>
    @stack('scripts')
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>

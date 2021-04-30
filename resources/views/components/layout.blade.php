
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">

    <title>
        @hasSection('title')
            @yield('title')
        @else
            Page Site
        @endif
    </title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/cover/">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/cover.css')}}" rel="stylesheet">
</head>

<body class="text-center">

<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    @component('components.navbar')
    @endcomponent

    <main role="main" class="inner cover">
        @hasSection('body')
            @yield('body')
        @endif
    </main>

    <footer class="mastfoot mt-auto">
        <div class="inner">
            <p>Cover template for <a href="https://getbootstrap.com/">Bootstrap</a>, by <a
                    href="https://twitter.com/mdo">@mdo</a>.</p>
        </div>
        <script src="{{asset('js/app.js')}}"></script>
        @hasSection('javascript')
            @yield('javascript')
        @endif



    </footer>
</div>
</body>
</html>



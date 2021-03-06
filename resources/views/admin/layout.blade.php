<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @yield('meta')
        <title>{{ config('cms.logo') }}后台管理</title>


        <link href="{{ URL::asset('assets/css/admin.css') }}" rel="stylesheet">


        @yield('styles')

        <!--[if lt IE 9]>
            <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        {{-- Navigation Bar --}}
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">{{ config('cms.logo') }}后台管理</a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-menu">
                    @include('admin.partials.navbar')
                </div>
           </div>
        </nav>

        @yield('content')


        <script src="{{ URL::asset('assets/js/admin.js') }}"></script>

        @yield('scripts')

    </body>
</html>
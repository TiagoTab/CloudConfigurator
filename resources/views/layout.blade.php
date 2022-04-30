<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layout.head')
</head>
<body class="antialiased">
<div class="container">
    @include('layout.header')
        <div id="main" class="relative flex items-top justify-center min-h-screen sm:items-center py-4 sm:pt-0">
            <div class="main-container mx-auto sm:px-6 lg:px-8">
                <div class="mt-8 bg-white overflow-hidden shadow sm:rounded-lg">
                    @yield('content')
                </div>

                @include('layout.footer')
            </div>
        </div>
</div>
</body>
</html>
@yield('js')

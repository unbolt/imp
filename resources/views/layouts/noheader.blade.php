<!DOCTYPE html>
<html lang="en">
    <head>

        <title>@yield('title') - IMP</title>

        @include('partials.scripts')
    </head>
    <body class="@yield('body_class', 'default')">
        @yield('content')
    </body>
</html>

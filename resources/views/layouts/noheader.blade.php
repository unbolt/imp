<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title') - Implausible Conclave - Free Company - Moogle</title>

        @include('partials.scripts')
    </head>
    <body class="@yield('body_class', 'default')">
        @yield('content')
    </body>
</html>

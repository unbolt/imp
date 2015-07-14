<!DOCTYPE html>
<html lang="en">
    <head>

        <title>@yield('title') - IMP</title>

        @include('partials.scripts')
    </head>
    <body class="@yield('body_class', 'default')">
        <div class="container">
            <header>
                <div class="col-md-2">
                    <div class="logo_full"></div>
                </div>
                <div class="col-md-10 text-right">
                    <nav>
                        <ul>
                            <li>Home</li>
                            <li>About</li>
                            <li>Roster</li>
                            <li>Forums</li>
                            <li>Gallery</li>
                            <li>Login</li>
                        </ul>
                    </nav>
                </div>
            </header>
        </div>
        @yield('content')
    </body>
</html>

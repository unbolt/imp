<!DOCTYPE html>
<html lang="en">
    <head>

        <title>@yield('title') - Implausible Conclave - Free Company - Moogle</title>

        @include('partials.scripts')
    </head>
    <body class="@yield('body_class', 'default')">
    <header>
        <div class="container">
            <section class="navigation-container">
                <div class="row">
                    <div class="col-md-6">
                        <nav>
                            <ul>
                                <li>Home</li>
                                <li>About</li>
                                <li>Roster</li>
                                <li><a href="/forums">Forums</a></li>
                                <li>Gallery</li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-6 text-right">
                        <nav class="right">
                            @if($user = Auth::user())
                                <div class="user-image-avatar" style="background-image: url('{{ $user->character_avatar or '/img/profile_avatar_default.png' }}');"></div>
                                <ul>
                                    <li>
                                        <a href="#" id="user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $user->character_name or $user->name }} <span class="caret"></span></a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <li><a href="/dashboard">Dashboard</a></li>
                                                <li role="separator" class="divider"></li>
                                                <li><a href="/logout">Logout</a></li>
                                            </ul>
                                    </li>
                                </ul>
                            @else
                                <ul>
                                    <li>Login</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="container">
                <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="logo_full"></div>
                        </div>
                        <div class="col-md-8">

                        </div>
                    </div>
                </div>
            </div>

        </div>
        </header>
        @yield('content')
    </body>
</html>

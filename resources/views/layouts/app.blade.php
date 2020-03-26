<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,600|Playfair+Display&display=swap" rel="stylesheet">
    <link href="/css/styles.css" rel="stylesheet" type="text/css" />
    <script src="/js/jquery.min.js" type="text/javascript"></script>
</head>
<body>
    <div class="viewport">
		<header class="header">
			<a href="{{ url('/') }}" class="header__logo">
				<img src="/images/logo.jpg" alt="Logo" class="header-logo__image" />
			</a>
			<div class="header__trigger" onclick="$('body').addClass('menu-open')"></div>
		</header>

        <main class="main">
            @yield('content')
        </main>

		<div class="menu-overlay">
			<div class="menu-overlay__close" onclick="$('body').removeClass('menu-open')"></div>
			<div class="menu-overlay__content">
				<nav class="nav">
					<ul class="nav-list">
						<li class="nav-item">
							<a class="nav-link" href="{{ url('/') }}">Tables</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ url('/fixtures') }}">Fixtures</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ url('/rules') }}">Rules</a>
						</li>
					</ul>
				</nav>
				<nav class="nav">
					<ul class="nav-list">
						@guest
							<li class="nav-item">
								<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
							</li>
						@else
							<li class="nav-item">
								<a class="nav-link" href="{{ url('/results') }}">Results</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{ url('/divisions') }}">Divisions</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{ url('/players') }}">Players</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{ url('/users') }}">Users</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{ route('logout') }}"
								   onclick="event.preventDefault();
												 document.getElementById('logout-form').submit();">
									Logout
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</li>
						@endguest
					</ul>
				</nav>
			</div>
		</div>
	</div>
</body>
</html>

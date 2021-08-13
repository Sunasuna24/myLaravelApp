<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
    <header>
        <nav class="p-6 flex justify-between">
            <ul class="flex items-center">
                <li><a href="{{ auth()->user() ? route('home') : '/' }}" class="p-3">{{ config('app.name', 'Laravel') }}</a></li>
                @auth
                <li><a href="{{ route('posts') }}" class="p-3">投稿</a></li>
                @endauth
            </ul>
            <ul class="flex items-center">
                @auth
                <li><a href="{{ route('user.edit', auth()->user()->id) }}" class="p-3">{{ Auth::user()->name }}</a></li>
                <li><a href="{{ route('logout') }}" class="p-3">ログアウト</a></li>
                @endauth
                @guest
                <li><a href="{{ route('register') }}" class="p-3">登録</a></li>
                <li><a href="{{ route('login') }}" class="p-3">ログイン</a></li>
                @endguest
            </ul>
        </nav>
    </header>
    <main class="bg-gray-100">
        <div class="max-w-5xl m-auto">
            @yield('content')
        </div>
    </main>
    <footer class="bg-gray-700 py-3 text-center">
        <span class="text-white text-sm">@myLaravelApp</span>
    </footer>
</body>
</html>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sound Spotter | @yield('title')</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div id="app">
        <div class="flex m-6 bg-gray-800 rounded-lg">
            <div class="w-1/4">
                <a href="/dashboard">
                    <div class="m-2 flex-wrap items-center justify-center bg-gray-700 p-4 rounded">
                        @auth
                            <div>
                                <div>
                                    <img class="rounded-full h-16" src='{{ auth()->user()->avatar }}' alt="">
                                </div>
                                <div class="text-xs mt-2">
                                    {{ auth()->user()->name }}
                                </div>
                            </div>
                        @else
                            <div class="text-6xl">
                                <i class="fa fa-music" aria-hidden="true"></i>
                            </div>
                        @endauth
                        <div class="mt-2 font-bold text-white">Sound Spotter</div>
                    </div>
                </a>
                <navigation/>
            </div>

            <div class="w-3/4 bg-gray-900 m-2 rounded p-2">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>
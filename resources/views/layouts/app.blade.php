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
                @auth
                    <a href="/dashboard">
                @else
                    <a href="/">
                @endauth
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
                <!--Navigation-->
                <div class="mt-8 text-sm ml-2">
                    <div class="mt-8">
                        <a href="/artists" class="p-2 block text-white border-b hover:bg-gray-900 cursor-pointer {{ request()->is('artists') ? 'bg-red-500' : '' }}">
                            <i class="fa fa-music mr-3"></i>
                            Artists
                        </a>
                    </div>
                    <div>
                        <a href="/albums" class="p-2 block text-white border-b hover:bg-gray-900 cursor-pointer {{ request()->is('albums') ? 'bg-red-500' : '' }}">
                            <i class="fa-solid fa-compact-disc mr-3"></i>
                            Albums
                        </a>
                    </div>
                    <div class="mt-8 mb-8">
                        <div>
                            <a href="/my-artists" class="p-2 block text-white border-b hover:bg-gray-900 cursor-pointer">
                                <i class="fa fa-heart mr-3" aria-hidden="true"></i>
                                My Artists
                            </a>
                        </div>
                        <div>
                            <a href="/my-albums" class="p-2 block text-white border-b hover:bg-gray-900 cursor-pointer">
                                <i class="fa fa-heart mr-3" aria-hidden="true"></i>
                                My Albums
                            </a>
                        </div>
                    </div>
                    @auth
                        <div class="mt-8 mb-8">
                            <div class="p-2">
                                <a href="/logout" class="bg-red-500 px-4 py-2 rounded font-bold text-white">
                                    <i class="fa-solid fa-right-from-bracket mr-3 -scale-x-100"></i>
                                    Sign out
                                </a>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>

            <div class="w-3/4 bg-gray-900 m-2 rounded p-2">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>
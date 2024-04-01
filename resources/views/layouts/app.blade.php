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
                            <a href="/all-artists" class="p-2 block text-white border-b hover:bg-gray-900 cursor-pointer {{ request()->is('all-artists') ? 'bg-red-500' : '' }}">
                                <i class="fa fa-music mr-3"></i>
                                Artists
                            </a>
                        </div>
                        <div>
                            <a href="/all-albums" class="p-2 block text-white border-b hover:bg-gray-900 cursor-pointer {{ request()->is('all-albums') ? 'bg-red-500' : '' }}">
                                <i class="fa-solid fa-compact-disc mr-3"></i>
                                Albums
                            </a>
                        </div>
                        <div class="mt-8 mb-8">
                            <div>
                                <a href="/artists" class="p-2 block text-white border-b hover:bg-gray-900 cursor-pointer {{ request()->is('artists') ? 'bg-red-500' : '' }}">
                                    <i class="fa fa-heart mr-3" aria-hidden="true"></i>
                                    My Artists
                                </a>
                            </div>
                            <div>
                                <a href="/albums" class="p-2 block text-white border-b hover:bg-gray-900 cursor-pointer {{ request()->is('albums') ? 'bg-red-500' : '' }}">
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
                        @else
                        <div class="mt-8 mb-8">
                            <a href="auth/google" class="p-4 w-1/4">
                                <div class="gsi-material-button">
                                    <div class="gsi-material-button-state"></div>
                                    <div class="gsi-material-button-content-wrapper">
                                        <div class="gsi-material-button-icon">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" xmlns:xlink="http://www.w3.org/1999/xlink" style="display: block;">
                                                <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z">
                                                </path>
                                                <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z">
                                                </path>
                                                <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z">
                                                </path>
                                                <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z">
                                                </path>
                                                <path fill="none" d="M0 0h48v48H0z"></path>
                                            </svg>
                                        </div>
                                        <span class="gsi-material-button-contents">Sign in</span>
                                        <span style="display: none;">Sign in with Google</span>
                                    </div>
                                </div>
                            </a>
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
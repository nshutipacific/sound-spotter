<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sound Spotter | @yield('title')</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div id="app">
        @yield('content')
    </div>
</body>
</html>

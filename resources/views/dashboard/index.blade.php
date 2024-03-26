<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sound Spotter | Dshboard</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    @if (Auth::check())
    <p>Welcome, {{ Auth::user()->name }}!</p>
    <p>Your ID is: {{ Auth::user()->id }}</p>
    @else
    <p>Welcome, guest!</p>
    @endif

    <a href="/logout" class="mt-2 px-4 py-2 bg-red-700 rounded-lg"> Log out</a>
</body>

</html>
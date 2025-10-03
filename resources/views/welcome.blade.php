<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Example App</title>
    @vite('resources/js/app.js')
</head>

<body>
    <div id="app"></div>

    {{-- Login failed message --}}
    @if ($errors->has('login'))
        <div style="color:red;">
            {{ $errors->first('login') }}
        </div>
    @endif

    {{-- Para sa profile --}}
    @auth
        <p>Bio: {{ auth()->user()->bio }}</p>
        <p>Avatar: {{ auth()->user()->avatar }}</p>
        <p>Address: {{ auth()->user()->address }}</p>
    @elseif (!request()->is('login') && !request()->is('register'))
        <p>Please login to see your profile.</p>
    @endauth
</body>
</html>

@extends('layouts.app')

@section('title', 'Home')


@section('content')
    <App/>
@endsection
@auth
    <script>
        window.location.href = '/dashboard';
    </script>
@endauth
@extends('layouts.app')

@section('title', 'Home')


@section('content')
    <app/>
@endsection
@auth
    <script>
        window.location.href = '/dashboard';
    </script>
@endauth
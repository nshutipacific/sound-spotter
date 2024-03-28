@extends('layouts.app')

@section('title', 'Dashboard')

@if (Auth::check())

    @section('content')
        <Dashboard :user="{{ Auth::user() }}" :msg="Hey"/>
    @endsection
@else
    <script>
        window.location.href = '/';
    </script>
@endif
@extends('layouts.app')

@section('title', 'Artist')


@section('content')
@if(auth()->check())
    <artist-view :artist="{{ $artist }}" />
@else
<div class="flex items-center justify-center w-full">
    <div>
        <p class="text-2xl text-white font-black p-4">Oops!</p>
        <p class="p-4">Sorry, you can not access this page unless you login</p>
        <p class="p-4 text-xs"> Please sign in with Google below </p>
        <google-sign-in-button />
    </div>
</div>
@endif
@endsection
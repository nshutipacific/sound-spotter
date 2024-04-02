@extends('layouts.app')

@section('title', 'My Artists')


@section('content')
@if(auth()->check())
<div class="bg-gray-800 rounded-lg flex flex-wrap items-center justify-center">
    <div class="flex items-center justify-center w-full bg-gray-300 rounded-t-lg p-4 text-gray-900 text-lg font-bold"> {{auth()->user()->name }} Favourite Artist(s)</div>
    <div class="flex items-center justify-center w-full px-4 py-1 bg-green-500 text-white text-sm"> You can view, edit and delete an Artist </div>
    <div class="flex items-center justify-center w-full px-4 bg-gray-600 text-white text-xs py-1"> Editing an artist could lead to not finding additional details</div>
    <table class="mt-4 bg-gray-700 rounded mb-4">
        <thead>
            <tr>
                <th class="p-2 text-white pl-4">No</th>
                <th class="p-2 text-white">Image</th>
                <th class="p-2 text-white">Artist Name</th>
                <th class="p-2 text-white">Listeners</th>
                <th class="p-2 text-white pr-4">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($artists as $artist)
            <tr class="border-b">
                <td class="p-2 text-xs pl-4">{{ $loop->index + 1 }}</td>
                <td class="p-2 text-xs"><img class="rounded-full h-8 w-8" src="{{ $artist->image }}" alt="{{ $artist->name }}" width="50" height="50"></td>
                <td class="p-2 text-xs">{{ $artist->name }}</td>
                <td class="p-2 text-xs">{{ $artist->listeners }}</td>
                <td class="p-2 text-xs pr-4">
                    <div class="flex gap-4">
                        <div class="text-green-500 hover:text-green-700  cursor-pointer">
                            <i class="fa fa-eye"></i>
                        </div>
                        <div class="text-yellow-500 hover:text-yellow-700  cursor-pointer">
                            <i class="fas fa-edit"></i>
                        </div>
                        <div class="text-red-500 hover:text-yellow-700  cursor-pointer">
                            <i class="fa-solid fa-trash"></i>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
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
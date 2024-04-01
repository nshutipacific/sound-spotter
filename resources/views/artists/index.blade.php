@extends('layouts.app')

@section('title', 'Artists')


@section('content')
@if(auth()->check())
<div class="bg-gray-800 rounded-lg flex flex-wrap items-center justify-center">
    <div class="flex items-center justify-center w-full bg-gray-300 rounded-t-lg p-4 text-gray-900 text-lg font-bold"> {{auth()->user()->name }} Favourite Artist(s)</div>
    <div class="flex items-center justify-center w-full px-4 py-1 bg-green-500 text-white text-sm"> You can view, edit and delete an Artist </div>
    <div class="flex items-center justify-center w-full px-4 py-1 bg-red-500 text-white text-sm"> Editing an artist could lead to not finding additional details</div>
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
</div>
@endif
@endsection
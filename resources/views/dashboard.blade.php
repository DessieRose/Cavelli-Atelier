@extends('layouts.app')

@section('title', 'Login - Cavelli Atelier')

@section('content')
    <div class="min-h-screen flex items-center justify-center gap-4 flex-col">
        @include('errors')
    
        <h2>Hello, {{ auth()->user()->name }}!</h2>
        <div class="items-center bg-gray-100 border border-gray-300 rounded-lg p-4">
            <a href="/logout">Logout</a>

        </div>
    
        <div class="items-center bg-gray-100 border border-gray-300 rounded-lg p-4">
            <a href="/products">products page</a>

        </div>

    </div>



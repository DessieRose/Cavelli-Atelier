@extends('layouts.app')

@section('title', 'Login - Cavelli Atelier')

@section('content')
    <div>
        @include('errors')
    
        <p>Hello, {{ auth()->user()->name }}!</p>
        <a href="/logout">Logout</a>
    
        <a href="/products">products page</a>

    </div>



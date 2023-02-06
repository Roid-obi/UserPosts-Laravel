@extends('layouts.app')

@section('content')
<div class="container">
    
    @if (Auth::user())
    <div class="text-center">
        <h3>Nama : {{ Auth::user()->nama }}</h3>
        <h3>Email : {{ Auth::user()->email }}</h3>
        <h3>Alamat : {{ Auth::user()->alamat }}</h3>
        <h3>Tanggal lahir : {{ Auth::user()->tanggal_lahir }}</h3>
        <h3>jenis Kelamin : {{ Auth::user()->jenis_kelamin }}</h3>
        <h3>Role : {{ Auth::user()->role }}</h3>
        <h3>Created At : {{ Auth::user()->created_at->diffForHumans() }}</h3>
        <h3>Updated At : {{ Auth::user()->updated_at->diffForHumans() }}</h3>
        
    </div>
    @else
        <h2>Hello, Please <a href="/login">Login</a> or <a href="/register">Register</a></h2>
    @endif
</div>
@endsection

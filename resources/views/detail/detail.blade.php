@extends('layouts.app')

@section('content')
<div class="container">
    
        @if (Auth::user())
    <div id="profl">
        <div class="text-left">
            <div class="benr">
                @if ($user->gambar)
                    <img src="{{ asset('storage/public/images/'. $user->gambar) }}" class="img-circle elevation-2" alt="User Image">
                @else
                    <img  src="{{ asset('gambar/npc.jpg') }}" class="img-circle " alt="User Image">
                @endif
            </div>

            <div class="datep">
                <div class="boxki">
                <h3>Nama : {{ $user->nama }}</h3>
                <h3>Email : {{ $user->email }}</h3>
                <h3>Alamat : {{ $user->alamat }}</h3>
                <h3>Tanggal Lahir : {{ $user->tanggal_lahir }}</h3>
                <h3>Jenis Kelamin : {{ $user->jenis_kelamin  }}</h3>
                <h3>Role : {{ $user->role }}</h3>
            </div>
            <div class="boxka">
                <h3>Created At : {{ $user->created_at->diffForHumans() }}</h3>
                <h3>Updated At : {{ $user->updated_at->diffForHumans() }}</h3>
                {{-- <img src="{{ asset( Auth::user()->gambar ) }}" alt="" width="500" srcset="">  --}}
            </div>
            </div>

        </div>
    </div>
        @else
            <h2>Hello, Please <a href="/login">Login</a> or <a href="/register">Register</a></h2>
        @endif
    
</div>
@endsection

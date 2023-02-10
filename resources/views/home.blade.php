@extends('layouts.app')

@section('content')
<div class="container">
    
        @if (Auth::user())
    <div id="profl">
        <div class="text-left">
            <div class="benr">
                <img  src="{{ asset('/storage/public/images/'.Auth::user()->gambar ) }}" class="img-circle " style="width: 200px">
            </div>

            <div class="datep">
                <div class="boxki">
                    <h3>Nama : {{ Auth::user()->nama }}</h3>
                    <h3>Email : {{ Auth::user()->email }}</h3>
                    <h3>Alamat : {{ Auth::user()->alamat }}</h3>
                    <h3>Tanggal Lahir : {{ Auth::user()->tanggal_lahir }}</h3>
                    <h3>Jenis Kelamin : {{ Auth::user()->jenis_kelamin }}</h3>
                    <h3>Role : {{ Auth::user()->role }}</h3>
                </div>
                <div class="boxka">
                    <h3>Created At : {{ Auth::user()->created_at->diffForHumans() }}</h3>
                    <h3>Updated At : {{ Auth::user()->updated_at->diffForHumans() }}</h3>
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

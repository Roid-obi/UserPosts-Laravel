@extends('layouts.app')

@section('content')
<div class="container">
    
        @if (Auth::user())
    <div id="profl">
        
            <div class="benr">
                @if (Auth::user()->gambar)
                    <img src="{{ asset('storage/public/images/'. Auth::user()->gambar) }}" class="img-circle elevation-2" alt="User Image">
                @else
                    <img  src="{{ asset('gambar/guruguru-hololive.gif') }}" class="img-circle " alt="User Image">
                @endif
            </div>

            <div class="datep">
                <div class="boxki">
                <h3>Nama : {{ Auth::user()->nama }}</h3>
                <h3>Email : {{ Auth::user()->email }}</h3>
                <h3>Alamat : {{ Auth::user()->alamat }}</h3>
                <h3>Tanggal Lahir : {{ Auth::user()->tanggal_lahir }}</h3>
                <h3>Jenis Kelamin : {{ Auth::user()->jenis_kelamin  }}</h3>
                <h3>Role : {{ Auth::user()->role }}</h3>
            </div>
            <div class="boxka">
                <h4>Created At : {{ Auth::user()->created_at->diffForHumans() }}</h4>
                <h4>Updated At : {{ Auth::user()->updated_at->diffForHumans() }}</h4>
                <div class="butn-edit-prof">
                <a  href="/update/users/{{ Auth::user()->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                  </svg></a>
                </div>
                {{-- <img src="{{ asset( Auth::user()->gambar ) }}" alt="" width="500" srcset="">  --}}
            </div>
            </div>

        
    </div>
        @else
            <h2>Hello, Please <a href="/login">Login</a> or <a href="/register">Register</a></h2>
        @endif
    
</div>
@endsection

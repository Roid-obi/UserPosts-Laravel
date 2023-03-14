<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Saved posts</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}

    <title>{{ "Larave User" }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

    {{-- Admin LTE --}}
    <link rel="stylesheet" href="{{ asset('vendor/admin-lte/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    @stack('styles')

    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> --}}

    {{-- css --}}
    {{-- <link rel="stylesheet" href="{!! asset('css/profil.css') !!}"> --}}
</head>
<body class="sidebar-mini layout-fixed">
    @include('layouts.navbar')
    @include('layouts.sidebar')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">

    <div class="container py-2">
        <div class="row">
            @foreach ($postsaves as $post)
                <div class="col-md-4 my-2">
                    <div class="card">
                        @if ($post->post->image != 'none')
                            <img src="{{ asset('/storage/public/images/'.$post->post->image) }}" class="card-img-top img-fluid" style="max-height: 230px">
                        @else
                            <img src="{{ asset('/images/hehehehe.png') }}" class="card-img-top img-fluid" style="max-height: 230px">
                        @endif
                        <div class="card-body">
                            <h4 class="card-title text-truncate">
                                {{ $post->post->title }}
                            </h4>
                            <p class="card-text text-truncate">
                                {!! $post->post->content !!}
                            </p>
                            <p class="card-text">by: {{ $post->post->created_by }}</p>
                            <small class="text-muted float-end"><i class="bi bi-eye-fill"></i> {{ $post->post->views }}</small>
                        </div>
                            <a href="/posts/{{ $post->post->slug }}" class="card-footer text-center">Read More</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
</section>
</div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/admin-lte/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>

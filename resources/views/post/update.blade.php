@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/summernote/summernote-bs4.min.css') }}">
@endpush

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col">


                <div class="card">
                    <div class="card-header">{{ __('Update post') }}</div>
                    <div class="card-body">

                        <form action="{{ route('post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            
                            {{-- title --}}
                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>
                                <div class="col-md-6">
                                    <input
                                        id="title"
                                        type="text"
                                        class="form-control @error('title') is-invalid @enderror"
                                        name="title"
                                        value="{{ $post->title }}"
                                    >
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- image --}}
                            <div class="mt-3">
                                <img src="{{ asset('/storage/public/images/'.$post->image) }}" class="outimgd" width="200" src="" id="output"> {{-- output --}}
                            </div>
                            <div class="row mb-3">
                                <label
                                    for="image"
                                    class="col-md-4 col-form-label text-md-end"
                                >{{ __('Gambar') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div>
                                            <input
                                                name="image"
                                                class="form-control @error('image') is-invalid @enderror"
                                                value="{{ $post->image }}"
                                                type="file"
                                                accept="image/*"
                                                id="formFile"
                                                onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])"
                                                onchange="loadFile(event)"
                                            >
                                            <small
                                                for="formFile"
                                                class="form-label"
                                            >Silahkan Upload Foto Anda</small>
                                        </div>
                                    </div>
                                    @error('image')
                                        <span
                                            class="invalid-feedback"
                                            role="alert"
                                        >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            {{-- konten --}}
                            <div class="row mb-3">
                                <label for="content" class="col-md-4 col-form-label text-md-end">{{ __('content') }}</label>
                                <div class="col-md-6">
                                    <textarea
                                        id="content"
                                        {{-- type="text" --}}
                                        class="form-control @error('content') is-invalid @enderror"
                                        name="content"
                                        
                                    >{{ $post->content }}</textarea>

                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <input type="hidden" name="created_by" value="{{ Auth::user()->name }}">
                            

                            {{-- Save --}}
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-dark">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script src="{{ asset('vendor/summernote/summernote-bs4.min.js') }}"></script>
<script>
    
    $(document).ready(function() {
        $('#content').summernote();
    })
    function loadFile(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
@endpush
@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/summernote/summernote-bs4.min.css') }}">
@endpush

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col">


                <div class="card">
                    <div class="card-header">{{ __('Create post') }}</div>
                    <div class="card-body">

                        <form action="{{ route('post.input') }}" method="POST" enctype="multipart/form-data">
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
                                        value="{{ old('title') }}"
                                    >
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            {{-- Category --}}
                        <div class="catag row mb-3 ">
                            <label for="categories" class="col-md-2 col-form-label text-right" >{{ __('Category') }}</label>

                            <div class="catagch col-md-10">
                                @foreach ($categories as $category)
                                    <input class="px-2" type="checkbox" name="categories[]" id="categories-{{ $category->id }}" value="{{ $category->id }}">
                                    <label for="categories-{{ $category->id }}">{{ $category->nama }}</label>
                                @endforeach

                                @error('categories')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                             {{-- tag --}}
                        <div class="catag row mb-3">
                            <label for="tags" class="col-md-2 col-form-label text-right">{{ __('Tag') }}</label>

                            <div class="catagch col-md-10">
                                @foreach ($tags as $tag)
                                    <input type="checkbox" name="tags[]" id="tags_{{ $tag->id }}" value="{{ $tag->id }}">
                                    <label for="tags_{{ $tag->id }}">{{ $tag->nama }}</label>
                                @endforeach

                                @error('tags')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                            
                            {{-- <div class="row mb-3">
                                <label for="tags"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Tag') }}</label>
                                <div class="col-md-6 mt-2">
                                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                        @foreach ($tags as $tag)
                                            <input type="checkbox" name="tags[]" class="btn-check"
                                                id="tags_{{ $tag->id }}" autocomplete="off"
                                                value="{{ old('tag', $tag->id) }}">
                                            <label class="btn btn-sm btn-outline-success"
                                                for="tags_{{ $tag->id }}">{{ $tag->nama }}</label>
                                        @endforeach
                                    </div>
                                </div>
                            </div> --}}
                           


                            {{-- image --}}
                            <div class="mt-3">
                                <img class="outimgd" width="200" src="" id="output"> {{-- output --}}
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
                                                value="{{ old('image') }}"
                                                type="file"
                                                accept="image/*"
                                                id="formFile"
                                                onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])"
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
                                        value="{{ old('content') }}"
                                    ></textarea>

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
                                        {{ __('Create') }}
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
</script>
@endpush

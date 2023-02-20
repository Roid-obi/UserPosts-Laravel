@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col">


                <div class="card">
                    <div class="card-header">{{ __('Create Category') }}</div>
                    <div class="card-body">

                        <form action="{{ route('catego.input') }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            
                            {{-- Nama --}}
                            <div class="row mb-3">
                                <label for="nama" class="col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>
                                <div class="col-md-6">
                                    <input
                                        id="nama"
                                        type="text"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        name="nama"
                                        value="{{ old('nama') }}"
                                    >
                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            

                            {{-- description --}}
                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Deskripsi') }}</label>
                                <div class="col-md-6">
                                    <textarea
                                        id="description"
                                        type="text"
                                        class="form-control @error('description') is-invalid @enderror"
                                        name="description"
                                        value="{{ old('nama') }}"
                                    ></textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <input type="hidden" name="created_by" value="{{ Auth::user()->nama }}">

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

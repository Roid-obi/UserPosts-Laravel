@extends('layouts.app')
{{-- halamat edit  --}}
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Edit Profile') }}</div>
                    <div class="card-body">
                        <form
                            action="{{ route('my.profile.update') }}"
                            method="POST"
                            enctype="multipart/form-data"
                        >
                            @method('put')
                            @csrf
                            {{-- Name --}}
                            <div class="row mb-3">
                                <label
                                    for="name"
                                    class="col-md-4 col-form-label text-md-end"
                                >{{ __('Nama') }}</label>

                                <div class="col-md-6">
                                    <input
                                        id="name"
                                        type="text"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        name="name"
                                        value="{{ old('nama', auth()->user()->nama) }}"
                                    >

                                    @error('nama')
                                        <span
                                            class="invalid-feedback"
                                            role="alert"
                                        >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Tanggal Lahir --}}
                            <div class="row mb-3">
                                <label
                                    for="tanggal_lahir"
                                    class="col-md-4 col-form-label text-md-end"
                                >{{ __('Tanggal Lahir') }}</label>

                                <div class="col-md-6">
                                    <input
                                        id="tanggal_lahir"
                                        type="date"
                                        class="form-control @error('date_of_birth') is-invalid @enderror"
                                        name="date_of_birth"
                                        value="{{ old('date_of_birth', auth()->user()->date_of_birth) }}"
                                    >

                                    @error('tanggal_lahir')
                                        <span
                                            class="invalid-feedback"
                                            role="alert"
                                        >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Jenis Kelamin --}}
                            <div class="row mb-3">
                                <label
                                    for="jenis_kelamin"
                                    class="col-md-4 col-form-label text-md-end"
                                >{{ __('Jenis Kelamin') }}</label>

                                <div class="col-md-6">
                                    <select
                                        class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                        aria-label="Default select example"
                                        name="jenis_kelamin"
                                    >
                                        <option
                                            {{ old('jenis_kelamin', auth()->user()->jenis_kelamin) === "laki tulen" ? 'selected' : '' }}
                                            value="LakiTulen "
                                        >Laki-Laki</option>
                                        <option
                                            {{ old('jenis_kelamin', auth()->user()->jenis_kelamin) === "Perempuan" ? 'selected' : '' }}
                                            value="Cewek"
                                        >Cewek</option>
                                        <option
                                            {{ old('jenis_kelamin', auth()->user()->jenis_kelamin) === "rahasia" ? 'selected' : '' }}
                                            value="Cewek"
                                        >rahasia</option>
                                    </select>

                                    @error('jenis_kelamin')
                                        <span
                                            class="invalid-feedback"
                                            role="alert"
                                        >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Alamat --}}
                            <div class="row mb-3">
                                <label
                                    for="alamat"
                                    class="col-md-4 col-form-label text-md-end"
                                >{{ __('Alamat') }}</label>

                                <div class="col-md-6">
                                    <textarea
                                        id="address"
                                        type="text"
                                        class="form-control @error('address') is-invalid @enderror"
                                        name="address"
                                    >{{ old('address', auth()->user()->alamat) }}</textarea>

                                    @error('address')
                                        <span
                                            class="invalid-feedback"
                                            role="alert"
                                        >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- images --}}
                            <div class="row mb-3">
                                <label
                                    for="gambar"
                                    class="col-md-4 col-form-label text-md-end"
                                >{{ __('Foto') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div>
                                            @if (auth()->user()->gambar)
                                                <img src="{{ Storage::url(auth()->user()->gambar) }}" class="img-fluid mb-3 rounded">
                                            @endif
                                            <input
                                                name="images"
                                                class="form-control @error('images') is-invalid @enderror"
                                                value="{{ old('images', auth()->user()->gambar) }}"
                                                type="file"
                                                accept="image/*"
                                                id="formFile"
                                            >
                                            <small
                                                for="formFile"
                                                class="form-label"
                                            >Silahkan Upload Foto Anda</small>
                                        </div>  
                                    </div>
                                    @error('gambar')
                                        <span
                                            class="invalid-feedback"
                                            role="alert"
                                        >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Save --}}
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button
                                        type="submit"
                                        class="btn btn-dark"
                                    >
                                        {{ __('Save') }}
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
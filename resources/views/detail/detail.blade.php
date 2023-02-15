@extends('layouts.app',['title' => 'Show'])

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Edit Profile') }}</div>
                    <div class="card-body">
                        <form
                            action="{{ route('show.update',$user->id) }}"
                            method="POST"
                            enctype="multipart/form-data"
                        >
                            @method('put')
                            @csrf
                            {{-- Nama --}}
                            <div class="row mb-3">
                                <label
                                    for="nama"
                                    class="col-md-4 col-form-label text-md-end"
                                >{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input
                                        id="nama"
                                        type="text"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        name="nama"
                                        value="{{ old('nama', $user->nama) }}"
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
                            {{-- Status --}}
                            {{-- <div class="row mb-3">
                                <label
                                    for="status"
                                    class="col-md-4 col-form-label text-md-end"
                                >{{ __('Status') }}</label>

                                <div class="col-md-6">
                                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                        <option value=true {{ ($user->status === true) ? 'selected' : '' }}>Active</option>
                                        <option value=false {{ ($user->status === false) ? 'selected' : '' }}>Inactive</option>
                                    </select>

                                    @error('status')
                                        <span
                                            class="invalid-feedback"
                                            role="alert"
                                        >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}
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
                                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                        name="tanggal_lahir"
                                        value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}"
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
                                            {{ ($user->jenis_kelamin === "Pria") ? 'selected' : '' }}
                                            value="Pria"
                                        >Pria</option>
                                        <option
                                            {{ ($user->jenis_kelamin === "Wanita") ? 'selected' : '' }}
                                            value="Wanita"
                                        >Wanita</option>
                                        <option
                                            {{ ($user->jenis_kelamin === 'Privasi' || $user->jenis_kelamin === null) ? 'selected' : '' }}
                                            value="Privasi"
                                        >Rahasia</option>
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
                                >{{ __('alamat') }}</label>

                                <div class="col-md-6">
                                    <textarea
                                        id="alamat"
                                        type="text"
                                        class="form-control @error('alamat') is-invalid @enderror"
                                        name="alamat"
                                    >{{ old('alamat', $user->alamat) }}</textarea>

                                    @error('alamat')
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
                                            <input
                                                name="gambar"
                                                class="form-control @error('gambar') is-invalid @enderror"
                                                value="{{ old('gambar', $user->gambar) }}"
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

                        <input type="hidden" name="role" value="{{ $user->role }}">
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
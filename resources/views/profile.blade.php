@extends('layouts.template')
@push('css')
    <style>
        :root {
            --primary-color: #5a90f3;
            --secondary-color: #f0f0f0;
            --text-color: #333;
            --hover-color: #ff6347;
            --header-bg-color: linear-gradient(135deg, #5a90f3, #445688);
            --input-bg-color: #eef4ff; /* Warna latar belakang untuk input form */
        }

        body {
            background-color: var(--secondary-color);
            font-family: sans-serif;
            color: var(--text-color);
        }

        .profile-container {
            border: 2px solid var(--primary-color);
            border-radius: 15px;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .photo-date {
            color: #6b6b6b;
            font-size: 0.85em;
        }

        .table th {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
        }

        .table td {
            text-align: center;
        }

        .profile-button {
            background-color: var(--primary-color);
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        .profile-button:hover {
            background-color: var(--hover-color);
            color: #fff;
        }

        .profile-header {
            background: var(--header-bg-color);
            color: white;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
        }

        /* Tambahkan warna latar belakang untuk input form */
        .form-control {
            background-color: var(--input-bg-color);
            border: 1px solid var(--primary-color);
            color: var(--text-color);
        }

        .form-control:focus {
            box-shadow: 0 0 8px rgba(90, 144, 243, 0.5);
            border-color: var(--primary-color);
        }
        .form-label-card {
        background-color: var(--primary-color);
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        display: inline-block;
        font-weight: bold;
        margin-bottom: 5px;
    }
    </style>
@endpush

@section('content')
<div class="container profile-container mt-5">
    <div class="profile-header text-center">{{ __('Profile') }}</div>
    <div class="card-body">
        @if(session('status'))
            <div class="alert alert-success text-center" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-4">
                <!-- Menampilkan foto profil, jika tidak ada avatar maka tidak ada gambar default -->
                <img src="{{ $user->avatar ? asset('storage/photos/'.$user->avatar) : '' }}" 
                     class="img-thumbnail rounded mx-auto d-block">
            </div>
            <div class="col-md-8">
                <form method="POST" action="{{ route('profile.update', $user->user_id) }}" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="row mb-3">
                        <label for="username" class="col-md-4 col-form-label text-md-end form-label-card">{{ __('Username') }}</label>
                        <div class="col-md-6">
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required autocomplete="username">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama" class="col-md-4 col-form-label text-md-end form-label-card">{{ __('Nama') }}</label>
                        <div class="col-md-6">
                            <input id="nama" type="nama" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $user->nama) }}" required autocomplete="nama">
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="old_password" class="col-md-4 col-form-label text-md-end form-label-card">{{ __('Password Lama') }}</label>
                        <div class="col-md-6">
                            <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" autocomplete="old-password">
                            @error('old_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end form-label-card">{{ __('Password Baru') }}</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end form-label-card">{{ __('Confirm Password') }}</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end form-label-card">{{ __('Ganti Foto Profil') }}</label>
                        <div class="col-md-6">
                            <input id="avatar" type="file" class="form-control" name="avatar">
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn profile-button">
                                {{ __('Update Profile') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

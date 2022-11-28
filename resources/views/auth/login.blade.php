@extends('layouts.auth.app', ['title' => 'Login - Larapos'])

@section('content')
    <form class="card card-md border-0 rounded-3" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="card-body">
            <h3 class="text-center mb-3 font-weight-medium">
                Larapos
            </h3>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror"
                    placeholder="masukan username anda" name="username" value="{{ old('username') }}">
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Kata Sandi</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="masukan kata sandi anda" name="password" value="{{ old('password') }}">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
        </div>
    </form>
@endsection

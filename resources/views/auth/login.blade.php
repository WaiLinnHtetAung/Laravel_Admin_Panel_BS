@extends('auth.app')
@section('title', 'Login')
@section('content')
    <div class="login">
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="logo d-flex justify-content-center">
                <img src="{{ asset('logo.png') }}" alt="">
            </div>
            <div class="card p-4 p-sm-5">
                <h2 class="text-center mb-4 font-bold">Login</h2>
                <div class="form-group mb-4">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email', '') }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-5">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button class="btn w-100 mb-4">Login</button>

                {{-- <p class="text-center mb-0 pb-0">New user ? <a href="{{ route('register') }}">Register</a></p> --}}
            </div>
        </form>
    </div>
@endsection

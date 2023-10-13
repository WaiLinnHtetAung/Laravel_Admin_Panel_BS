@extends('auth.app')
@section('title', 'Register')
@section('content')
    <div class="register">
        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="logo d-flex justify-content-center">
                <img src="{{ asset('logo.png') }}" alt="">
            </div>
            <div class="card p-4 p-sm-5">
                <h2 class="text-center mb-4 font-bold">Register</h2>

                <div class="form-group mb-4">
                    <label for="">Username</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name', '') }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email', '') }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-5">
                    <label for="">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button class="btn w-100 mb-4">Register</button>

                <p class="text-center mb-0 pb-0">Already user ? <a href="{{ route('login') }}">Login</a></p>
            </div>
        </form>
    </div>
@endsection

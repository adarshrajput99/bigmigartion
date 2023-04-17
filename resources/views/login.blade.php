@extends('nova::auth.layout')

@section('content')
    <div class="card w-1/3 mx-auto">
        <h2 class="text-xl text-center mt-8 mb-6">{{ __('Login') }}</h2>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="email" class="block">{{ __('Email') }}</label>
                <input type="email" name="email" id="email" class="form-input w-full @error('email') border-red-500 @enderror" value="{{ old('email') }}" required autofocus>

                @error('email')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block">{{ __('Password') }}</label>
                <input type="password" name="password" id="password" class="form-input w-full @error('password') border-red-500 @enderror" required>

                @error('password')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center justify-between mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="remember" class="form-checkbox" {{ old('remember') ? 'checked' : '' }}>
                    <span class="ml-2">{{ __('Remember Me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-700">{{ __('Forgot Your Password?') }}</a>
                @endif
            </div>

            <button type="submit" class="btn btn-primary w-full">
                {{ __('Login') }}
            </button>
        </form>
    </div>
@endsection

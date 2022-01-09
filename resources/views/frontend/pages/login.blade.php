@extends('frontend.master')
@section('title')
 {{config('app.name')}} - Login
@endsection
@section('content')
<!-- checkout-area start -->
<div class="account-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $item)
                    {{$item}}
                    @endforeach
                </div>
                @endif
                @if (session('warning'))
                <div class="alert alert-danger">{{session('warning')}}</div>

                @endif
                <div class="account-form form-style">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group mb-0">

                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autofocus />
                        </div>
                        <div class="form-group">
                            <x-label for="password" :value="__('Password')" />

                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                                autocomplete="current-password" />
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <input id="remember_me" type="checkbox"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    name="remember">
                                <span for="remember_me" class=" text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="{{ route('password.request') }}">Forget Your Password?</a>
                            </div>
                        </div>
                        <button type="submit">SIGN IN</button>
                    </form>
                    <div class="text-center">
                        <div class="col-lg-12 col-12">
                            <a  class="btn btn-regular mb-4 ptb-2"
                                href="{{route('GoogleLogin')}}"><img width="7%" src="{{asset('icon/unnamed.png')}}" alt="google">Login with Google</a>
                        </div>
                        <a href="{{route('register')}}">Or Creat an Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- checkout-area end -->
@endsection
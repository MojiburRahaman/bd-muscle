@extends('frontend.master')
@section('content')
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Account</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><span>Login</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
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

                <div class="account-form form-style">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">

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
                                <span class=" text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="#">Forget Your Password?</a>
                            </div>
                        </div>
                        <button type="submit">SIGN IN</button>
                        <div class="text-center">
                            <a href="register.html">Or Creat an Account</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- checkout-area end -->
@endsection
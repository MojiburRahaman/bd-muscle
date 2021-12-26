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
                        <li><span>Register</span></li>
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
                {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}
                <!-- Validation Errors -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $item)
                    <span> {{$item}}</span> <br>
                    @endforeach
                </div>
                @endif
                @if (session('warning'))
                <div class="alert alert-danger">{{session('warning')}}</div>
                @endif
                <div class="account-form form-style">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group mb-0">
                            <x-label for="name" :value="__('Name')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                                required autofocus />
                        </div>
                        <div class="form-group mb-0">

                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required />
                        </div>
                        <div class="form-group mb-0">
                            <x-label for="password" :value="__('Password')" />

                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                                autocomplete="new-password" />
                        </div>
                        <div class="form-group mb-0">
                            <x-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required />
                        </div>

                        <div class="row">
                        </div>
                        <button type="submit">Register</button>
                    </form>
                    <div class="text-center">
                        <div>

                            <a style="padding: 10px 190px" class="btn btn-danger mb-4"
                                href="{{route('GoogleRegister')}}">Register with Gmail</a>
                        </div>
                        <a href="register.html">Or Creat an Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- checkout-area end -->
@endsection
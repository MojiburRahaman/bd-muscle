@extends('frontend.master')
@section('title')
 {{config('app.name')}} - Register
@endsection
@section('content')
<div class="account-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                <x-auth-session-status class="mb-4" :status="session('status')" />
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
                            <a class="btn btn-regular mb-4"
                                href="{{route('GoogleRegister')}}"><img width="7%" src="{{asset('icon/unnamed.png')}}" alt="google">
                                Register with Google</a>
                        </div>
                       <span>Already Register?<a href="{{route('login')}}"> login</a></span> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('frontend.master')
@section('title')
{{config('app.name')}} - Contact
@endsection
@section('content')
<!-- .breadcumb-area start -->
<style>
    .bg-img-4 {
        background-image: url('{{asset('banner_image/blog.jpeg')}}');
        padding: 120px 0;
    }

</style>
<div class="breadcumb-area bg-img-4 ">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Contact</h2>
                    <ul>
                        <li><a href="{{route('Frontendhome')}}">Home</a></li>
                        <li><span>Contact</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- contact-area start -->
@if ($setting->google_map != '')
<div class="google-map">
    <div class="contact-map">
        {!!$setting->google_map!!}
    </div>
</div>
@endif
<div class="contact-area ptb-100">
    <div class="container">

        <div class="row">
            <div class="col-lg-8 col-12">
                @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error )
                    <span>{{$error}}</span> <br>
                    @endforeach
                </div>
                @endif
                <div class="contact-form form-style">
                    <div class="cf-msg"></div>
                    <form action="{{route('FrontendContactPost')}}" method="post" id="cf">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <input type="text" placeholder="Name" id="fname" name="name">
                            </div>
                            <div class="col-12  col-sm-6">
                                <input type="text" placeholder="Email" id="email" name="email">
                            </div>
                            <div class="col-12">
                                <input type="text" placeholder="Subject" id="subject" name="subject">
                                @csrf
                            </div>
                            <div class="col-12">
                                <textarea class="contact-textarea" placeholder="Message" id="msg"
                                    name="message"></textarea>
                            </div>
                            <div class="col-12">
                                {{-- <button type="submit" id="submit" name="submit">SEND MESSAGE</button> --}}
                                <button type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="contact-wrap">
                    <ul>
                        <li>
                            <i class="fa fa-home"></i> Address:
                            <p>{{$setting->address}}</p>
                        </li>
                        <li>
                            <i class="fa fa-phone"></i> Email address:
                            <p>
                                <span>{{$setting->email}}</span>
                            </p>
                        </li>
                        <li>
                            <i class="fa fa-envelope"></i> phone number:
                            <p>
                                <span>{{$setting->number}}</span>
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- contact-area end -->


@endsection
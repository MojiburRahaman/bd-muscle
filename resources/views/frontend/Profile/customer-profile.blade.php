@extends('frontend.master')

@section('content')
<style>
    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: #fff;
        background-color: #ef4836;
        ;
    }
.test{
    color: #ef4836;
}
</style>
<div class="container">
    <div class="row ptb-100">
        <div class="col-lg-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#Dashboard" role="tab"
                    aria-controls="Dashboard" aria-selected="true">Dashboard</a>
                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#change-passwords" role="tab"
                    aria-controls="change-passwords" aria-selected="false">Profile</a>
                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab"
                    aria-controls="v-pills-messages" aria-selected="false">Messages</a>
                <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab"
                    aria-controls="v-pills-settings" aria-selected="false">Settings</a>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="Dashboard" role="tabpanel"
                    aria-labelledby="v-pills-home-tab">
                    <h3>Welcome, {{Str::ucfirst(auth()->user()->name)}}</h3>
                    <p>From your account dashboard. you can easily check & view your <a class="test" href=""> recent orders</a> and Edit your
                        password and account details.</p>
                </div>
                <div class="tab-pane fade" id="change-passwords" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    HI
                </div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    ...
                </div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                    ...
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
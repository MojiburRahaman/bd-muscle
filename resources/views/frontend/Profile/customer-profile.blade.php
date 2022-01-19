@extends('frontend.master')
@section('title')
{{config('app.name')}} - Profile
@endsection
@section('content')
<style>
    
    li {
        list-style: none;
    }

</style>

<div class="container">
    <div class="row ptb-100">
        @if ($errors->any())
        <div class="col-lg-12">
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <span>{{$error}}</span> <br>
                @endforeach
            </div>
        </div>
        @endif
        @if (session('success'))
        <div class="col-lg-12">
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        </div>
        @endif
        @if (session('warning'))
        <div class="col-lg-12">
            <div class="alert alert-danger">
                {{session('warning')}}

            </div>
        </div>
        @endif
        <div class="col-lg-3 mb-5">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#Dashboard" role="tab"
                    aria-controls="Dashboard" aria-selected="true">Dashboard</a>
                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#order-list" role="tab"
                    aria-controls="v-pills-messages" aria-selected="false">Order</a>
                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#change-passwords" role="tab"
                    aria-controls="change-passwords" aria-selected="false">Change Password</a>
                <a class="nav-link" onclick="event.preventDefault();document.getElementById('from_logout').submit()"
                    href="{{ route('logout') }}">Log Out</a>
                <form id="from_logout" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="Dashboard" role="tabpanel"
                    aria-labelledby="v-pills-home-tab">
                    <h3>Welcome, {{Str::ucfirst(auth()->user()->name)}}</h3>
                    <p>From your account dashboard. you can easily check & view your <a class="test" href=""> recent
                            orders</a> and <a class="test" href="">Change your
                            password</a>.</p>
                </div>
                <div class="tab-pane fade" id="change-passwords" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <div class="ml-5 col-lg-5">

                        <form action="{{route('ChangeUserPass')}}" method="POST">
                            @csrf
                            <div class="form-group ">
                                <label for="current_pass">Current Password</label>
                                <input type="password" name="current_pass" id="current_pass" class="form-control"
                                    placeholder="Current Password">
                            </div>
                            <div class="form-group ">
                                <label for="new_pass">New Password</label>
                                <input name="new_pass" type="password" id="new_pass" class="form-control"
                                    placeholder="New Password">
                            </div>
                            <div class="form-group ">
                                <label for="confirm_pass">Confirm Password</label>
                                <input name="confirm_pass" type="password" id="confirm_pass" class="form-control"
                                    placeholder="Confirm Password">
                            </div>
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="order-list" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <table class="table">
                        <thead class="order_table">
                            <tr>
                                <th scope="col">Order No</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Delivery Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)

                            <tr>
                                @foreach ($order->order_summaries as $order_summaries)
                                <td>#{{$order_summaries->order_number}}</td>
                                <td>{{$order_summaries->created_at->format('d/m/Y')}}</td>
                                <td>৳ {{$order_summaries->subtotal}}</td>
                                @if ($order_summaries->delivery_status == 1)

                                <td>Pending...</td>
                                @elseif ($order_summaries->delivery_status === 2)
                                <td>On the way</td>
                                @else
                                <td>Deliverd</td>
                                @endif
                                @endforeach
                            </tr>
                            @empty
                            <td class="text-center" colspan="10">No Order</td>
                            @endforelse
                            <tr id="">

                            </tr>
                        </tbody>
                        <tbody id="ajax-data">

                        </tbody>
                    </table>
                    @if ($orders->links() != '')
                    <div class="mt-2 text-center">
                        <a href="javascript:void(0);" class="loadMore_btn">Load More</a>
                    </div>
                    @endif
                    <li class="col-12 text-center">
                        <div class="load_image" style="display: none">
                            <p>
                                <img width="30%" src="{{asset('front/images/Reload-Image-Gif-1.gif')}}" alt="">
                            </p>
                        </div>
                </div> 
            </div>
        </div>
    </div>
</div>

@endsection

@section('script_js')
<script>
    var page = 1;
    $(document).on('click', '.loadMore_btn', function(event){
    page++;
    loadMoreData(page)
 });

function loadMoreData(page){
     $('.loadMore_btn').hide();
    $('.load_image').show();
    $.ajax({
        url:'?page=' + page,
        type:'get',
    })
    .done(function(data){
        if(data.html == ""){
         $('.loadMore_btn').hide();
        $('.load_image').hide();
        $('.no_data').show();
           
            return;
        }
        $('#ajax-data').append(data.html);
        $('.load_image').hide();
        $('.loadMore_btn').show();
    })
}
</script>
@endsection
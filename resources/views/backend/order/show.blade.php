@extends('backend.master')

@section('content')

<div class="content-wrapper">
    <!-- Main content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Order no: {{$order->order_number}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Order</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col-6 col-lg-6">
                    <h4>
                        Name : {{$order->billing_details->billing_user_name}}
                    </h4>
                    <strong> Number</strong> : {{$order->billing_details->billing_number}}
                    <br>
                    <strong>Email</strong> : {{$order->billing_details->user_email}}
                    <br>
                    <strong>Address</strong> : <br>
                    Division: {{$order->billing_details->Division->name}},<br>
                    District: {{$order->billing_details->District->name}},<br>
                    Upazila: {{$order->billing_details->Upazila->name}}
                    <br>
                    <strong>Order Note</strong>: {{$order->billing_details->billing_order_note}}
                    <br>
                    <strong>Order Date</strong>: {{$order->created_at->format('d,M,Y')}}
                    <br>
                    <strong>Total Payment</strong>: ৳ {{$order->subtotal}}
                </div>

                <div class="col-6 col-lg-6 text-right">
                    @if ($order->delivery_status == 1)
                    <a href="" class="btn-sm btn-danger">pending</a>
                    @else
                    <a href="" class="btn-sm btn-success">Paid</a>

                    @endif
                    <a  href="" class="btn-sm btn-success testpdf">Pdf</a>
                </div>
            </div>
            <div class="col-12">
                <div class="card-body table-responsive p-0" >
                    <table class="table table-hover text-nowrap" id="pdf">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Product Name</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Flavour</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($order->order_details as $order_product)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>
                                    {{$order_product->Product->title}}
                                </td>
                                <td>
                                    {{$order_product->Color->color_name}}
                                </td>
                                <td>
                                    {{$order_product->Size->size_name}}
                                </td>
                                <td>
                                    @if ($order_product->flavour_id != '')

                                    {{$order_product->Flavour->flavour_name}}
                                    @else
                                    None
                                    @endif
                                </td>
                                <td>
                                    {{$order_product->quantity}}
                                </td>
                            </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
</div>
@endsection

{{-- @section('script_js')
<script>
    $(document).ready(function() {
    $('#pdf').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'testpdf',
                messageTop: 'PDF created by PDFMake with Buttons for DataTables.'
            }
        ]
    } );
} );
</script>
@endsection --}}
@foreach ($orders as $order)

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
@endforeach
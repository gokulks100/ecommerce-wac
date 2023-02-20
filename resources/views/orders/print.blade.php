<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Ecommerce</title>
  </head>
  <body>
    @php
        $product = $order->product;
    @endphp
    <h3>invoice</h3>
    <p>Customer Name : {{$order->name}}</p>
    <p>Phone : {{$order->phone}}</p>
    <p>Amount : {{$order->net_amount}}</p>
    <h5>Product details</h5>

    <table>
        @foreach($product as $pro)
            <tr>
            <td>product name</td>
            <td>quantity</td>
            <td>Amount</td>
            </tr>
            <tr>
            <td>{{$pro['product_name']}}</td>
            <td>{{$pro['product_quantity']}}</td>
            <td> {{$pro['amount']}}</td>
            </tr>
        @endforeach
    </table>

  </body>
</html>
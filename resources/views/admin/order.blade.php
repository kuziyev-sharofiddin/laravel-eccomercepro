<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style type="text/css">
        .div_center
        {
            text-align: center;
            padding-top: 40px;
        }
        .h2_font
        {
            font-size: 40px;
            padding-bottom: 40px;
        }
        .input_color
        {
            color: black;
        }
        .center
        {
            margin: auto;
            width: 100%;
            text-align: center;
            padding-top: 50px;
            border: 2px solid white;
        }
        .font_size
        {
            text-align: center;
            font-size: 40px;
            padding-top: 20px;        }
        .th_color
        {
            background: skyblue;
        }
        .th_dag
        {
            padding: 10px;
        }
        img
        {
            height: 250px;
            width: 250px;
        }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
      <!-- partial -->
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <h2 class="font_size">All Products</h2>
                <div style="margin: auto; padding-bottom: 30px;">
                <form action="{{route('search')}}" method="GET">
                    @csrf
                    <input type="text" name="search" style="color: black;" placeholder="Search For Something">
                    <input type="submit" value="Search" class="btn btn-outline-primary">
                </form>
                </div>
                <table class="center">
                    <tr class="th_color">
                        <th class="th_dag">Id</th>
                        <th class="th_dag">Name</th>
                        <th class="th_dag">Email</th>
                        <th class="th_dag">Address</th>
                        <th class="th_dag">Phone</th>
                        <th class="th_dag">Product Title</th>
                        <th class="th_dag">Quantity</th>
                        <th class="th_dag">Price</th>
                        <th class="th_dag">Payment Status</th>
                        <th class="th_dag">Delivery Status</th>
                        <th class="th_dag">Image</th>
                        <th class="th_dag">Delivered</th>
                        <th class="th_dag">Print PDF</th>
                    </tr>
                    @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->name}}</td>
                        <td>{{ $order->email}}</td>
                        <td>{{ $order->address}}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->product_title }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->price }}</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->delivery_status }}</td>
                        <td>
                            <img class="top" src="{{ asset('storage/'.$order->image) }}">
                        </td>
                        <td>
                            @if ($order->delivery_status=='processing')
                            <a class="btn btn-primary" href="{{ route('delivered', ['order'=>$order->id]) }}" onclick="return confirm('Are you sure this product is delivered?')">Delivered</a>
                            @else
                            <p style="color: green">Delivered</p>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('print_pdf',['order'=>$order->id]) }}" class="btn btn-secondary">Print PDF</a>
                        </td>

                    </tr>
                    @empty
                        <tr>
                            <td colspan="16">
                                No Data Found
                            </td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>


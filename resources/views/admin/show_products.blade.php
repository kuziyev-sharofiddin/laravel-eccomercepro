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
            width: 50%;
            text-align: center;
            margin-top: 40px;
            border: 3px solid white;
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
            padding: 30px;
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
                <table class="center">
                    <tr class="th_color">
                        <th class="th_dag">Product Title</th>
                        <th class="th_dag">Description</th>
                        <th class="th_dag">Quantity</th>
                        <th class="th_dag">Category</th>
                        <th class="th_dag">Price</th>
                        <th class="th_dag">Discount Price</th>
                        <th class="th_dag">Product Image</th>
                    </tr>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->title}}</td>
                        <td>{{ $product->description}}</td>
                        <td>{{ $product->quantity}}</td>
                        <td>{{ $product->category->category_name }}</td>
                        <td>{{ $product->price}}</td>
                        <td>{{ $product->discount_price }}</td>
                        <td>
                            <img style="width: 150px; height:150px;" class="top" src="{{ asset('storage/'.$product->image) }}" alt="">
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>

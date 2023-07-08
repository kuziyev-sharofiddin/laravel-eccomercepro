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
                        <th class="th_dag">Id</th>
                        <th class="th_dag">Product Title</th>
                        <th class="th_dag">Description</th>
                        <th class="th_dag">Quantity</th>
                        <th class="th_dag">Category</th>
                        <th class="th_dag">Price</th>
                        <th class="th_dag">Discount Price</th>
                        <th class="th_dag">Product Image</th>
                        <th class="th_dag">Action</th>
                    </tr>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->title}}</td>
                        <td>{{ $product->description}}</td>
                        <td>{{ $product->quantity}}</td>
                        <td>{{ $product->category->category_name }}</td>
                        <td>{{ $product->price}}</td>
                        <td>{{ $product->discount_price }}</td>
                        <td>
                            <img style="width: 150px; height:150px;" class="top" src="{{ asset('storage/'.$product->image) }}" alt="">
                        </td>
                        <td>
                            <form action="{{ route('products.destroy', ['product'=>$product->id]) }}" method="POST" onsubmit="return confirm('Are you sure to delete this?')">
                                @csrf
                                @method('DELETE')
                            <button  type="submit"><i class="fa fa-trash-o" style="padding-top:20px;font-size:48px; color:red"></i></button>
                            </form>
                            <a href="{{ route('products.edit', ['product'=>$product->id]) }}"><i class="fa fa-edit" style="padding-top:20px;font-size:48px;"></i></a>
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
{{-- <!DOCTYPE html>
<html>
<head>
<title>Google Icons</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

<h1>delete</h1>

<i class="material-icons">delete</i>
<i class="material-icons" style="font-size:36px">delete</i>
<i class="material-icons" style="font-size:48px;color:red">delete</i>

<p>Used on a button:</p>
<button style="font-size:24px">Button <i class="material-icons">delete</i></button>

<p>Unicode:</p>
<i class="material-icons">&#xe872;</i>
<i class="fa fa-trash"></i>

</body>
</html> --}}

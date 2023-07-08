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
            margin-top: 30px;
            border: 3px solid white;
        }
        label
        {
            display: inline-block;
            width: 200px;
        }

        .div_design
        {
            padding-bottom: 15px;
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
                {{-- @if(session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{session()->get('message')}}
                    </div>
                    @endif --}}
                <div class="div_center">
                    <h2 class="h2_font">
                        Add Product
                    </h2>
                    <form action="{{route('products.update', ['product'=>$product->id])}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="div_design">
                        <label for="">Product Title:</label>
                        <input type="text" class="input_color" value="{{ $product->title }}" name="title" placeholder="Write product title">
                        </div>
                        <div class="div_design">
                        <label for="">Product Description:</label>
                        <input type="text" class="input_color" value="{{ $product->description }}" name="description" placeholder="Write product description">
                        </div>
                        <div class="div_design">
                        <label for="">Product Price:</label>
                        <input type="number" class="input_color" value="{{ $product->price }}" name="price" placeholder="Write product price">
                        </div>
                        <div class="div_design">
                        <label for="">Discount Price:</label>
                        <input type="number" class="input_color" value="{{ $product->discount_price }}" name="discount_price" placeholder="Write product discount_price">
                        </div>
                        <div class="div_design">
                        <label for="">Product Quantity:</label>
                        <input type="number" class="input_color" value="{{ $product->quantity }}" name="quantity" placeholder="Write product quantity">
                        </div>
                        <div class="div_design">
                        <label for="">Select Product Category:</label>
                        <select style="color:black" name="category_id">
                            @foreach ( $categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="div_design">
                        <label for="">Product Image:</label>
                        <input type="file" class="input_color" name="image">
                        </div>
                        <div class="div_design">
                        <input type="submit" class="btn btn-primary" name="submit" value="Add Product">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>

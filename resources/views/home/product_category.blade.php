<!DOCTYPE html>
<html>
   <head>
      <base href="/public">
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="home/images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      @livewireStyles
   </head>
   <body>
    @include('sweetalert::alert')
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
      <!-- product section -->
      <section class="product_section layout_padding">
        <div class="container">
           <div class="heading_container heading_center">

              <div>
                <form action="{{route('search_product')}}" method="GET">
                    @csrf
                    <input style="width: 500px;" type="text" name="search" placeholder="Search For Something">
                    <input type="submit" value="search">
                </form>
              </div>
           </div>
           @if(session()->has('message'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            {{session()->get('message')}}
                        </div>
            @endif
           <div class="row">
            @foreach ($category->products as $product)
              <div class="col-sm-6 col-md-4 col-lg-4">
                 <div class="box">
                    <div class="option_container">
                       <div class="options">
                          <a href="{{ route('product_details', ['product'=>$product->id]) }}" class="option1">
                          Product Details
                          </a>
                          <form action="{{route('add_cart', ['product'=>$product->id])}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="number" name="quantity" value="1" min="1" style="width: 100px">
                                </div>
                                <div class="col-md-4">
                                    <input type="submit" value="Add to Cart">
                                </div>
                            </div>
                          </form>
                       </div>
                    </div>
                    <div class="img-box">
                       <img src="{{ asset('storage/'.$product->image) }}" alt="">
                    </div>
                    <div class="detail-box">
                       <h5>
                          {{ $product->title }}
                       </h5>
                       @if($product->discount_price!=null)
                        <h6 style="color: red">
                            Discount price
                            <br>
                        ${{ $product->discount_price }}
                        </h6>
                        <h6 style="text-decoration: line-through; color:blue">
                            Price
                            <br>
                            ${{ $product->price }}
                         </h6>
                         @else
                       <h6 style="color: blue">
                          ${{ $product->price }}
                       </h6>
                       @endif
                    </div>
                 </div>
              </div>
            @endforeach
           </div>
        </div>
     </section>

      <!-- end product section -->
     <!--  Comment section -->
     <div style="text-align: center; padding-bottom:30px;">
        <h1 style="font-size: 30px; text-align:center; padding-top: 20px; padding-bottom: 20px;">
            Comments
        </h1>
        <form action="{{route('add_comment')}}" method="POST">
            @csrf
            <textarea style="height: 150px; width: 600px;" placeholder="Comment something here..." name="comment"></textarea>
            <br>
            <input class="btn btn-primary" type="submit">
        </form>
     </div>
     <div style="padding-left: 20%;">
        <h1 style="font-size: 20px; padding-bottom: 20px;">
            All Comments
        </h1>
        @foreach ($comments as $comment)
            <div>
                <b>{{$comment->name}}</b>
                <p>{{$comment->comment}}</p>
                <a class="btn btn-primary" href="javascript::void(0);" data-Commentid="{{$comment->id}}" onclick="reply(this)">Reply</a>
                    @foreach ($replies as $reply)
                    @if ($reply->comment_id==$comment->id)
                        <div style="padding-left: 3%; padding-bottom: 10px;">
                            <b>{{$reply->name}}</b>
                            <p>{{$reply->reply}}</p>
                            <a class="btn btn-warning" href="javascript::void(0);" data-Commentid="{{$comment->id}}" onclick="reply(this)">Reply</a>
                        </div>
                    @endif
                    @endforeach
            </div>
        @endforeach
        <div style="display: none;" class="replyDiv">
        <form action="{{route('add_reply')}}" method="POST">
            @csrf
            <input type="text" id="commentId" name="commentId" hidden>
            <textarea placeholder="Write something here..." name="reply" style="height: 100px; width: 500px;"></textarea>
            <br>
            <button type="submit" class="btn btn-warning">Reply</button>
            <a href="javascript::void(0);" class="btn btn-secondary" onclick="reply_close(this)">Close</a>
        </form>
         </div>


     </div>

      <!-- end Comment section -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

         </p>
      </div>
      <script type="text/javascript">
        function reply(caller){
            document.getElementById('commentId').value=$(caller).attr('data-Commentid');
            $(' .replyDiv').insertAfter($(caller));
            $(' .replyDiv').show();
        }

        function reply_close(caller){
            $(' .replyDiv').hide();
        }


      </script>
      <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
      @livewireScripts
   </body>
</html>

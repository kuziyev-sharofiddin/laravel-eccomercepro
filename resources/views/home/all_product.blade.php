<!DOCTYPE html>
<html>
   <head>
      <base href="/public">
      <!-- Basic -->
      <meta charset="utf-8"/>
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content=""/>
      <meta name="author" content="" />
      <link rel="shortcut icon" href="/home/images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="/home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="/home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="/home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="/home/css/responsive.css" rel="stylesheet" />
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
         @include('home.product_view')
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
      <script src="/home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="/home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="/home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="/home/js/custom.js"></script>
      @livewireScripts
   </body>
</html>

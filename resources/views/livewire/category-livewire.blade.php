<div>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Category<span class="caret"></span></a>
        <ul class="dropdown-menu">
         @foreach ($categories as $category)
           <li><a href="{{route('product_category', ['category' => $category->id])}}">{{$category->category_name}}</a></li>
         @endforeach
        </ul>
     </li>
</div>

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Service\CommentService;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct(protected CommentService $service)
    {

    }
    public function addComment(CommentRequest $request){
        if(Auth::id())
        {
           $this->service->create($request->all());
        }
        else
        {
            return redirect('login');
        }
    }
}

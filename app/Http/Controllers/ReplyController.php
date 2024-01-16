<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use App\Service\ReplyService;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function __construct(protected ReplyService $service)
    {

    }
    public function addReply(ReplyRequest $request){
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

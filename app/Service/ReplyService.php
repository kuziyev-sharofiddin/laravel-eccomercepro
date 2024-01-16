<?php

namespace App\Service;

use App\Repository\ReplyRepository;
use Illuminate\Support\Facades\Auth;

class ReplyService
{
    protected ReplyRepository $repository;
    public function __construct(ReplyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data){
        $reply = [
            "category_name"=> $data["category_name"],
            "name"=> $data["name"],
            "user_id"=> Auth::user()->name,
            "comment_id"=> $data["commentId"],
            "reply"=> $data["reply"]
        ];
        $this->repository->create($reply);
        return redirect()->back();
    }
}

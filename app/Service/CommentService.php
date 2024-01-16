<?php

namespace App\Service;

use App\Repository\CommentRepository;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    protected CommentRepository $repository;
    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data){
        $comment = [
            "name"=> $data["name"],
            "user_id"=> Auth::user()->name,
            "comment"=> $data["comment"],
        ];
        $this->repository->create($comment);
        return redirect()->back();
    }
}

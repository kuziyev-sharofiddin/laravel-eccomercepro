<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Service\ContactService;
class ContactController extends Controller
{
    public function __construct(protected ContactService $contactService)
    {

    }
    public function contact(){
        return view('home.contact');
    }

    public function contact_store(ContactRequest $request){
        $this->contactService->create($request->all());
        return redirect()->back();
    }
}

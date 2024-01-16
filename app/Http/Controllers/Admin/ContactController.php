<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Service\ContactService;

class ContactController extends Controller
{
    public function __construct(protected ContactService $contactService)
    {

    }
    public function contact(){
        if(Auth::id())
        {
            $contacts = $this->contactService->getByPaginate(10);
            return view('admin.contact')->with([
            'contacts' => $contacts
            ]);
        }
        else
        {
            return redirect('login');
        }
    }
    public function contact_destroy($contact){
        if(Auth::id()){
            $this->contactService->destroy($contact);
        return redirect()->back()->with('message','Contact Deleted Successfully');
        }
        else
        {
            return redirect('login');
        }
    }
}

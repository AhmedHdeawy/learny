<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ContactUs;


class ContactUsController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $contactus = ContactUs::all();        

      return view('dashboard.contactus.index', compact('contactus'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(ContactUs $setting)
    {
        return view('dashboard.contactus.show', compact('setting'));
    }

}

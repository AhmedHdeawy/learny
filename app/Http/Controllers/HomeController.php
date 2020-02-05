<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Models\Info;
use App\Models\Setting;
use App\Models\ContactUs;

class HomeController extends Controller
{

    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('welcome');
        return view('front.support');
    }


    /**
     * Show the application support page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function support()
    {
        return view('front.support');
    }


    /**
     * Post the ContactUs Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function postContactUs(Request $request)
    {        

        // Validate Form
        $this->validateContactUs($request);
        
        // Create New Row
        ContactUs::create($request->all());

        return redirect()->route('support')->with('status', __('lang.contactUsDone'));

    }


    /**
     * Validate Form Request.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateContactUs(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|max:100',
            'message' => 'required|string',
        ])->validate();   
    }


}

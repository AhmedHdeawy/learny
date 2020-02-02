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
        abort(404);
        return view('front.home');
    }


}

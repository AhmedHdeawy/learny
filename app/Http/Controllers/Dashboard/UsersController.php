<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Mail\SendCode as SendCodeMail;
use App\Notifications\SendCode;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Twilio\Rest\Client;


class UsersController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    
      $request->flash();

      $inputsArray = [    
        'users.code'   => [ 'like', request('code') ],
        'users.phone'   => [ 'like', request('phone') ],
        'users.status'              => [ '=', request('status') ]
      ];

      $query = User::latest()->groupBy('id');
      
      $searchQuery = $this->handleSearch($query, $inputsArray);

      $users = $searchQuery->paginate(env('perPage'));

      return view('dashboard.users.index', compact('users'));
    }


    /**
     * Goto the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.users.create');
    }


    /**
     * Store a newly created user.
     *
     * @param  \App\Modules\Admin\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        $code = $this->generateUniqueCode();
        $password = rand(100000, 999999);

       $request->merge([
          'code'  =>  $code,
          'password'  =>  $password,
        ]);

        $user = User::create($request->all());
        
        // Nexmo
        $user->notify(new SendCode($user->code, $password));

        if ($request->email) {
            Mail::to($user->email)->send(new SendCodeMail($user->phone, $user->code, $password));
        }
        
        return redirect()->route('admin.users.index')->with('msg_success', __('lang.createdSuccessfully'));
    }


    /**
     * Generate unique code.
     *
     * @param  \App\Models\User  $user
     * @return Int
     */
    private function generateUniqueCode()
    {
        $code = rand(1000, 9999);

        $exist = User::where('code', $code)->first();

        if ($exist) {

            return $code;

        } else {
            $this->generateUniqueCode();
        }

        return $code;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {
        return view('dashboard.users.show', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
      return view('dashboard.users.edit', compact('user'));
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\UserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {

        $user->update($request->all());

        return redirect()->route('admin.users.index')->with('msg_success', __('lang.updatedSuccessfully'));
    }

    /**
     * Delete the user
     */
    public function destroy(User $user)
    {
        // Get Image name
        $avatar = $user->avatar;
        
        // Delete Record
        $user->delete();

        // Delete Image
        $this->deleteFile('users/', $avatar);


      return back()->with('msg_success', __('lang.deletedSuccessfully'));
    }

}

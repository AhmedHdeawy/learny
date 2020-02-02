<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;

use App\Admin;


class AdminsController extends Controller
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
        'admins.username'   => [ 'like', request('username') ],
        'admins.email'   => [ 'like', request('email') ],
      ];

      $query = Admin::groupBy('id');
      
      $searchQuery = $this->handleSearch($query, $inputsArray);

      $admins = $searchQuery->paginate(env('perPage'));

      return view('dashboard.admins.index', compact('admins'));
    }


    /**
     * Goto the form for creating a new admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.admins.create');
    }


    /**
     * Store a newly created admin.
     *
     * @param  \App\Modules\Admin\Http\Requests\AdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $admin = Admin::create($request->all());

        return redirect()->route('admin.admins.index')->with('msg_success', __('lang.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Admin $admin)
    {
        return view('dashboard.admins.show', compact('admin'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
      return view('dashboard.admins.edit', compact('admin'));
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\AdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, Admin $admin)
    {

        $admin->update($request->all());

        return redirect()->route('admin.admins.index')->with('msg_success', __('lang.updatedSuccessfully'));
    }

    /**
     * Delete the admin
     */
    public function destroy(Admin $admin)
    {
        // Delete Record
        $admin->delete();

      return back()->with('msg_success', __('lang.deletedSuccessfully'));
    }

}

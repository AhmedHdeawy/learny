<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;

use App\Models\Setting;


class SettingsController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $settings = Setting::all();        

      return view('dashboard.settings.index', compact('settings'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        return view('dashboard.settings.show', compact('setting'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
      return view('dashboard.settings.edit', compact('setting'));
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\SettingRequest  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, Setting $setting)
    {

        $setting = Setting::where('settings_key', $request->settings_key)->first();
        $setting->settings_value = $request->settings_value;
        $setting->save();

        return redirect()->route('admin.settings.index')->with('msg_success', __('lang.updatedSuccessfully'));
    }

}

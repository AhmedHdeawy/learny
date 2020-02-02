<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Language;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        session_start();

        // Get Langs from DB
        $languages = Language::active()->get();

        // Get locale code and Convert them Array
        $localesLangs = $languages->pluck('locale')->toArray();

        // Get First Lang
        $defaultFromDB = $localesLangs[0];
        
        // Get Locale from URL
        $defaultFromUrl = request()->segment(1);

        // check if URL locale Exist in DB
        if (in_array($defaultFromUrl, $localesLangs)) {
            // Store Locale in Session
            $_SESSION['localization'] = $defaultFromUrl;

            // Continue to Request
            return $next($request);

        } else {

            // first check if session has localization
            if (isset($_SESSION['localization'])) {
                
                // check if localization that in SESSION Exist in Database
                if(in_array($_SESSION['localization'], $localesLangs)) {

                    // then, get Locale from SESSION
                    $localLang = $_SESSION['localization'];
                } else {
                    // then, get Locale from DB
                    $localLang = $defaultFromDB;
                }

            } else {

                // if SESSION has not locale like in DB, then Store From DB in Session
                $_SESSION['localization'] = $defaultFromDB;

                $localLang = $defaultFromDB;
            }
            
            // Append Locale to Url
            // check if is segment(1) Exist or Not
            if (request()->segment(1)) {
                
                $urlWithLocale = str_replace(request()->segment(1), '/'. $localLang .'/' . request()->segment(1), request()->fullUrl());
            } else {
                // If Empty, then append Locale to End
                $urlWithLocale = request()->fullUrl() . '/'. $localLang;
            }
            
            return redirect($urlWithLocale);
            
        }

        
    }
}

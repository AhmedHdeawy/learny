<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use File;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * Handle Search
     */
    public function handleSearch($query, $inputsArray)
    {
        
        foreach ($inputsArray as $key => $value) {

            // check that input Not Empty, OR equal Zero (status)
            if ( !empty($value[1]) || $value[1] == '0' ) {

                if($value[0] == 'like') {
                    // 'key', 'like', 'data'
                    $query->where($key, $value[0], '%' . trim($value[1]) . '%' );

                } elseif($value[0] == 'between') {

                    $query->whereBetween($key, $value[1]);

                } elseif($value[0] == 'in') {

                    $query->whereIn($key, $value[1]);
                    
                } elseif($value[0] == 'date') {
                    
                    $query->whereDate($key, $value[1]);

                } else {
                    $query->where($key, $value[0], $value[1]);
                }
            }

        }

        return $query;
    }

    /**
     * Delete Files
     */
    public function deleteFile($path, $name)
    {
        $path = public_path() . '/uploads/' . $path;
        $file = $path.$name;

        if (File::exists($file)) {
             File::delete($file);
         }
    }


    /**
     * make slug for all languages
     */
    public function makeSlug($string = null, $separator = "-") {
        if (is_null($string)) {
            return "";
        }

        // Remove spaces from the beginning and from the end of the string
        $string = trim($string);

        // Lower case everything 
        // using mb_strtolower() function is important for non-Latin UTF-8 string | more info: http://goo.gl/QL2tzK
        $string = mb_strtolower($string, "UTF-8");;

        // Make alphanumeric (removes all other characters)
        // this makes the string safe especially when used as a part of a URL
        // this keeps latin characters and arabic charactrs as well
        $string = preg_replace("/[^a-z0-9_\s-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]/u", "", $string);

        // Remove multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);

        // Convert whitespaces and underscore to the given separator
        $string = preg_replace("/[\s_]/", $separator, $string);
        return $string;
    }
}

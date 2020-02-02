<?php 

use App\Models\Info;
use App\Models\Setting;


/**
 * Get static Setting by it's key
 */
function getInfoByKey($key)
{
    return Info::where('infos_key', $key)->where('infos_status', '1')->first();
}


/**
 * Get static Setting by it's key
 */
function getSettingByKey($key)
{
    return Setting::where('settings_key', $key)->first();
}


/**
 * Get Count
 */
function countRows($table)
{
    return $table::count();
}



/**
 * Make Slug for title
 */
function make_slug($string = null, $separator = "-") {
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
    $string = preg_replace("/[^a-z0-9_\s\-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]/u", "", $string);

    // Remove multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);

    // Convert whitespaces and underscore to the given separator
    $string = preg_replace("/[\s_]/", $separator, $string);
    return $string;
}


?>

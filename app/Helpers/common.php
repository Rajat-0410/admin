<?php

namespace App\Helpers;

if (!function_exists('format_date')) {

    /**
     * Format Date/Time
     *
     * @param $date
     * @param $from_format
     * @param $to_format
     * @return string
     */
    function format_date($date, $from_format = 'Y-m-d H:i:s', $to_format = 'M d, Y|g:i a') {
        $return_date = null;
        if ($date) {
            $return_date = \Carbon\Carbon::createFromFormat($from_format, $date)->format($to_format);
        }
        return($return_date);
    }
        
}
?>
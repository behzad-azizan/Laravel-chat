<?php
function slugify($string){
    return \Illuminate\Support\Str::slug($string);
}

function to_j($dateTime, $withTime = true) {
    return App\Classes\DateTimeHelper::toJalali($dateTime, $withTime);
}

function to_jalali($dateTime, $format = C::DATE_TIME_FORMAT, $inPersian = true) {
    return App\Classes\DateTimeHelper::convertToJalali($dateTime, $format, $inPersian);
}

/**
 * @return \Date\Jalali
 */
function jalali($date = null) {
    return \Date\Jalali::make($date);
}

/**
 * @param int $timestamp
 * @return string
 */
function ago(int $timestamp) {
    return App\Classes\DateTimeHelper::ago($timestamp);
}

function to_time($date, $showSeconds = false, $inFa = false) {
    $date = new DateTime($date);
    if ($showSeconds)
        return $inFa ? tr_num($date->format(C::TIME_DETAILED_FORMAT), 'fa') : $date->format(C::TIME_DETAILED_FORMAT);
    else
        return $inFa ? tr_num($date->format(C::TIME_FORMAT), 'fa') : $date->format(C::TIME_FORMAT);
}

/**
 * @return bool
 */
function is_admin() {
    return \Illuminate\Support\Facades\Auth::guard('admin')
        ->check();
}

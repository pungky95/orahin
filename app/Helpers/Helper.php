<?php
/**
 *  Copyright (c) 2019. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.id
 * @date 12/15/19, 3:34 PM
 */

use App\Http\Resources\ErrorResponse;
use App\Http\Resources\SuccessResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;

if (!function_exists('dateFormat')) {
    /**
     * @param $date
     * @param $withTime
     * @return string
     */
    function dateFormat($date, $withTime = null)
    {
        if ($withTime) {
            return Carbon::parse($date)->format('j F Y H:i');
        }
        return Carbon::parse($date)->format('j F Y');
    }
}
if (!function_exists('photoProfileGetter')) {
    /**
     * @param $photoUrl
     * @return string
     */
    function photoProfileGetter($photoUrl)
    {
        if (preg_match('#\b".facebook.com."\b#i', $photoUrl)) {
            return $photoUrl . '?height=500';
        }
        return $photoUrl;
    }
}
if (!function_exists('successResponse')) {
    /**
     * @param $data
     * @return JsonResponse
     */
    function successResponse($data, $statusCode = 200)
    {
        return (new SuccessResponse($data))
            ->response()
            ->setStatusCode($statusCode);
    }
}
if (!function_exists('booleanConverter')) {
    /**
     * @param $value
     * @return bool
     */
    function booleanConverter($value)
    {
        if ($value == 0) {
            return false;
        }
        return true;
    }
}

if (!function_exists('formatCurrency')) {
    /**
     * @param $value
     * @return string
     */
    function formatCurrency($value)
    {
        return 'Rp' . number_format($value, 0, ',', '.');
    }
}
if (!function_exists('convertToNumber')) {
    /**
     * @param $value
     * @return string|string[]|null
     */
    function convertToNumber($value)
    {
        return preg_replace("/[^0-9]/", "", $value);
    }
}
if (!function_exists('errorResponse')) {
    /**
     * @param $data
     * @param $statusCode
     * @return JsonResponse
     */
    function errorResponse($data, $statusCode)
    {
        return (new ErrorResponse($data))
            ->response()
            ->setStatusCode($statusCode);
    }
}
if (!function_exists('successResponse')) {
    /**
     * @param $data
     * @param $statusCode
     * @return JsonResponse
     */
    function successResponse($data, $statusCode)
    {
        return (new SuccessResponse($data))
            ->response()
            ->setStatusCode($statusCode = 200);
    }
}
if (!function_exists('getMonthName')) {
    /**
     * @param $monthNumber
     * @return string
     */
    function getMonthName($monthNumber)
    {
        switch ($monthNumber) {
            case 1:
                return "January";
                break;
            case 2:
                return "February";
                break;
            case 3:
                return "March";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "May";
                break;
            case 6:
                return "June";
                break;
            case 7:
                return "July";
                break;
            case 8:
                return "August";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "October";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "December";
        }
    }

    if (!function_exists('randomPassword')) {
        /**
         * @return string
         */
        function randomPassword()
        {
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            return implode($pass); //turn the array into a string
        }
    }
}


<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    /**
     * Number of results to return in a list view.
     */
    public const LIST_RESULTS = 20;

    /**
     * Number of results to return in a grid view.
     */
    public const GRID_RESULTS = 100;

    /**
     * @param $input float Number to convert.
     * @return float Inch value converted into centimetres.
     */
    public function convertInchesToCentimetres($input)
    {
        return number_format(($input * 2.54), 2);
    }
}

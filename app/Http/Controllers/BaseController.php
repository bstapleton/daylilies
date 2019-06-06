<?php

namespace App\Http\Controllers;

/**
 * Class BaseController
 * @package App\Http\Controllers
 */
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
     * Takes a numeric value representing inches and returns its equivalent in centimetres to 2dp.
     *
     * @param $inches float number to convert.
     * @return float value converted into centimetres.
     */
    protected function convertInchesToCentimetres(float $inches)
    {
        return number_format(($inches * 2.54), 2);
    }

    /**
     * Return a page number for each display type relative to the current
     * position in the paginated list.
     *
     * @param bool $isCurrentlyGrid
     * @param int $pageNumber
     * @return float|int
     */
    protected function getPageNumber(int $pageNumber = null, bool $isCurrentlyGrid = false)
    {
        if ($pageNumber) {
            if ($isCurrentlyGrid == true) {
                return (($pageNumber - 1) * 5) + 1;
            }

            return floor(($pageNumber / 5) + 1);
        }

        return 1;
    }

    /**
     * Returns a thumbnail image path for a given slug, or a default image if nothing is found.
     *
     * @param string $slug
     * @return string
     */
    protected function getThumbnailFromSlug(string $slug) {
        if (file_exists(public_path() . '/images/thumbnails/' . $slug . '.jpg'))
        {
            return '/images/thumbnails/' . $slug . '.jpg';
        }

        return '/images/no-thumbnail.svg';
    }
}

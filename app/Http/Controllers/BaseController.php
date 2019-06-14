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
     * base64 encoded svg for a 'this year' icon.
     */
    const NEW_ICON = 'PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA2Mi43IDU5LjcyIj4KICAgIDxkZXNjPk5ldyB0aGlzIHllYXI8L2Rlc2M+CiAgICA8cGF0aCBkPSJNMzAuNDksNTEuMzIsMTMsNTkuNjNhMSwxLDAsMCwxLTEuNDItMWwyLjUxLTE5LjE4YTIsMiwwLDAsMC0uNTQtMS42M2wtMTMuMy0xNGExLDEsMCwwLDEsLjU1LTEuNjdsMTktMy41NWEyLDIsMCwwLDAsMS4zOS0xbDkuMjUtMTdhMSwxLDAsMCwxLDEuNzYsMGw5LjI0LDE3YTIsMiwwLDAsMCwxLjM5LDFsMTksMy41NWExLDEsMCwwLDEsLjU0LDEuNjdsLTEzLjMsMTRhMiwyLDAsMCwwLS41MywxLjYzbDIuNSwxOS4xOGExLDEsMCwwLDEtMS40MiwxTDMyLjIxLDUxLjMyQTIsMiwwLDAsMCwzMC40OSw1MS4zMloiLz4KPC9zdmc+';

    /**
     * base64 encoded svg for a 'last year' icon.
     */
    const ALMOST_NEW_ICON = 'PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA2Mi42OSA1OS43NCI+CiAgICA8ZGVzYz5OZXcgbGFzdCB5ZWFyPC9kZXNjPgogICAgPHBhdGggZD0iTTYyLjQyLDIzLjc1YTEsMSwwLDAsMC0uNTQtMS42N2wtMTktMy41NWEyLDIsMCwwLDEtMS4zOS0xTDMyLjIzLjUzQTEsMSwwLDAsMCwzMS4zMiwwaDBhMSwxLDAsMCwwLS44NS41MmwtOS4yNSwxN2EyLDIsMCwwLDEtMS4zOSwxbC0xOSwzLjU0QTEsMSwwLDAsMCwwLDIzYTEsMSwwLDAsMCwuMjcuNzVsMTMuMywxNEEyLDIsMCwwLDEsMTQuMTEsMzlhMS41NSwxLjU1LDAsMCwxLDAsLjQzTDExLjYsNTguNTloMGExLDEsMCwwLDAsMS40MiwxbDE3LjQ3LTguMzFhMiwyLDAsMCwxLDEuNzIsMGwxNy40Niw4LjMxYTEsMSwwLDAsMCwxLjQyLTFsLTIuNS0xOS4xOGEyLDIsMCwwLDEsLjUzLTEuNjNaTTQ1LjE5LDUyLDMxLjMyLDQ1LjM2di0zNmw3LjMxLDEzLjQzLDE1LDIuODZMNDMuMjEsMzYuNzVaIi8+Cjwvc3ZnPg==';

    /**
     * base64 encoded svg for an 'out of stock' icon.
     */
    const OUT_ICON = 'PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMDAgMTAwIj4KICAgIDxwYXRoIGQ9Ik01MCwwYTUwLDUwLDAsMSwwLDUwLDUwQTUwLDUwLDAsMCwwLDUwLDBabTAsOTVBNDUsNDUsMCwxLDEsOTUsNTAsNDUsNDUsMCwwLDEsNTAsOTVaIi8+CiAgICA8cGF0aCBkPSJNMjcuNSw3My42OGEyLDIsMCwwLDAsMi45LS4wOSwyNi42OCwyNi42OCwwLDAsMSwzOS4yMiwwLDIsMiwwLDAsMCwyLjkuMDlsLjMtLjMxYTIsMiwwLDAsMCwuMTItMi43MiwzMCwzMCwwLDAsMC00NS44NiwwLDIsMiwwLDAsMCwuMTEsMi43MloiLz4KICAgIDxjaXJjbGUgY3g9IjY1LjAxIiBjeT0iMzUiIHI9IjUiLz4KICAgIDxjaXJjbGUgY3g9IjM1LjAxIiBjeT0iMzUiIHI9IjUiLz4KPC9zdmc+';

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
    protected function getThumbnailFromSlug(string $slug)
    {
        if (file_exists(public_path() . '/images/thumbnails/' . $slug . '.jpg'))
        {
            return '/images/thumbnails/' . $slug . '.jpg';
        }

        return '/images/no-thumbnail.svg';
    }

    /**
     * Returns a base64 decoded svg icon for a plant based on stock and year added to the website.
     *
     * @param bool $inStock whether or not the plant is in stock.
     * @param int $yearAdded the year added to the website.
     * @return string|null
     */
    protected function getStatusIcon(bool $inStock, int $yearAdded)
    {
        if (!$inStock)
        {
            return base64_decode(self::OUT_ICON);
        }

        if ($yearAdded == Date('Y'))
        {
            return base64_decode(self::NEW_ICON);
        }

        if ($yearAdded == (Date('Y') - 1))
        {
            return base64_decode(self::ALMOST_NEW_ICON);
        }

        return null;
    }
}

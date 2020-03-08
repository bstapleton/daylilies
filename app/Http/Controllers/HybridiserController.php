<?php

namespace App\Http\Controllers;

use App\Plant;
use App\Hybridiser;
use Illuminate\Support\Facades\Input;

/**
 * Class HybridiserController
 * @package App\Http\Controllers
 */
class HybridiserController extends BaseController
{
    /**
     * Get all plants by the requested hybridiser, redirecting to an error if that hybridiser is not found.
     *
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listPlants(string $slug) {
        $paginationCount = request('display') == 'grid' ? self::GRID_RESULTS : self::LIST_RESULTS;

        $plants = Plant::whereHas('hybridisers', function($query) use ($slug) {
            $query->whereSlug($slug);
        })->orderBy('name')->paginate($paginationCount);

        if ($plants->count() < 1)
        {
            return view('error', ['category' => 'Hybridiser Request', 'request' => $slug]);
        }

        foreach ($plants as $plant)
        {
            $this->parsePlantData($plant);
        }

        $hybridiser = Hybridiser::where('slug', $slug)->first();

        $view = request('display') == 'grid' ? 'plants-grid' : 'plants-list';

        return view($view, [
            'plants' => $plants,
            'pageNumberGrid' => $this->getPageNumber(Input::get('page'), false),
            'pageNumberList' => $this->getPageNumber(Input::get('page'), true),
            'isCategoryView' => false,
            'pageHeading' => 'Daylilies by ' . $hybridiser->full_name,
            'title' => 'Daylilies by ' . $hybridiser->full_name,
            'metaDescription' => 'Daylilies hybridised by ' . $hybridiser->full_name
        ]);
    }
}

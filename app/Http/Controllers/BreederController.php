<?php

namespace App\Http\Controllers;

use App\Plant;
use App\Breeder;
use Illuminate\Support\Facades\Input;

/**
 * Class BreederController
 * @package App\Http\Controllers
 */
class BreederController extends BaseController
{
    /**
     * Get all plants by the requested breeder, redirecting to an error if that breeder is not found.
     *
     * @param string $breederSlug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listPlants(string $slug) {
        $paginationCount = request('display') == 'grid' ? self::GRID_RESULTS : self::LIST_RESULTS;

        $plants = Plant::whereHas('breeders', function($query) use ($slug) {
            $query->whereSlug($slug);
        })->orderBy('name')->paginate($paginationCount);

        if ($plants->count() < 1)
        {
            return view('error', ['category' => 'Breeder Request', 'request' => $slug]);
        }

        foreach ($plants as $plant)
        {
            $this->parsePlantData($plant);
        }

        $breeder = Breeder::where('slug', $slug)->first();

        $view = request('display') == 'grid' ? 'plants-grid' : 'plants-list';

        return view($view, [
            'plants' => $plants,
            'pageNumberGrid' => $this->getPageNumber(Input::get('page'), false),
            'pageNumberList' => $this->getPageNumber(Input::get('page'), true),
            'isCategoryView' => false,
            'pageHeading' => 'Daylilies by ' . $breeder->full_name,
            'title' => 'Daylilies by ' . $breeder->full_name,
            'metaDescription' => 'Daylilies hybridised by ' . $breeder->full_name
        ]);
    }
}

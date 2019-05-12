<?php

namespace App\Http\Controllers;

use App\Category;
use App\Plant;

/**
 * Class PlantController
 * @package App\Http\Controllers
 */
class PlantController extends Controller
{
    /**
     * Get all plants available on the website.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $plants = Plant::paginate(20);

        return view('plants-list', ['plants' => $plants, 'category' => 'All daylilies']);
    }

    /**
     * View an individual plant.
     *
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(string $slug) {
        $plant = Plant::where('slug', $slug)
            ->first();

        return view('plant-view', ['plant' => $plant, 'title' => $plant->name]);
    }

    /**
     * Get all plants that hve been added tot he website in the current or previous year.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listNew() {
        $currentYear = date('Y');

        $thisYear = Plant::where('year_added', $currentYear)
            ->orderBy('name', 'asc')
            ->get();

        $lastYear = Plant::where('year_added', $currentYear - 1)
            ->orderBy('name', 'asc')
            ->get();

        return view('plants-new', ['thisYear' => $thisYear, 'lastYear' => $lastYear]);
    }

    /**
     * Get all plants for the requested category. Redirect to an error page if the request is invalid.
     *
     * @param string $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listCategory(string $category) {
        $plants = Plant::whereHas('category', function($query) use ($category) {
            $query->whereName(ucfirst($category));
        })->paginate(20);

        if ($plants->count() < 1) {
            return view('error', ['category' => 'Category Request', 'request' => $category]);
        }

        foreach ($plants as $plant) {
            $plant->heightInCm = $this->convertInchesToCentimetres($plant->height);
            $plant->flowerInCm = $this->convertInchesToCentimetres($plant->flower_size);
        }

        return view('plants-list', ['plants' => $plants, 'category' => ucfirst($category) . ' daylilies', 'title' => ucfirst($category) . ' daylilies']);
    }

    /**
     * Get all plants for the requested foliage type. Redirect to an error if not a valid foliage tag.
     *
     * @param string $foliage
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listFoliage(string $foliage) {
        $plants = Plant::whereHas('foliage', function($query) use ($foliage) {
            $query->whereName(ucfirst($foliage));
        })->orderBy('name', 'asc')->paginate(20);

        if ($plants->count() < 1) {
            return view('error', ['category' => 'Foliage Request', 'request' => $foliage]);
        }

        return view('plants-list', ['plants' => $plants, 'category' => 'Daylilies with ' . $foliage . ' foliage', 'title' => ucfirst($foliage) . ' daylilies']);
    }

    /**
     * Get all plants for the requested season. Redirect to an error if not a valid season tag.
     *
     * @param string $season
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listSeason(string $season) {
        $plants = Plant::whereHas('seasons', function($query) use ($season) {
            $query->whereName(ucfirst(str_replace('-', ' ', $season)));
        })->orderBy('name', 'asc')->paginate(20);

        if ($plants->count() < 1) {
            return view('error', ['category' => 'Season Request', 'request' => $season]);
        }

        return view('plants-list', ['plants' => $plants, 'category' => 'Daylilies that flower ' . $season . ' season', 'title' => ucfirst($season) . ' season daylilies']);
    }

    /**
     * @param $input float Number to convert.
     * @return float Inch value converted into centimetres.
     */
    private function convertInchesToCentimetres($input)
    {
        return number_format(($input * 2.54), 2);
    }
}

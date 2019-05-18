<?php

namespace App\Http\Controllers;

use App\Plant;
use Intervention\Image\Facades\Image;

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

        // todo: smarter listings - only get previous year if there's less than 20 new ones for the current year

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
        })->orderBy('name')->paginate(20);

        if ($plants->count() < 1)
        {
            return view('error', ['category' => 'Category Request', 'request' => $category]);
        }

        foreach ($plants as $plant)
        {
            $plant->heightInCm = $this->convertInchesToCentimetres($plant->height);
            $plant->flowerInCm = $this->convertInchesToCentimetres($plant->flower_size);
        }

        switch ($category) {
            case 'large':
                $metaDescription = 'Large flowered daylilies are the most popular and well-known category of Hemerocallis; defined by a flower size of 4.5 inches and above';
                break;
            case 'small':
                $metaDescription = 'Small flowered daylilies have attracted increasing attention since being officially recognised. They are defined by a flower size between 3 and 4.5 inches';
                break;
            case 'miniature':
                $metaDescription = 'Miniature flowered daylilies make up for their small bloom size (anything under 3 inches) with more flowers per plant. Ideal for where space is at a premium';
                break;
            case 'spider':
                $metaDescription = 'Spider daylilies here are grouped with unusual forms. They tend to have a sculptured look and can be an interesting choice in garden designs';
                break;
        }

        return view('plants-list', [
            'plants' => $plants,
            'category' => $category,
            'categoryTitle' => ucfirst($category) . ' daylilies',
            'title' => ucfirst($category) . ' daylilies',
            'metaDescription' => $metaDescription
        ]);
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

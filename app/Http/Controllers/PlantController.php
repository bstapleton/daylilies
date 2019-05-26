<?php

namespace App\Http\Controllers;

use App\Plant;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class PlantController
 * @package App\Http\Controllers
 */
class PlantController extends BaseController
{
    /**
     * Get all plants available on the website.
     *
     * @return Factory|View
     */
    public function index() {
        $plants = Plant::paginate(self::GRID_RESULTS);

        return view('plants-grid', ['plants' => $plants, 'category' => 'All daylilies']);
    }

    /**
     * View an individual plant.
     *
     * @param string $slug
     * @return Factory|View
     */
    public function view(string $slug) {
        $plant = Plant::where('slug', $slug)
            ->first();

        $plant->heightInCm = $this->convertInchesToCentimetres($plant->height);
        $plant->flowerInCm = $this->convertInchesToCentimetres($plant->flower_size);

        return view('plant-view', ['plant' => $plant, 'title' => $plant->name]);
    }

    /**
     * Get all plants that hve been added tot he website in the current or previous year.
     *
     * @return Factory|View
     */
    public function listNew() {
        $currentYear = date('Y');

        $plants = Plant::where('year_added', $currentYear)
            ->orderBy('name', 'asc')
            ->paginate(self::GRID_RESULTS);

        if ($plants->count() < 1)
        {
            $plants = Plant::where('year_added', $currentYear - 1)
                ->orderBy('name', 'asc')
                ->paginate(self::GRID_RESULTS);
        }

        return view('plants-grid', [
            'plants' => $plants,
            'categoryTitle' => 'Newest daylilies in the website catalogue',
            'title' => 'Newest additions',
            'metaDescription' => 'Latest daylily additions to the website catalogue across all categories.'
        ]);
    }

    /**
     * Get all plants for the requested category. Redirect to an error page if the request is invalid.
     *
     * @param string $category
     * @return Factory|View
     */
    public function listCategory(string $category) {
        $paginationCount = request('display') == 'grid' ? self::GRID_RESULTS : self::LIST_RESULTS;

        $plants = Plant::whereHas('category', function($query) use ($category) {
            $query->whereName(ucfirst($category));
        })->orderBy('name')->paginate($paginationCount);

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

        $view = request('display') == 'grid' ? 'plants-grid' : 'plants-list';

        return view($view, [
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
     * @return Factory|View
     */
    public function listFoliage(string $foliage) {
        $plants = Plant::whereHas('foliage', function($query) use ($foliage) {
            $query->whereName(ucfirst($foliage));
        })->orderBy('name', 'asc')->paginate(self::LIST_RESULTS);

        if ($plants->count() < 1) {
            return view('error', ['category' => 'Foliage Request', 'request' => $foliage]);
        }

        return view('plants-list', [
            'plants' => $plants,
            'category' => 'Daylilies with ' . $foliage . ' foliage',
            'categoryTitle' => ucfirst($foliage) . ' daylilies',
            'title' => ucfirst($foliage) . ' daylilies'
        ]);
    }

    /**
     * Get all plants for the requested season. Redirect to an error if not a valid season tag.
     *
     * @param string $season
     * @return Factory|View
     */
    public function listSeason(string $season) {
        $plants = Plant::whereHas('seasons', function($query) use ($season) {
            $query->whereName(ucfirst(str_replace('-', ' ', $season)));
        })->orderBy('name', 'asc')->paginate(self::LIST_RESULTS);

        if ($plants->count() < 1) {
            return view('error', ['category' => 'Season Request', 'request' => $season]);
        }

        return view('plants-list', [
            'plants' => $plants,
            'category' => 'Daylilies that flower ' . str_replace('-', ' ', $season),
            'categoryTitle' => ucfirst(str_replace('-', ' ', $season)) . ' daylilies',
            'title' => ucfirst(str_replace('-', ' ', $season)) . ' daylilies'
        ]);
    }
}

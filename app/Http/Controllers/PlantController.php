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
            $query->whereSlug($category);
        })->orderBy('name')->paginate($paginationCount);

        if ($plants->count() < 1)
        {
            return view('error', ['category' => 'Category Request', 'request' => $category]);
        }

        foreach ($plants as $plant)
        {
            $plant->heightInCm = $this->convertInchesToCentimetres($plant->height);
            $plant->flowerInCm = $this->convertInchesToCentimetres($plant->flower_size);
            $plant->thumbnail = $this->getPlantThumbnail($plant->slug);
        }

        $view = request('display') == 'grid' ? 'plants-grid' : 'plants-list';

        return view($view, [
            'plants' => $plants,
            'isCategoryView' => true,
            'title' => $plants->first()->category()->first()->name . ' daylilies',
            'metaDescription' => $plants->first()->category()->first()->meta_description
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

    /**
     * Returns the thumbnail image path for a given plant slug, or a default image if nothing is found.
     *
     * @param string $slug
     * @return string
     */
    private function getPlantThumbnail(string $slug) {
        if (file_exists(public_path() . '/images/thumbnails/' . $slug . '.jpg'))
        {
            return '/images/thumbnails/' . $slug . '.jpg';
        }

        return '/images/no-thumbnail.svg';
    }
}
